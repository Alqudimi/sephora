<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Cart;
use App\Models\Consent;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PrivacyController extends Controller
{
    /**
     * Privacy centre: what we hold, export, deletion and consent history.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('account.privacy', [
            'user' => $user,
            'consents' => $user->consents()->latest('accepted_at')->get(),
        ]);
    }

    /**
     * PDPL data portability: a machine-readable copy of the account's data.
     */
    public function export(Request $request): JsonResponse
    {
        $user = $request->user();

        $orders = $user->orders()
            ->with('items')
            ->latest()
            ->get()
            ->map(fn (Order $order) => [
                'order_number' => $order->order_number,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_method,
                'delivery_method' => $order->delivery_method,
                'subtotal' => $order->subtotal,
                'discount' => $order->discount,
                'shipping_fee' => $order->shipping_fee,
                'total' => $order->total,
                'placed_at' => $order->created_at?->toIso8601String(),
                'shipping_address' => $order->shipping_address,
                'items' => $order->items->map(fn ($item) => [
                    'product_name' => $item->product_name,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'line_total' => $item->line_total,
                ])->all(),
            ])
            ->all();

        $payload = [
            'exported_at' => now()->toIso8601String(),
            'account' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'date_of_birth' => $user->date_of_birth?->toDateString(),
                'gender' => $user->gender,
                'preferred_language' => $user->preferred_language,
                'preferred_store' => $user->preferred_store,
                'loyalty_tier' => $user->loyalty_tier,
                'loyalty_points' => $user->loyalty_points,
                'marketing_preferences' => $user->marketing_preferences,
                'created_at' => $user->created_at?->toIso8601String(),
            ],
            'addresses' => $user->addresses()->get()->map(fn ($address) => [
                'label' => $address->label,
                'full_name' => $address->full_name,
                'phone' => $address->phone,
                'emirate' => $address->emirate,
                'area' => $address->area,
                'street_address' => $address->street_address,
                'building' => $address->building,
                'delivery_instructions' => $address->delivery_instructions,
                'is_default' => (bool) $address->is_default,
            ])->all(),
            'orders' => $orders,
            'wishlist' => $user->wishlist()->pluck('products.name')->all(),
            'reviews' => $user->reviews()->get()->map(fn ($review) => [
                'product_id' => $review->product_id,
                'rating' => $review->rating,
                'title' => $review->title,
                'body' => $review->body,
                'created_at' => $review->created_at?->toIso8601String(),
            ])->all(),
            'consents' => $user->consents()->get()->map(fn (Consent $consent) => [
                'type' => $consent->type,
                'version' => $consent->version,
                'accepted' => $consent->accepted,
                'accepted_at' => $consent->accepted_at?->toIso8601String(),
            ])->all(),
        ];

        $this->audit($request, 'account.data.exported', 'Account data exported (PDPL request)');

        return response()->json(
            $payload,
            200,
            ['Content-Disposition' => 'attachment; filename="sephora-data-export-'.$user->id.'.json"'],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        );
    }

    /**
     * PDPL erasure: anonymise the account while retaining the financial
     * ledger (orders) without personal identifiers.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'password' => ['required', 'current_password'],
            'confirm' => ['accepted'],
        ], [
            'confirm.accepted' => 'Please confirm that you understand this cannot be undone.',
        ]);

        $userId = $user->id;
        $originalEmail = $user->email;
        $anonymousEmail = 'deleted+'.$userId.'-'.Str::lower(Str::random(8)).'@deleted.invalid';

        DB::transaction(function () use ($request, $user, $userId, $originalEmail, $anonymousEmail) {
            // Keep a non-identifying audit trail before the PII is removed.
            $this->audit(
                $request,
                'account.deleted',
                'Account anonymised at the customer\'s PDPL request',
                ['email' => $user->email],
                ['anonymised' => true],
            );

            $user->addresses()->delete();
            $user->wishlistItems()->delete();
            $user->reviews()->delete();
            Cart::where('user_id', $userId)->delete();

            // Orders remain for accounting/tax retention, stripped of every
            // field that can identify the customer.
            $user->orders()->update([
                'customer_name' => 'Deleted customer',
                'customer_email' => null,
                'customer_phone' => 'deleted',
                'guest_email' => null,
                'emirate' => null,
                'area' => null,
                'shipping_address' => null,
                'delivery_instructions' => null,
                'gift_message' => null,
            ]);

            // Consent evidence is retained but detached from the identity.
            Consent::where('user_id', $userId)->update([
                'email' => $anonymousEmail,
            ]);

            $user->forceFill([
                'name' => 'Deleted account',
                'email' => $anonymousEmail,
                'email_verified_at' => null,
                'password' => Str::random(64),
                'remember_token' => null,
                'phone' => null,
                'date_of_birth' => null,
                'gender' => null,
                'preferred_store' => null,
                'loyalty_tier' => 'member',
                'loyalty_points' => 0,
                'marketing_preferences' => null,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'customer',
                'is_admin' => false,
            ])->save();

            DB::table('sessions')->where('user_id', $userId)->delete();
            DB::table('password_reset_tokens')->where('email', $originalEmail)->delete();
        });

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('account_deleted', true);
    }

    private function audit(
        Request $request,
        string $action,
        string $description,
        array $oldValues = [],
        array $newValues = [],
    ): AuditLog {
        return AuditLog::create([
            'user_id' => $request->user()?->id,
            'action' => $action,
            'auditable_type' => $request->user()?->getMorphClass(),
            'auditable_id' => $request->user()?->getKey(),
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'old_values' => $oldValues ?: null,
            'new_values' => $newValues ?: null,
        ]);
    }
}
