@extends('layouts.navbar')
@section('content')

<head>

    {{-- <link rel="stylesheet" 
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-
MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-
eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" cross 
origin="anonymous"> --}}

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        @if (session('Sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('Sukses') }}
        </div>

        @endif
        <h1 class="py-3">Edit Data</h1>
        <div class="row">
            <form method="post" action="/marketing/{{$user->id}}/update" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Nama Marketing</label>
                    <input name="name" type="text" class="form-control mt-2" id="exampleInputEmail1" aria-describedby="EmailHelp" placeholder="Nama Marketing" value="{{ $user->name}}">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1">Target</label>
                    <input name="Target" type="text" class="form-control mt-2" id="exampleInputEmail1" aria-describedby="EmailHelp" placeholder="Target " value="{{ $user->Target}}">
                </div>
                <div class="form-group mb-3">
                    <select id="Outlet" class="form-select @error('Outlet') is-invalid @enderror" name="Outlet" required>
                        <option value="">-- Pilih Outlet --</option>
                        @foreach($outlets as $id => $Nama_Cabang)
                        <option value="{{ $Nama_Cabang }}" {{ old('Outlet', $user->Outlet) == $Nama_Cabang ? 'selected' : '' }}>{{ $Nama_Cabang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror" id="photo">
                    @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mt-5">
                    <a href="/marketing" type="submit" class="btn yw-button">Cancel</a>
                    <button type="submit" class="blue-button">Update</button>
                </div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-
q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-
ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-
JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" cross origin="anonymous">
        </script>
</body>
@include('layouts.footer')
@endsection