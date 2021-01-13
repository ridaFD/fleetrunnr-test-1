<?php

namespace App\Http\Controllers;

use App\User\Notifications\UserConfirmationNotification;
use App\User\Request\CreateUserRequest;
use App\User\Resources\UserResource;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $users = Account::where('name', 'rida')->firstOrFail()->users()->paginate(5);
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
//            return UserResource::collection($users);
//            dd($users[0]->pivot->permissions);
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

    public function create()
    {
        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $regions = $phoneNumberUtil->getSupportedCallingCodes();
        $regionCodes = $phoneNumberUtil->getSupportedCallingCodes();

        return view('users.create', [
            'regions' => $regions,
            'regionCodes' => $regionCodes
        ]);
    }

    /**
    * Used Form request validation
     * Used Validation rule for phone number
     * store the data in users table with active column after validation is successful
     * assign the user to the logged in account in the pivot table account_user with give him editor permission
     *
     */
    public function store()
    {
//        $request->validated();
//
//        User::create([
//            'first_name' => request('first_name'),
//            'last_name' => request('last_name'),
//            'avatar' => request('avatar')->store('avatars'),
//            'phone' => request('region') . ' ' . request('phone'),
//            'email' => request('email'),
//            'password' => Hash::make(request()['password']),
//            'is_active' => 1
//        ]);

//        $account = Account::find(1);
//        $user = User::latest()->first();
//        $account->users()->attach($user->id, ['permissions' => json_encode([2 => "editor"])]);

        Mail::to('rami@gmail.com')
            ->send(new UserConfirmationNotification());

        return redirect()
            ->back()
            ->with('message', 'email send');
    }
}
