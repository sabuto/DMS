@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		@if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
				<div class="panel panel-default">
					<div class="panel-heading">By {{ $record->user->name }}
					</div>
					<div class="panel-body">
						<h2>{{ $record->title }}</h2>
						<p>{{ $record->description }}</p>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						@if (Auth::id() == $record->user_id)
						<form role="form" method="POST" action="/record/{{$record->id}}">
						{!! Form::hidden('_method', 'DELETE') !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-primary btn-block" class="delete">Delete</button>
						</form>
						@endif
						<form role="form" method="POST" action="/record/download/{{$record->id}}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id" value="{{ $record->id }}">
							<button type="submit" class="btn btn-primary btn-block">Download</button>
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						Revisions
					</div>
					<div class="panel-body">
					@foreach($record->revisions as $revision)
					{!! Form::open(array('url'=>'/revision/'.$revision->id, 'method'=>'delete', 'class'=>'pull-right')) !!}
                        {!! Form::submit('Delete revision', array('class'=>'btn btn-sml btn-danger')) !!}
                    {!! Form::close() !!}
                    <h4>{{$revision->title}}</h4>
                    <pre>{{ $revision->created_at }}</pre>
                    @endforeach
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						Add Revision
					</div>
					<div class="panel-body">
						{!! Form::open(array('url'=>'/revision', 'files'=>true)) !!}
							<input type="hidden" name="record" value="{{ $record->id }}" />
							{!! Form::file('file') !!}
							{!! Form::text('title') !!}
							{!! Form::submit('Submit') !!}
						{!! Form::close() !!}
					</div>
				</div>
		</div>
	</div>
</div>
@endsection
