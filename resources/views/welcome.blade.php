@extends ('layouts.main')

<style>
    .citation-box {
        background-color: #f5f5f5;
        border-radius: 5px;
        padding: 10px;
        margin-top: 10px;
    }
</style>

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
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-primary mt-2" data-bs-toggle="offcanvas" data-bs-target="#filter-drawer"
                            aria-controls="filter-drawer">Filter</button>
                        <a class="btn btn-primary mt-2" href="{{ route('export-to-csv') }}">Export to
                            CSV</a>
                    </div>
                    @if ($journals->isEmpty())
                        <h2 class="text-center">Journal not found</h2>
                    @else
                        @foreach ($journals as $journal)
                            @if ($journal instanceof \App\Models\Journal)
                                <div class="card mt-3">

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
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modal-{{ $journal->id }}"
                                                data-journal-id="{{ $journal->id }}"
                                                data-journal-data="{{ json_encode($journal) }}">Cite <i
                                                    class="fas fa-quote-left"></i></button>
                                            <button class="btn btn-sm btn-danger">Download PDF <i
                                                    class="fas fa-file-pdf"></i></button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-{{ $journal->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="copyCitationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="copyCitationModalLabel">Copy Citation for
                                                        {{ $journal->title }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="citation-type">Citation Type:</label>
                                                            <select id="citation-type" class="form-control">
                                                                <option value="APA" selected>APA</option>
                                                                @foreach ($citationTypes as $citationType)
                                                                    @if ($citationType != 'APA')
                                                                        <option value="{{ $citationType }}">
                                                                            {{ $citationType }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="citation-text">Citation Text:</label>
                                                            <textarea id="citation-text" class="form-control" readonly></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" id="close-btn"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="copy-citation-btn">Copy
                                                        Citation</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif




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

        document.addEventListener("DOMContentLoaded", function() {
            var modalElements = document.querySelectorAll('.modal');
            modalElements.forEach(function(modalElement) {
                modalElement.addEventListener('show.bs.modal', function(event) {
                    var journalId = event.relatedTarget.getAttribute('data-journal-id');
                    var journalData = JSON.parse(event.relatedTarget.getAttribute(
                        'data-journal-data'));
                    var citationTypeSelect = modalElement.querySelector('#citation-type');
                    var citationType = citationTypeSelect.value;
                    var citationText = generateCitationText(journalData, citationType);
                    var citationTextarea = modalElement.querySelector('#citation-text');
                    citationTextarea.value = citationText;

                    event.target.addEventListener('click', function() {
                        bootstrap.Modal.getInstance(modalElement).hide();
                    });

                    citationTypeSelect.addEventListener('change', function() {
                        var citationType = citationTypeSelect.value;
                        var citationText = generateCitationText(journalData, citationType);
                        citationTextarea.value = citationText;
                    });

                    var closeButton = modalElement.querySelector('#close-btn');
                    closeButton.addEventListener('click', function() {
                        modalElement.querySelector('.modal').modal('hide');
                    });

                    var copyButton = modalElement.querySelector('#copy-citation-btn');
                    copyButton.addEventListener('click', function() {
                        var citationTextarea = modalElement.querySelector('#citation-text');
                        citationTextarea.select();
                        document.execCommand('copy');
                        modalElement.querySelector('.modal').modal('hide');
                    });
                });
            });
        });

        function generateCitationText(journalData, citationType) {
            switch (citationType) {
                case 'APA':
                    return `${journalData.author} (${journalData.publication_date}). ${journalData.title}. ${journalData.publisher}.`;
                case 'MLA':
                    return `${journalData.author}. " ${journalData.title}." ${journalData.publisher}, ${journalData.publication_date}.`;
                case 'Chicago':
                    return `${journalData.author}. ${journalData.title}. ${journalData.publisher}, ${journalData.publication_date}.`;
                    // Add more citation types as needed
                default:
                    return '';
            }
        }
    </script>

    </html>
@endsection
