<?php

namespace App\Http\Controllers;

use App\User\Resources\UserResource;
use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $account = Account::where('name', 'rida')->firstOrFail();
        $users = $account->users()->paginate(5);

        return view('users.index', ['users' => UserResource::collection($users)]);
    }

    public function search()
    {
        $users = Account::where('name', 'rida')->firstOrFail()->users;
        $my_users = Account::where('name', 'rida')->firstOrFail()->users();
        $term = request('term');

        $search = Account::where('name', 'rida')->firstOrFail()->users()
            ->where('first_name', 'LIKE', "%{$term}%")
            ->orwhere('last_name', 'LIKE', "%{$term}%")
            ->orwhere('phone', 'LIKE', "%{$term}%");
//            ->orwhere('id', 'LIKE', "%{$term}%");

        /**
        * search for active users
         **/
        if (request('is_active') != null and request('verified') == null and request('term') == null) {
            return view('users.index')
                ->with('results', UserResource::collection($my_users->active()->get()))
                ->with('users', $users);
        }

        /**
         * search for verified users
         **/
        elseif (request('verified') != null and request('is_active') == null and request('term') == null) {
            return view('users.index')
                ->with('results', UserResource::collection($my_users->verified()->get()))
                ->with('users', $users);
        }

        /**
         * search for active and verified users
         **/
        elseif (request('verified') and request('is_active') != null and request('term') == null) {
            return view('users.index')
                ->with('results', UserResource::collection($my_users->active()->verified()->get()))
                ->with('users', $users);
        }

        /**
         * search for term in search box
         **/
        elseif (request('term') != null and request('is_active') == null and request('verified') == null) {
            return view('users.index')
                ->with('results', UserResource::collection($search->get()))
                ->with('users', $users);
        }

        /**
         * check if the user is active by search box and active checkbox
         **/
        elseif (request('term') and request('is_active') != null and request('verified') == null) {
            return view('users.index')
                ->with('results', UserResource::collection($search->active()->get()))
                ->with('users', $users);
        }

        /**
         * check if the user is verified by search box and verified checkbox
         **/
        elseif (request('term') and request('verified') != null and request('is_active') == null) {
            return view('users.index')
                ->with('results', UserResource::collection($search->verified()->get()))
                ->with('users', $users);
        }

        /**
         * check if the user is active and verified by search box and active,verified checkbox
         **/
        elseif (request('term') and request('verified') and request('is_active') != null) {
            return view('users.index')
                ->with('results', UserResource::collection($search->active()->verified()->get()))
                ->with('users', $users);
        }

        /**
         * return empty if the logged in account don't have users
         **/
        else {
            return view('users.index')
                ->with('results', [])
                ->with('users', $users);
        }
    }
}
