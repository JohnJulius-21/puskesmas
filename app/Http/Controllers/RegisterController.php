<?php
namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;

use Illuminate\Http\Request;


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
        // Registration logic using Fortify's CreateNewUser action
        $this->createNewUser->create($request->all());

        // Redirect to the login page after registration
        return redirect()->route('login')->with('message', 'Pendaftaran Berhasil, Silahkan Login');
    }
}

