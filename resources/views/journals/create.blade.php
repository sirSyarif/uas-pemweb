@extends('layouts.main')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'journals.store', 'enctype' => 'multipart/form-data']) !!}

		<div class="mb-3">
			{{ Form::label('name', 'Name', ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('category_id', 'Category', ['class'=>'form-label']) }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control mb-3']) }}
			{{ Form::label('tag_ids[]', 'Tags', ['class'=>'form-label']) }}
            {{ Form::select('tag_ids[]', $tags, null, ['class' => 'form-control mb-3', 'multiple' => true]) }}
			{{ Form::label('file', 'File', ['class'=>'form-label']) }}
            {{ Form::file('file', ['class' => 'form-control', 'accept' => 'pdf']) }}

		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop
