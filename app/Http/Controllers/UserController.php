<?php

namespace App\Http\Controllers;

use App\User\Resources\UserResource;
use App\Models\User;
use App\Models\Account;
class UserController extends Controller
{
    public function index()
    {
        $users_for_logged_in = Account::where('name', 'rida')->firstOrFail()->users;
        return UserResource::collection($users_for_logged_in);
    }
}
