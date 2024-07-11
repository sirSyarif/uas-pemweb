<!-- resources/views/publications/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Publikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Data Publikasi</h2>

        <!-- Form Pencarian -->
        <form action="{{ route('publications.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul, penulis, atau tahun...">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <!-- Tabel Data Publikasi -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Tahun</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publications as $publication)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $publication->title }}</td>
                    <td>{{ $publication->authors }}</td>
                    <td>{{ $publication->year }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($publications->isEmpty())
        <p>Tidak ada data publikasi yang ditemukan.</p>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>