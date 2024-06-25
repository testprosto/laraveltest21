<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <span>{{ Auth::user()->name }}</span>
    <span>{{ Auth::user()->email}}</span>
    <span></span>
</body>

</html>