@extends('layouts.navbar')

@section('content')

<!DOCTYPE html>
<html>

<head>
    <title>Podium Leaderboard</title>
    <style type="text/css">
        .podium-container {
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .podium-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: auto;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .podium-rank {
            font-size: 36px;
            font-weight: bold;
            color: #48a39e;
            margin-bottom: 10px;
        }


        .podium-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            text-align: center;
        }

        .podium-score {
            font-size: 12px;
            font-weight: bold;
            color: #48a39e;
            text-align: center;
        }

        .podium-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .podium-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        /* media query for mobile devices */
        @media (max-width: 768px) {
            .podium-container {
                padding: 10px;
            }
        }

    </style>
</head>

<body>
    <div class="podium-container">
        <div class="podium-item" style="background-color: #C0C0C0;">
            <div class="podium-rank">2</div>
            <div class="podium-image-container" style="margin-top: 30px;">
                @if($users[1]->photo)
                <img src="{{ asset('storage/photos/' . $users[1]->photo) }}" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%;">
                @else
                <img src="https://sman93jkt.sch.id/wp-content/uploads/2018/01/765-default-avatar.png" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%;">
                @endif
            </div>
            <div class="podium-name">{{ $users[1]->name }}</div>
            <div class="podium-score">{{ number_format($users[1]->percent, 2) }}%</div>
        </div>

        <div class="podium-item" style="background-color: #ffd700;">
            <div class="podium-rank">1</div>
            <div class="podium-image-container" style="margin-top: 30px; width: 125px; height: 125px;">
                @if($users[0]->photo)
                <img src="{{ asset('storage/photos/' . $users[0]->photo) }}" alt="User Photo" style="width: 125px; height: 125px; border-radius: 50%;">
                @else
                <img src="https://sman93jkt.sch.id/wp-content/uploads/2018/01/765-default-avatar.png" alt="User Photo" style="width: 125px; height: 125px; border-radius: 50%;">
                @endif
            </div>
            <div class="podium-name" style="font-size: 24px;">{{ $users[0]->name }}</div>
            <div class="podium-score" style="font-size: 20px;">{{ number_format($users[0]->percent, 2) }}%</div>
        </div>

        <div class="podium-item" style="background-color: #CD7F32;">
            <div class="podium-rank">3</div>
            <div class="podium-image-container">
                @if($users[2]->photo)
                <img src="{{ asset('storage/photos/' . $users[2]->photo) }}" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%;">
                @else
                <img src="https://sman93jkt.sch.id/wp-content/uploads/2018/01/765-default-avatar.png" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%;">
                @endif
            </div>
            <div class="podium-name">{{ $users[2]->name }}</div>
            <div class="podium-score">{{ number_format($users[2]->percent, 2) }}%</div>
        </div>

    </div>
</body>

</html>
@include('layouts.footer')
@endsection