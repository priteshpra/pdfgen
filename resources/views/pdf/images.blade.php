<!DOCTYPE html>
<html>

<head>
    <title>Images PDF</title>
    <style>
        img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @foreach ($imagePaths as $imagePath)
    <div>
        <img src="{{ public_path('storage/' . $imagePath) }}" alt="Image">
    </div>
    @endforeach
</body>

</html>