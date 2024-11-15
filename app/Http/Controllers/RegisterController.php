<?php
namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{   
    public function showRegistrationForm()
    {
        return view('auth.register'); // Assuming your registration form view is in resources/views/auth/register.blade.php
    }
    public function __construct(CreateNewUser $createNewUser)
    {
        $this->createNewUser = $createNewUser;
    }

    public function register(Request $request)
    {
    
        // Custom validation messages in Bahasa Indonesia
        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        // Apply validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
           'password' => ['required', 'string', 'min:5', 'confirmed']
        ], $messages);

        // Check for validation failures
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userData = $request->all();
      
        $userData['role_id'] = 2; // Set role_id to 2
        // dd($userData());

        // If validation passes, create the user
        $this->createNewUser->create($userData);

        // Redirect to the login page after registration
        return redirect()->route('login')->with('message', 'Pendaftaran Berhasil, Silahkan Login');
    }
}

