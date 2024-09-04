<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // dd($input);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $unique_attribute_1 = substr( $input['name'], 0,3);
        $unique_attribute_2 = (string) random_int(1000, 9999);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role_id' => $input['user_role'],
            'password' => Hash::make($input['password']),
            'unique_name' => $unique_attribute_1 . $unique_attribute_2
        ]);
    }
}
