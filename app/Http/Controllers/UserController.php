<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'crm/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorCreate(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'required_with:confirm_password|same:confirm_password'],
            'confirm_password' => ['required', 'string', 'min:8'],
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create()
    {
        return view('users.create');
    }

    protected function save(Request $request)
    {
        $data = $request->all();
        $this->validatorCreate($data)->validate();
        if ($this->validatorCreate($data)) {
            User::create([
                'role_id' => 2,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
        return redirect($this->redirectTo);
    }

    protected function update(Request $request)
    {
        $data = $request->all();
        $this->validatorUpdate($data)->validate();
        if ($this->validatorUpdate($data)) {
            User::where('id', $request->id)->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name']
            ]);
        }
        return redirect($this->redirectTo);
    }

    protected function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect($this->redirectTo);
    }

}
