@php
use Illuminate\Support\Facades\DB;

$users = DB::table('cms')->where('PageID',3)->first();
@endphp

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .icon-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .icon-button:hover {
            background-color: #0056b3;
        }

        .icon-container {
            display: flex;
            gap: 10px;
        }
    </style>
    <title>About Us</title>
</head>

<body>
    <div>{!! $users->Content !!}</div>
    <div class="icon-container">
        <!-- Android Button -->
        <button class="icon-button" onclick="window.location.href='/android-link';">
            <i class="fab fa-android"></i>
        </button>

        <!-- iOS Button -->
        <button class="icon-button" onclick="window.location.href='/ios-link';">
            <i class="fab fa-apple"></i>
        </button>
    </div>
</body>

</html>