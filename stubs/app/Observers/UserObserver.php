<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function creating(User $user)
    {
        $user->password = Hash::make($user->password);
    }

    public function created(User $user)
    {
      
    }

    public function updating(User $user)
    {
        if ($user->getAttribute('password') !== $user->getOriginal('password')) {
            $user->password = Hash::make($user->password);
        }
    }
}
