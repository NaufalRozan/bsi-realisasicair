@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<!-- <html> -->

<head>

<body>
    <div class="container">
        <div class="container mt-3">

            @if (session('Sukses'))
            <div class="alert alert-success" role="alert">
                {{ session('Sukses') }}
            </div>
            @endif

            <div class="row">
                <h1>Data</h1>
                <table class="table">

                    <div class="col-11 my-4" align="right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                            Tambah Data
                        </button>
                    </div>

                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th>Nama Marketing</th>
                            <th>Realisasi_Cair</th>
                            <th>Tanggal</th>
                            <th>Total Pencairan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ($keseluruhan as $keseluruhan)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $keseluruhan->name }}</td>
                            <td>{{ $keseluruhan->Realisasi_Cair }}</td>
                            <td>{{ $keseluruhan->tanggal }}</td>
                            <td>{{ $keseluruhan->Total_Pencairan }}</td>
                            <td>
                                <a href="/keseluruhan/{{$keseluruhan->id}}/edit" class="btn btn-warning bgn-sm">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
            </script>
        </div>

</body>

</html>
@include('layouts.footer')
@endsection