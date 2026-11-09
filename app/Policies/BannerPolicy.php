<?php

namespace App\Policies;

use App\Models\Banner;
use App\Models\User;

class BannerPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Banner $banner): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Banner $banner): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Banner $banner): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Banner $banner): bool
    {
        return $this->managesContent($user);
    }
}

