<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Record;
use App\Revision;
use Illuminate\Http\Request;

use Input;
use Auth;
use DB;
use Response;
use Session;
use File;

class RecordController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$records = Record::all();

		return view('home', compact('records'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('records.addingRecord');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Input::hasFile('file'))
		{
			$getId = DB::table('records')->max('id');
			$id = $getId + 1;
			$title = Input::get('title');
			$description = Input::get('description');
			$user_id = Auth::user()->id;
			$location = public_path() . '/records/' . $id . '/';
			$date = date('Y-m-d H:i:s');
			$file = Input::file('file')->getClientOriginalName();

			if (Input::file('file')->move($location, $file))
			{
				DB::table('records')->insert(
					array(
						'id' => $id,
						'title' => $title,
						'user_id' => $user_id,
						'description' => $description,
						'created_at' => $date,
						'updated_at' => $date,
						'location' => $location,
						'file' => $file
					)
				);
				return $this->index();
			}
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
		$record = Record::find($id);
		return view('/records/record', compact('record'));
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
		$path = Record::where('id', $id)->pluck('location');
		File::deleteDirectory($path);
		Record::destroy($id);
		Revision::where('record_id', $id)->delete();

		Session::flash('message', 'Record and revisions have been deleted');
		return redirect('/');
	}

}
