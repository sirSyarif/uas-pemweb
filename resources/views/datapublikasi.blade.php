@extends('layouts.main')

@section('content')

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <div class="container rounded shadow-sm">
            <h2 class="fs-1 text-bold text-center">Academic Repository</h2>

            <div class="container p-3">
                <input class="form-control form-control-lg mt-3" type="text" placeholder="cari jurnal atau publikasi" aria-label=".form-control-lg example">
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <!--content search result-->
        <div class="card m-5">
            <div class="card-body mx-4">
                <h5 class="card-title">Analysis of heart rate variability.</h5>
                <div class="container">
                    <div class="row row-cols-auto mt-3">
                        <div class="col">Computer</div>
                        <div class="col">Jihan et al.</div>
                        <div class="col">55 cites</div>
                        <div class="col">2019</div>
                    </div>
                </div>
                <hr>
                <!--butoon grup-->
                <div class="container text-center">
                    <div class="row row-cols-4">
                        <div class="col"><button type="button" class="btn btn-primary">Download PDF</button></div>
                        <div class="col"><button type="button" class="btn btn-primary">Save</button></div>
                        <div class="col"><button type="button" class="btn btn-primary">Cite</button></div>
                        <div class="col"><button type="button" class="btn btn-primary">Go to the full page</button></div>
                    </div>
                </div>
                <!--end of button grup-->
            </div>
        </div>
        <!--end of content search result-->

        <!--content search result-->
        <div class="card m-5">
            <div class="card-body mx-4">
                <h5 class="card-title">Introduction: Algorithmic Thought</h5>
                <div class="container">
                    <div class="row row-cols-auto mt-3">
                        <div class="col">Theory, Culture & Society</div>
                        <div class="col">M. Fazi et al.</div>
                        <div class="col">0 citations</div>
                        <div class="col">2021</div>
                    </div>
                </div>
                <hr>
                <!--butoon grup-->
                <div class="container text-center">
                    <div class="row row-cols-4">
                        <div class="col"><button type="button" class="btn btn-primary">Download PDF</button></div>
                        <div class="col"><button type="button" class="btn btn-primary">Save</button></div>
                        <div class="col"><button type="button" class="btn btn-primary">Cite</button></div>
                        <div class="col"><button type="button" class="btn btn-primary">Go to the full page</button></div>
                    </div>
                </div>
                <!--end of button grup-->
            </div>
        </div>
        <!--end of content search result-->

</body>

</html>
@endsection