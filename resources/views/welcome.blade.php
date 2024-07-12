@extends ('layouts.main')

@section('content')

    <body class="antialiased">
        <div
            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="offcanvas offcanvas-end" tabindex="-1" id="filter-drawer" aria-labelledby="filter-drawer-label">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="filter-drawer-label">Filter</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ route('welcome') }}" method="GET">
                        <div class="mb-3">
                            <label for="publication-since" class="form-label">Publication date</label>
                            <select class="form-select" id="publication-since" name="publication_date">
                                <option value="">Select a year</option>
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}"
                                        {{ request('publication_date') == $year ? 'selected' : '' }}>{{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter button -->
                        <button type="submit" class="btn btn-primary">Apply filters</button>
                    </form>
                </div>
            </div>


            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h2 class="fs-1 text-bold text-center">Academic Repository</h2>
                <div class="container rounded mt-5 align-content-center">
                    <form action="{{ route('welcome') }}" method="GET" id="search-form">
                        <input class="form-control form-control-lg" type="text" name="title"
                            value="{{ request()->input('title') }}" placeholder="Cari jurnal atau publikasi ilmiah..."
                            aria-label=".form-control-lg example">
                    </form>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary mt-2" data-bs-toggle="offcanvas" data-bs-target="#filter-drawer"
                            aria-controls="filter-drawer">Filter</button>
                    </div>
                    <div class="card mt-3">
                        @foreach ($journals as $journal)
                            @if ($journal instanceof \App\Models\Journal)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $journal->title }}</h5>
                                    <p class="card-text">{{ $journal->abstract }}
                                    </p>
                                    <p class="card-text">
                                        <small>Published in: {{ $journal->journal }}</small>
                                        <small>Authors: {{ $journal->author }}</small>
                                        <small>Volume : {{ $journal->volume }}</small>
                                        <small> {{ substr($journal->publication_date, 0, 4) }}</small>
                                    </p>

                                    <p class="card-text"> Tags :
                                        @foreach ($journal->tags as $tag)
                                            <span class="btn btn-sm btn-primary">{{ $tag->name }}</span>
                                        @endforeach
                                    </p>
                                    <div class="text-right d-flex justify-content-end gap-2">
                                        <button class="btn btn-sm btn-success">Cite<i
                                                class="fas fa-quote-left"></i></button>
                                        <button class="btn btn-sm btn-info">Share ↑ <i
                                                class="fas fa-share-alt"></i></button>
                                        <button class="btn btn-sm btn-danger">Download PDF <i
                                                class="fas fa-file-pdf"></i></button>
                                    </div>
                                </div>
                            @endif
                        @endforeach


                    </div>


                </div>


            </div>
            {{ $journals->links('vendor.pagination.custom') }}
    </body>

    <script>
        document.getElementById('search-form').addEventListener('keypress', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById('search-form').submit();
            }
        });
    </script>

    </html>
@endsection
