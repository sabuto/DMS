<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Revision;
use Illuminate\Http\Request;
use DB;
use Input;
use Session;
use File;

class RevisionController extends Controller {


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
		//
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
		$getID = DB::table('revisions')->max('id');
		$id = $getID + 1;
		$recordID = Input::get('record');
		$title = Input::get('title');
		$location = public_path() . '/records/' . $recordID . '/revision/' . $id . '/';
		$date = date('Y-m-d H:i:s');
		$file = Input::file('file')->getClientOriginalName();

		if (Input::file('file')->move($location, $file))
		{
			DB::table('revisions')->insert(
				array(
					'id'=>$id,
					'record_id'=>$recordID,
					'title'=>$title,
					'location'=>$location,
					'file'=>$file,
					'created_at' => $date,
					'updated_at' => $date
				)
			);
		}


		Session::flash('message', 'Revision has been added');
		return redirect('record/'.$recordID);
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
		$path = Revision::find($id)->pluck('location');
		File::deleteDirectory($path);
		if(Revision::find($id)->delete())
		{
			Session::flash('message', 'The revision has been deleted');
			return redirect()->back();
		}

	}

}
