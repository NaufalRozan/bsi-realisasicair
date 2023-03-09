@extends('layouts.navbar')

<head>

<link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>

@section('content')
<div class="container">
    @if (session('Sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('Sukses') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Cabang') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add.cabang') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="Nama_Cabang" class="col-md-4 col-form-label text-md-end">{{ __('Nama Outlet') }}</label>

                            <div class="col-md-6">
                                <input id="Nama_Cabang" type="text" class="form-control @error('Nama_Cabang') is-invalid @enderror" name="Nama_Cabang" value="{{ old('Nama_Cabang') }}" required autocomplete="Nama_Cabang" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="Target" class="col-md-4 col-form-label text-md-end">{{ __('Target') }}</label>

                            <div class="col-md-6">
                                <input id="Target" type="number" class="form-control @error('Target') is-invalid @enderror" name="Target" value="{{ old('Target') }}" required autocomplete="Target">

                                @error('Outlet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="blue-button">
                                    {{ __('Tambah') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection