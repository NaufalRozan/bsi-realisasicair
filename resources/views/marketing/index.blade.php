@extends('layouts.app')

@section('content')

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
        <h1>DATA MARKETING CBRM</h1>
        <div class="col-11 my-4" align="right">
        </div>


        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>Nama Marketing</th>
                        <th>Outlet</th>
                        <th>Target</th>
                        <th>Photo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach ($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->Outlet }}</td>
                    <td>{{ number_format($item->Target, 0, ',', '.') }}</td>
                    <td><img src="{{ $item->photo ? asset('storage/photos/' . $item->photo) : 'https://sman93jkt.sch.id/wp-content/uploads/2018/01/765-default-avatar.png' }}" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%;"></td>
                    <td>
                        <a href="/marketing/{{$item->id}}/edit" type="submit" class="btn yw-button"><img src="https://img.icons8.com/material-rounded/24/FFFFFF/pencil--v1.png"/></a>
                    </td>
                </tr>
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
    
 