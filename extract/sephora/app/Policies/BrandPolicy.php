<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;

class BrandPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Brand $brand): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Brand $brand): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Brand $brand): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Brand $brand): bool
    {
        return $this->managesContent($user);
    }
}
