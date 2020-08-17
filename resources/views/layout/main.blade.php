<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>{{env('APP_NAME')}}</title>
</head>
<body>
    <script>
        function imgError(image) {
        image.onerror = "";
        image.src = "/images/noimage.jfif";
        return true;
    }
    </script>
    @yield('main')
</body>
</html>

