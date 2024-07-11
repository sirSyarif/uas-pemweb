@extends('layouts.main')

<style>
    .select-wrapper {
        position: relative;
    }

    .select-wrapper .caret {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .select-wrapper select[multiple] {
        padding-right: 30px;
    }

    .select-wrapper select[multiple] option {
        padding: 5px;
        border-bottom: 1px solid #ccc;
    }

    .select-wrapper select[multiple] option:hover {
        background-color: #f0f0f0;
    }

    .select-wrapper select[multiple] option:selected {
        background-color: #007bff;
        /* bright blue */
        color: #fff;
        font-weight: bold;
        border-radius: 5px;
        padding: 5px 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .select-wrapper select[multiple] option:selected::before {
        content: "\2713";
        /* checkmark symbol */
        margin-right: 10px;
        color: #fff;
        font-size: 18px;
    }
</style>

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Create Journal</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'journals.store', 'enctype' => 'multipart/form-data']) !!}

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ Form::label('title', 'Judul', ['class' => 'form-label']) }}
                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('author', 'Penulis', ['class' => 'form-label']) }}
                        {{ Form::text('author', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('publication_date', 'Tanggal Publikasi', ['class' => 'form-label']) }}
                        {{ Form::date('publication_date', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ Form::label('journal', 'Journal', ['class' => 'form-label']) }}
                        {{ Form::text('journal', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('volume', 'Volume', ['class' => 'form-label']) }}
                        {{ Form::number('volume', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('issue', 'Issue', ['class' => 'form-label']) }}
                        {{ Form::number('issue', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ Form::label('page', 'Jumlah Halaman', ['class' => 'form-label']) }}
                        {{ Form::number('page', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('publisher', 'Penerbit', ['class' => 'form-label']) }}
                        {{ Form::text('publisher', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ Form::label('abstract', 'Abstrak', ['class' => 'form-label']) }}
                        {{ Form::textarea('abstract', null, ['rows' => 4, 'class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ Form::label('category_id', 'Category', ['class' => 'form-label']) }}
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            {{ Form::label('tag_ids[]', 'Tags', ['class' => 'form-label']) }}
                            <div class="select-wrapper">
                                {{ Form::select('tag_ids[]', $tags, null, ['class' => 'form-control', 'multiple' => true]) }}
                                <span class="caret"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ Form::label('file', 'File', ['class' => 'form-label']) }}
                        {{ Form::file('file', ['class' => 'form-control', 'accept' => 'pdf']) }}
                    </div>
                </div>
            </div>

            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>

    <script>
        const tagSelect = document.querySelector('#tag_ids');
        const selectedTagsSpan = document.querySelector('#selected-tags');

        tagSelect.addEventListener('change', () => {
            const selectedTags = Array.from(tagSelect.selectedOptions).map(option => option.text);
            selectedTagsSpan.textContent = selectedTags.join(', ');
        });
    </script>

@stop
