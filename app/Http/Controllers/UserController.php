<?php

namespace App\Http\Controllers;

use App\User\Notifications\UserConfirmationNotification;
use App\User\Notifications\UserEmailVerified;
use App\User\Request\CreateUserRequest;
use App\User\Resources\UserResource;
use App\Models\User;
use App\Models\Account;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\User\Resources\UserEmailConfirmationResource;

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
    public function store(CreateUserRequest $request)
    {
        $request->validated();

        User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'avatar' => request('avatar')->store('avatars'),
            'phone' => request('region') . request('phone'),
            'email' => request('email'),
            'password' => Hash::make(request()['password']),
            'is_active' => 1,
        ]);

        /**
         * assign the created user to the loged in account in the pivot table
         */
        $account = Account::find(1);
        $user = User::latest()->first();
        $account->users()->attach($user->id, ['permissions' => json_encode([2 => "editor"])]);

        /**
         * send email after create user
         */
        User::latest()->first()->notify(new UserConfirmationNotification($user));

        return redirect()
            ->back()
            ->with('message', 'email send');
    }

    public function confirm_email($token)
    {
        $decrypted_token = Crypt::decryptString($token);

        /**
         * convert the $decrypted_token into array.
         */
        $token_arr = explode(" ",$decrypted_token);

        $user = User::latest()->first();

        if ($user->phone == $token_arr[0] and $user->id == $token_arr[1] and $user->email == $token_arr[2]) {

            // update the email_verified_at and set it to now()
            $verified = User::find($user->id);
            $verified->email_verified_at = now();
            $verified->save();

            //once the email is verified in the database notify the user that the newly account is created and verified
            User::find($user->id)->notify(new UserEmailVerified());

            return new UserEmailConfirmationResource(User::findOrFail($user->id));
        } else {
            return response('failure', 500);
        }
    }
}
