<?php

class MyController extends \BaseController {

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
		return 'login';
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function postLogin()
    {
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
                return Redirect::to('')->with('success', 'You have logged in successfully');
            } else {
                return Redirect::to('login')->withErrors(['password' => 'Invalid Username or Password! Please try again.'])->withInput(Input::except('password'));
            }
        }
        return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
    }
}
