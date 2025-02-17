@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2>{{ Auth::user()->name }}</h2>
                <p>Universitas Sangga Buana</p>
                <p>Verified email at <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></p>
                <p>Teknik Informatika</p>
            </div>
            <div class="col-md-9">
                <h2>Publications</h2>
                <ul class="list-group">
                    @forelse ($journals as $journal)
                        <li class="list-group-item">
                            <h5>{{ $journal->title }}</h5>
                            <p>{{ $journal->author }}</p>
                            <p>{{ $journal->publisher }} ({{ $journal->volume }}), {{ $journal->page }},
                                {{ substr($journal->publication_date, 0, 4) }}
                            </p>
                            <div class="btn-group">
                                <a href="{{ route('journals.edit', [$journal->id]) }}"
                                    class="btn btn-sm btn-secondary">Edit</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('download-pdf', $journal) }}">Download PDF
                                    <i class="fas fa-file-pdf"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['journals.destroy', $journal->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        </li>
                    @empty
                        <h2 class="text-center">Jurnal kosong</h2>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
