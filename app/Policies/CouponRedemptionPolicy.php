<?php

namespace App\Policies;

use App\Models\CouponRedemption;
use App\Models\User;

class CouponRedemptionPolicy extends PanelPolicy
{
    /**
     * Redemption history is financial audit data — read for managers,
     * never editable, deletable by admins only.
     */
    public function viewAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function view(User $user, CouponRedemption $redemption): bool
    {
        return $this->managesContent($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, CouponRedemption $redemption): bool
    {
        return false;
    }

    public function delete(User $user, CouponRedemption $redemption): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }
}
