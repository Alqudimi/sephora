<?php

namespace App\Policies;

use App\Models\NewsletterSubscriber;
use App\Models\User;

class NewsletterSubscriberPolicy extends PanelPolicy
{
    /**
     * Marketing audience data — restricted to managers and admins;
     * subscribers can only be read or removed, never edited or created
     * by hand.
     */
    public function viewAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function view(User $user, NewsletterSubscriber $subscriber): bool
    {
        return $this->managesContent($user);
    }

    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, NewsletterSubscriber $subscriber): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, NewsletterSubscriber $subscriber): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }
}
