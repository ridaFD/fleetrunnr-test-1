<?php

namespace App\Http\Controllers;

use App\User\Resources\UserResource;
use App\Models\User;
use App\Models\Account;
class UserController extends Controller
{
    public function index()
    {
        $account = Account::where('name', 'rida')->firstOrFail();
        $users = $account->users()->paginate(3);

        return UserResource::collection($users);
    }
}
