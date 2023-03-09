@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<!-- <html> -->

<head>

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <div class="container">
        <div class="form-group">
            <h1>DATA CBRM</h1>
            <div>
                <form id="my-form" action="{{ route('data') }}" method="GET">
                    <div class="row mb-4">
                        <div class=" col-md-6">
                            <select name="month" id="month" class="form-select">
                                <option value="">Semua Bulan</option>
                                <option value="01" {{ $month == '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ $month == '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ $month == '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ $month == '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ $month == '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ $month == '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ $month == '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ $month == '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ $month == '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $month == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ $month == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $month == '12' ? 'selected' : '' }}>December</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="year" id="year" class="form-select">
                                <option value="">Semua Tahun</option>
                                @for ($i = date('Y'); $i >= 2010; $i--)
                                <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="blue-button">Tampilkan</button>
                </form>
            </div>
        </div>
    </div>
</head>

<body>
    <div class="container">
        <div class="container mt-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr align="center">
                            <th>Nama Marketing</th>
                            <th>Outlet</th>
                            <th>Target Jabatan</th>
                            <th>Total Cair</th>
                            <th>Pencairan Baru</th>
                            <th>Pencairan TopUp</th>
                            <th>Total Pencairan Growth</th>
                            <th>%</th>
                            <th scope="col">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $userData)
                        <tr>
                            <td>{{ $userData->name }}</td>
                            <td>{{ $userData->Outlet }}</td>
                            <td align="center">{{ number_format($userData->Target, 0, ',', '.') }}</td>
                            <td align="center">{{ number_format($userData->total2, 0, ',', '.') }}</td>
                            <td align="center">{{ number_format($userData->total, 0, ',', '.') }}</td>
                            <td align="center">{{ number_format($userData->totaltu, 0, ',', '.') }}</td>
                            <td align="center">{{ number_format($userData->total, 0, ',', '.') }}</td>
                            <td>{{ number_format($userData->percent, 2) }}%</td>
                            <td>{{ $loop->iteration }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr align="center">
                        <th colspan="2"><b>Capacity Plan Total</b></th>
                        <th><b></b>{{ number_format($totaltj, 0, ',', '.') }}</th>
                        <th><b>{{ number_format($full, 0, ',', '.') }}</b></th>
                        <th><b>{{ number_format($totalpb, 0, ',', '.') }}</b></th>
                        <th><b>{{ number_format($fullto, 0, ',', '.') }}</b></th>
                        <th><b>{{ number_format($totalpb, 0, ',', '.') }}</b></th>
                        <th colspan="3"><b></b></th>
                    </tr>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>


</body>

</html>
@include('layouts.footer')
@endsection