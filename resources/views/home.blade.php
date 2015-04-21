@extends('app')

@section('content')
<div class="container">
	<div class="row">        
        <div class="col-md-10 col-md-offset-1">
            @foreach ($records as $record)
            <a href="/record/{{ $record->id }}">
                <div class="panel panel-default">
				    <div class="panel-heading">By {{ $record->user->name }}
                    </div>
				    <div class="panel-body">
                        <h2>{{ $record->title }}</h2>
                        <p>{{ $record->description }}</p>
				    </div>
			     </div>
            </a>
            @endforeach
		</div>
	</div>
</div>
@endsection
