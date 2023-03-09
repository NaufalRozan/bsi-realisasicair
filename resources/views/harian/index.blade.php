@extends('layouts.app')

@section('content')
<html>

<head>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>


<div class="container">
    @if (session('Sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('Sukses') }}
    </div>
    @endif

    <div class="row">
        <h1>DATA</h1>
        <div class="col-11 my-4" align="right">
            <!-- Button trigger modal -->
            <button class="blue-button" type="button" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>

        <form id="my-form" method="GET">
            <div class="form-group">
                <label for="user_id">Pilih Nama</label>
                <select class="form-select" name="user_id" id="user_id" onchange="document.getElementById('my-form').submit()">
                    <option value="" selected disabled>-- Pilih Nama --</option>
                    @foreach ($users as $id => $name)
                    <option value="{{ $id }}" {{ $userId == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="name" id="name" value="{{ $userId }}"> <br>
        </form>

        <div id="running-text">
            <marquee>Selamat Datang di Website Realisasi Pencairan</marquee>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <div id="table-wrapper" class="table-responsive">
                        @if(isset($harian) && count($harian) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr align="center">
                                    <th scope="col">No</th>
                                    <th>Nama Marketing</th>
                                    <th>Realisasi Cair</th>
                                    <th>Pencairan TopUp</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($harian as $item)
                                <tr align="center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->Realisasi_Cair, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->Pencairan_TopUp, 0, ',', '.') }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        <a href="/harian/{{$item->id}}/edit" class=" btn blue-button">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" align="center"><b>Total Pencairan</b></td>
                                    <td align="center">{{ number_format($totalrc, 0, ',', '.') }}</td>
                                    <td align="center">{{ number_format($totalpt, 0, ',', '.') }}</td>
                                    <td colspan="2" align="center"><b>{{ number_format($total, 0, ',', '.') }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                        @else
                        <b>Tidak Ada Data</b>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('user_id').addEventListener('change', function() {
                var selectedValue = this.value;
                if (selectedValue) {
                    document.getElementById('table-wrapper').style.display = 'block';
                    document.getElementById('running-text').style.display = 'none';
                } else {
                    document.getElementById('table-wrapper').style.display = 'none';
                    document.getElementById('running-text').style.display = 'block';
                }
            });

            // menambahkan inisialisasi awal pada halaman load
            var selectedValue = document.getElementById('user_id').value;
            if (selectedValue) {
                document.getElementById('table-wrapper').style.display = 'block';
                document.getElementById('running-text').style.display = 'none';
            } else {
                document.getElementById('table-wrapper').style.display = 'none';
                document.getElementById('running-text').style.display = 'block';
            }
        </script>




        <div class="modal fade" id="exampleModal" tabindex="-1" arialabelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addHarianForm" action="{{ route('add.harian') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="info">Nama Marketing dan Outlet</label>
                                <select class="form-control" id="info" name="info">
                                    <option value="">-- Pilih Nama dan Outlet --</option>
                                    @foreach ($users as $id => $name)
                                    <option value="{{ $name }},{{ $Outlet[$id] }}">{{ $name }} - {{ $Outlet[$id] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Realisasi Cair</label>
                                <input name="Realisasi_Cair" type="number" class="form-control" id="Realisasi_Cair" rows="4" value="0"></input>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Pencairan TopUp</label>
                                <input name="Pencairan_TopUp" type="number" class="form-control" id="exampleFormControlTextarea1" rows="5" value="0"></input>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Tanggal</label>
                                <input name="tanggal" type="date" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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