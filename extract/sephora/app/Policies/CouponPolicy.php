<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\User;

class CouponPolicy extends PanelPolicy
{
    /**
     * Coupons move money — support may read them to answer customer
     * questions, but only managers and admins may change them.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Coupon $coupon): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Coupon $coupon): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Coupon $coupon): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Coupon $coupon): bool
    {
        return $this->managesContent($user);
    }
}
