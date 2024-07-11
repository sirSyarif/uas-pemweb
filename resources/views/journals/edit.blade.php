@extends('layouts.main')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($journal, array('route' => array('journals.update', $journal->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

		<div class="mb-3">
			{{ Form::label('title', 'Judul', ['class'=>'form-label']) }}
			{{ Form::text('title', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('author', 'Penulis', ['class'=>'form-label']) }}
			{{ Form::text('author', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('publication_date', 'Tanggal Publikasi', ['class'=>'form-label']) }}
			{{ Form::date('publication_date', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('journal', 'Journal', ['class'=>'form-label']) }}
			{{ Form::text('journal', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('volume', 'Volume', ['class'=>'form-label']) }}
			{{ Form::number('volume', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('issue', 'Issue', ['class'=>'form-label']) }}
			{{ Form::number('issue', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('page', 'Jumlah Halaman', ['class'=>'form-label']) }}
			{{ Form::number('page', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('publisher', 'Penerbit', ['class'=>'form-label']) }}
			{{ Form::text('publisher', null, array('class' => 'form-control mb-3')) }}
			{{ Form::label('abstract', 'Abstrak', ['class'=>'form-label']) }}
			{{ Form::textarea('abstract', null, ['rows' => 4, 'class' => 'form-control mb-3']) }}
			{{ Form::label('category_id', 'Category', ['class'=>'form-label']) }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control mb-3']) }}
			{{ Form::label('tag_ids[]', 'Tags', ['class'=>'form-label']) }}
            {{ Form::select('tag_ids[]', $tags, $journal->tags->pluck('id'), ['class' => 'form-control mb-3', 'multiple' => true]) }}
			{{ Form::label('file', 'File', ['class'=>'form-label']) }}
            {{ Form::file('file', ['class' => 'form-control', 'accept' => 'pdf']) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
