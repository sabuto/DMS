@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
      <table class="table table-striped">
        <thead>
          <tr>
            <td>Username</td>
            <td>Email</td>
            <td>Rank</td>
						<td>&nbsp;</td>
          </tr>
        </thead>
          @foreach($users as $user)
						<tr>
								<td><a href="/admin/{{ $user->id }}/edit">{{ $user->name }}</a></td>
								<td>{{ $user->email}}</td>
								<td>{{ $user->rank }}</td>
								<td>
								    <input type="hidden" name="id" value="{{$user->id}}">
								    {!! Form::open(array('url' => 'admin/'. $user->id)) !!}
								        {!! Form::hidden('_method', 'DELETE') !!}
								        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
								    {!! Form::close() !!}
								</td>

						</tr>
          @endforeach
      <table>
    </div>
  </div>
@endsection
