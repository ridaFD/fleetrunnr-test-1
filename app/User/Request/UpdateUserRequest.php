<?php

namespace App\User\Request;

use App\Models\User;
use App\Support\Rules\ValidPhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(User $user)
    {
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'phone' => [
                'string', 'max:255',
                Rule::unique('users')->ignore($user->id),
                new ValidPhoneNumber()
            ],
            'avatar' => ['file', 'max:255'],
            'email' => ['email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }
}
