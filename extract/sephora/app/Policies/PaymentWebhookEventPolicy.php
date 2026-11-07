<?php

namespace App\Policies;

use App\Models\PaymentWebhookEvent;
use App\Models\User;

class PaymentWebhookEventPolicy extends PanelPolicy
{
    /**
     * Payment gateway payloads are financial debugging data — visible to
     * managers and admins, never removable from the panel (retention).
     */
    public function viewAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function view(User $user, PaymentWebhookEvent $event): bool
    {
        return $this->managesContent($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, PaymentWebhookEvent $event): bool
    {
        return false;
    }

    public function delete(User $user, PaymentWebhookEvent $event): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }
}
