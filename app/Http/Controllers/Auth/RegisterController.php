<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'Outlet' => ['required', 'string'],
            'Target' => ['required', 'integer', 'min:0'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $photo = null;

        if (isset($data['photo'])) {
            $photo = $data['photo']->store('public/photos');
            $photo = basename($photo);
        }

        return User::create([
            'name' => $data['name'],
            'Outlet' => $data['Outlet'],
            'Target' => $data['Target'],
            'photo' => $photo,
        ]);
    }

    public function showRegistrationForm()
    {
        $outlets = Cabang::pluck('nama_cabang', 'id');
        return view('auth.register', compact('outlets'));
    }
}
