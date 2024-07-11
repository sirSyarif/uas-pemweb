@extends('layouts.main')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('journals.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($journals as $journal)

				<tr>
					<td>{{ $journal->id }}</td>
					<td>{{ $journal->title }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('journals.edit', [$journal->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['journals.destroy', $journal->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
