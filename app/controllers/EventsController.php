<?php

class EventsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $events = Events::where('user_id', '=', Auth::user()->id )->get();
		return View::make('events.main')->with('data', $events);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
        if($id == 'add') {
           $data = $id;
        } else {
            $data = Events::where('event_id', '=', $id)->get()->first();
        }
        return View::make('events.add')->with('data', $data);
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
                'user_id' => Auth::user()->id
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
		/*$data = Events::where('event_id', '=', $id);
        return $data;*/
        $event_id = $id;
        $event_updated_name = Input::get('name');
        $event_updated_detail = Input::get('details');
        $event_updated_date = Input::get('event_date');
        $updated_data = Events::where('event_id', '=', $event_id)
            ->update(['event_name'=> $event_updated_name,
                'event_detail' => $event_updated_detail,
                'event_date' => $event_updated_date
            ]);
        if($updated_data) {
            return Redirect::to('events')->with('data', 'Events Updated Successfully');
        } else {
            return Redirect::to('events/'.$event_id)->with('error', 'Couldnot Updated Events');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$delete = Events::where('event_id', '=', $id)->delete();
        return $delete;
	}


}
