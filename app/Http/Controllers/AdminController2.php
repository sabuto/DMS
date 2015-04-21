<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;
use File;
use Input;
use Session;

use Illuminate\Http\Request;

class AdminController2 extends Controller {

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
		$users = DB::table('users')->get();
		$revisions = DB::table('revisions')->get(); // Added
		return view('admin.home', compact('users', 'revisions'));
	}

	public function remove() {
		$user = Input::get('id');
		DB::table('users')->where('id', $user)->delete();
		return $this->index();
	}

	public function myRecords() {
		$user = Auth::user()->name;
		$records = DB::table('records')->where('creator', $user)->get();
		//$revisions = DB::table('revisions')->get(); // Added
		return view('home', compact('records'));
	}

	public function user($id) {
		$user = User::find($id);

		return view('admin/user', compact('user'));
	}

	public function editUser()
	{
		$id = Input::get('id');
		$name = Input::get('name');
		$email = Input::get('email');

		if(Input::has('admin'))
		{
			$rank = '3';
		} else {
			$rank = '2';
		}

		$user = User::find($id);

		$user->name = $name;
		$user->email = $email;
		$user->rank = $rank;

		$user->save();

		Session::flash('message', $name .' Successfully edited!');

		return redirect('admin');
	}

	public function deleteUser($id)
	{
		$user = User::find($id);

		$user->delete();

		Session::flash('message', 'The user has been deleted');

		return redirect('admin');
	}

}
