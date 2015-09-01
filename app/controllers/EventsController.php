<?php

class EventsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $events = Events::all();
		return View::make('events.main')->with('data', $events);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		if ($id == 'add')
        {
            return View::make('events.add');
        }
        else
        {
            return "Nothing Found";
        }
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$event_name = Input::get('name');
        $event_details = Input::get('details');
        $event_date = Input::get('event_date');

        if ((!empty($event_name)) && (!empty($event_details)) && (!empty($event_date))) {
            $event = Events::create([
                'event_name' => $event_name,
                'event_date' => $event_date,
                'event_detail' => $event_details,
                'user_id' => 1
            ]);

            if ($event) {
                return Redirect::to('events')->with('message', 'Event Saved Successfully');
            } else {
                return Redirect::to('events')->with('message', 'There Was Error Saving The Events. Please Try Again.');
            }
        } else {
            return Redirect::to('events/add')->with('message', 'Event Name and Details Cannot be Empty');
        }
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


}
