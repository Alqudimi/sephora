<?php

namespace App\Policies;

use App\Models\Faq;
use App\Models\User;

class FaqPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Faq $faq): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Faq $faq): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Faq $faq): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Faq $faq): bool
    {
        return $this->managesContent($user);
    }
}
