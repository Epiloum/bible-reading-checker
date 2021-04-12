<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="2021년 성경 통독 함께해요!">
	<meta property="og:title" content="성경읽기표 - 대길교회 청년부">
	<meta property="og:description" content="2021년 성경 통독 함께해요!">
	<meta property="og:image" content="http://{{ $_SERVER['SERVER_NAME'] }}/images/og_image.png">
    <meta name="application-name" content="대길교회 성경읽기표"
          data-csrf-token="{{ csrf_token() }}"
          data-kakao-id="{{ $kakao_id }}"
    />
    <title>@yield('title') - 대길교회 청년부</title>
    <script src="/js/all.js" type="text/javascript"></script>
    <link href="/css/all.css" rel="stylesheet" />
    <link href="/css/reading.css" rel="stylesheet" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
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
<nav>
    <dl>
        <dt>구약 바로가기</dt>
        <dd data-to="book1">모세오경</dd>
        <dd data-to="book6">역사서</dd>
        <dd data-to="book18">시가서</dd>
        <dd data-to="book23">대선지서</dd>
        <dd data-to="book28">소선지서</dd>
        <dt>신약 바로가기</dt>
        <dd data-to="book40">복음서</dd>
        <dd data-to="book44">역사서</dd>
        <dd data-to="book45">바울서신</dd>
        <dd data-to="book58">일반서신</dd>
        <dd data-to="book66">예언서</dd>
    </dl>
</nav>
<header>
    <h1>@yield('headline')</h1>
    <div id="menu_left">
        <button id="button_nav">메뉴</button>
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
