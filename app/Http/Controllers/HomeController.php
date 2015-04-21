<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Record;
use App\Revision;
use Response;

use Illuminate\Http\Request;
use App\File;
use App\User;
use Input;
use DB;
use Validator, Redirect;
use Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$records = Record::all();

		return view('home', compact('records'));
	}

	public function addingRecord()
	{
		return view('records.addingRecord');
	}

	public function addRecord()
	{
		if (Input::hasFile('file'))
		{
			$getId = DB::table('records')->max('id');
			$id = $getId + 1;
			$title = Input::get('title');
			$description = Input::get('description');
			$creator = Auth::user()->name;
			$location = public_path() . '/records/' . $id . '/';
			$date = date('Y-m-d H:i:s');
			$file = Input::file('file')->getClientOriginalName();

			if (Input::file('file')->move($location, $file))
			{
				DB::table('records')->insert(
					array(
						'id' => $id,
						'title' => $title,
						'creator' => $creator,
						'description' => $description,
						'created_at' => $date,
						'updated_at' => $date,
						'location' => $location . $file,
						'file' => $file
					)
				);
				return $this->index();
			}
		}
	}

	public function record($id)
	{
		$record = DB::table('records')->where('id', $id)->get();
		return view('/records/record', compact('record'));
	}

	public function download($id)
	{
		$revisions = Revision::where('record_id', $id)->count();
		if($revisions != 0)
		{
			$path = Revision::where('record_id', $id)->orderBy('created_at', 'desc')->pluck('location');
			$file = Revision::where('record_id', $id)->orderBy('created_at', 'desc')->pluck('file');
		} else {
			$path = Record::where('id', $id)->pluck('location');
			$file = Record::where('id', $id)->pluck('file');
		}
		return Response::download($path.$file);
	}

	public function delete()
	{
		$id = Input::get('id');
		$file = DB::table('records')->where('id', $id)->delete();
		return $this->index();
	}

	public function addRevision()
	{
		$getID = DB::table('revisions')->max('id');
		$id = $getID + 1;
		$recordID = Input::get('revisions');
		$location = public_path() . '/records/' . $id . '/revision/' . $recordID . '/';
		$date = date('Y-m-d H:i:s');
		$file = Input::file('file')->getClientOriginalName();

		DB::table('revisions')->insert(
			array(
				'id'=>$id,
				'recordID'=>$recordID,
				'title'=>$title,
				'location'=>$location,
				'file'=>$file,
				'created_at' => $date,
				'updated_at' => $date
			)
		);
		return $this->index();
	}
	public function myRecords() {
		$id = Auth::user()->id;
		$records = Record::where('user_id', $id)->get();
		//$revisions = DB::table('revisions')->get(); // Added
		return view('home', compact('records'));
	}
}
