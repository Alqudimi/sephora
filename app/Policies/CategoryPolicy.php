<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, Category $category): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return (bool) $user->is_admin || $user->hasRole('admin', 'manager');
    }

    public function update(User $user, Category $category): bool
    {
        return (bool) $user->is_admin || $user->hasRole('admin', 'manager');
    }

    public function delete(User $user, Category $category): bool
    {
        return (bool) $user->is_admin || $user->hasRole('admin', 'manager');
    }
}
