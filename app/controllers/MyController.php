<?php

class MyController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::check()) {
            return Redirect::to('events')->with('success', 'You are already logged in');
        } else {
            return View::make('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function postLogin()
    {
        if (Input::has('Login')) {
            $userInfo = [
                'username' => Input::get('username'),
                'password' => Input::get('password')
            ];

            $rules = [
                'username' => 'Required',
                'password' => 'Required'
            ];

            $validator = Validator::make($userInfo, $rules);

            if ($validator->passes()) {
                if (Auth::attempt($userInfo)) {
                    return Redirect::to('events')->with('success', 'You have logged in successfully');
                } else {
                    return Redirect::to('login')
                        ->withErrors(['password' => 'Invalid Username or Password! Please try again.'])
                        ->withInput(Input::except('password'));
                }
            }
            return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
        } else {
            if (Input::has('Register')) {
                return Redirect::to('register');
            }
        }
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return Redirect::to('events')->with('success', 'You are already logged in. No need to Register');
        } else {
            return View::make('register');
        }
    }

    public function postRegister()
    {
        $username = Input::get('username');
        $email = Input::get('email');
        $name = Input::get('name');
        $password = Input::get('password');
        $password_confirmation = Input::get('password_confirmation');
        $confirmation_code = Hash::make(str_random(60));

        $userInfo = [
            'username' => $username,
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ];

        $rules = [
            'username' => 'Required | min:6 | alpha_num | unique:users',
            'email' => 'Required | email | unique:users',
            'name' => 'Required | min:3 ',
            'password' => 'Required | min:8 | confirmed',
            'password_confirmation' => 'Required | min:8'
        ];

        $validator = Validator::make($userInfo, $rules);

        if ($validator->passes()) {
            $user = User::create([
                'username' => $username,
                'email' => $email,
                'name' => $name,
                'password' => Hash::make($password),
                'confirmation_code' => $confirmation_code,
                'confirmed' => 0
            ]);
            return Redirect::to('/')->with('success', 'You have Registered successfully');
        } else {
            return Redirect::to('register')->withErrors($validator)->withInput(Input::except('password'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
