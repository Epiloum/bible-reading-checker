<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title') - 대길교회 청년부</title>
    <script src="/js/all.js" type="text/javascript"></script>
    <link href="/css/all.css" rel="stylesheet" />
    <link href="/css/reading.css" rel="stylesheet" />
</head>
<body>
<header>
    <h1>@yield('headline')</h1>
</header>
<main>
    @section('contents')
    @show
</main>
@section('layers')
@show
</body>
</html>
