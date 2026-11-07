<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy extends PanelPolicy
{
    /**
     * Review moderation (approve / reject / edit) is part of day-to-day
     * support work; deleting reviews is reserved for managers.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Review $review): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Review $review): bool
    {
        return $this->isStaff($user);
    }

    /**
     * Bulk moderation (approve / reject selected).
     */
    public function updateAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function delete(User $user, Review $review): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}
