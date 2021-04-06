<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="application-name" content="대길교회 성경읽기표"
          data-csrf-token="{{ csrf_token() }}"
          data-kakao-id="{{ $kakao_id }}"
    />
    <title>@yield('title') - 대길교회 청년부</title>
    <script src="/js/all.js" type="text/javascript"></script>
    <link href="/css/all.css" rel="stylesheet" />
    <link href="/css/reading.css" rel="stylesheet" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0NNV09EZZK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0NNV09EZZK');
    </script>
</head>
<body>
<header>
    <h1>@yield('headline')</h1>
    <div id="menu_left">
    </div>
    <div id="menu_right">
        <button id="button_profile">프로필 수정</button>
    </div>
</header>
<main>
    @section('contents')
    @show
</main>
@section('layers')
@show
<div id="toast_msg"></div>
</body>
</html>
