<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Revision;
use Session;
use Input;

class AdminController extends Controller {


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
		$users = User::all();
		$revisions = Revision::all();

		return view('admin.home', compact('users', 'revisions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
		$user = User::find($id);

		return view('admin/user', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		$user->delete();

		Session::flash('message', 'The user has been deleted');

		return redirect('admin');
	}

}
