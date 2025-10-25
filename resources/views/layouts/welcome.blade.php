<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card">
        <div class="circle" style="--clr:#4da6ff;">
            <img src="{{ asset('images/LOGOFULL.png') }}" alt="hiasan" class="logo" loading="lazy">
        </div>
        <div class="content">
            <h2>PT.Dirgantara</h2>
            <p>INDONESIAN AEROSPACE(IAe)</p>
            @if (Auth::check())
                <a href="{{ route('index') }}">dashboard</a>
            @else
                <a href="{{ route('login.form') }}">Login</a>
            @endif
        </div>
        <img src="{{ asset('images/N219.png') }}" alt="" class="product_img" loading="lazy">
    </div>
</body>

</html>
