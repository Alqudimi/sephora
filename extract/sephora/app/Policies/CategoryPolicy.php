<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Category $category): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Category $category): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Category $category): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}
