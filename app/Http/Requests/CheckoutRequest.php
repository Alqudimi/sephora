<?php

namespace App\Http\Requests;

use App\Services\Payments\PaymentManager;
use App\Support\CommerceSettings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $paymentMethods = app(PaymentManager::class)->enabledMethods();
        if ($paymentMethods === []) {
            $paymentMethods = ['cod'];
        }

        return [
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['required', 'string', 'max:40', 'regex:/^[0-9+\\-\\s()]{7,20}$/'],
            'customer_email' => [auth()->check() ? 'nullable' : 'required', 'email', 'max:190'],
            'delivery_method' => ['required', Rule::in(array_keys(config('commerce.delivery_methods', [])))],
            'emirate' => ['required_unless:delivery_method,click_collect', 'nullable', 'string', 'max:100'],
            'area' => ['nullable', 'string', 'max:150'],
            'street_address' => ['required_unless:delivery_method,click_collect', 'nullable', 'string', 'max:400'],
            'building' => ['nullable', 'string', 'max:150'],
            'delivery_instructions' => ['nullable', 'string', 'max:500'],
            'store_id' => [
                'nullable',
                'required_if:delivery_method,click_collect',
                Rule::exists('stores', 'id')->where(fn ($query) => $query->where('is_active', true)),
            ],
            'payment_method' => ['required', Rule::in($paymentMethods)],
            'gift_message' => ['nullable', 'string', 'max:400'],
            'gift_box' => ['nullable', 'boolean'],
            'samples' => ['nullable', 'array', 'max:'.CommerceSettings::maxSamples()],
            'samples.*' => [
                'nullable',
                'integer',
                Rule::exists('products', 'id')->where(fn ($query) => $query->where('is_active', true)),
            ],
            'save_address' => ['nullable', 'boolean'],
            'idempotency_key' => ['nullable', 'string', 'max:64'],
            'terms' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => __('shop.controllers.req_customer_name'),
            'customer_phone.required' => __('shop.controllers.req_customer_phone'),
            'customer_phone.regex' => __('shop.controllers.req_customer_phone_regex'),
            'customer_email.required' => __('shop.controllers.req_customer_email'),
            'emirate.required_unless' => __('shop.controllers.req_emirate'),
            'street_address.required_unless' => __('shop.controllers.req_street'),
            'store_id.required_if' => __('shop.controllers.req_store_required'),
            'store_id.exists' => __('shop.controllers.req_store_exists'),
            'payment_method.required' => __('shop.controllers.req_payment_method'),
            'terms.accepted' => __('shop.controllers.req_terms'),
        ];
    }
}
