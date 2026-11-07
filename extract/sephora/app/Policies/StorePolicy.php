<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;

class StorePolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Store $store): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Store $store): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Store $store): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Store $store): bool
    {
        return $this->managesContent($user);
    }
}
