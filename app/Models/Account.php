<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function assign(User $user)
    {
        return $this->users()->save($user);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('permissions');
    }
}
