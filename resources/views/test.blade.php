<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awal? </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <div class="circle" style="--clr:#4da6ff;">
            <img src="logo.png" alt="" class="logo">
        </div>
        <div class="content">
            <h2>PT.Dirgantara</h2>
            <p>INDONESIAN AEROSPACE(IAe)</p>
            @if (Auth::check())
                <a href="/dashboard">dashboard</a>
            @else
                <a href="/logout">Logout</a>
            @endif
        </div>
        <img src="wiwit.png" alt="" class="product_img">
    </div>
</body>
</html>