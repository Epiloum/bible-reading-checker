<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="2021년 성경 통독 함께해요!">
	<meta property="og:title" content="성경읽기표 - 대길교회 청년부">
	<meta property="og:description" content="2021년 성경 통독 함께해요!">
	<meta property="og:image" content="http://{{ $_SERVER['SERVER_NAME'] }}/images/og_image.png">
    <title>성경읽기표 - 대길교회 청년부</title>
    <style type="text/css">
        * {
            margin : 0;
            padding: 0;
        }
        html {
            height: 100%;
        }
        body {
            background-image: url('/images/index.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center bottom;
            text-align: center;
        }
        header {
            overflow: hidden;
            min-height: 320px;
            font-family: 'Malgun Gothic',  'Apple SD Gothic Neo', sans-serif;
            letter-spacing: -2px;
        }
        hgroup
        {
            width: 210px;
            height: 210px;
            margin: 12% auto;
            background-color: rgba(0, 0, 0, .65);
        }
        h1 {
            padding-top: 60px;
            color: #eee;
            font-size: 32px;
        }
        h2 {
            padding-top: 10px;
            color: #ddd;
            font-size: 18px;
            font-weight: normal;
        }
        blockquote {
            width: 260px;
            margin: auto;
            padding: 25px;
            color: #333;
            font-size: 13px;
            text-align: center;
            line-height: 1.5em;
            letter-spacing: -0.05em;
            word-spacing: -0.1em;
        }
        #socilites {
            margin: 50px 40px;
        }
        #socilites a {
            display: inline-block;
            margin: 4px 5px;
            border-radius: 5px;
            background-repeat: no-repeat;
            box-shadow: 5px 5px 20px rgba(50, 20, 0, .7);
            overflow: hidden;
            font-size: 0;
            text-indent: -5000px;
        }
        #socilites a[href="/social/kakao"] {
            width: 183px;
            height: 43px;
            background-image: url('/images/kakao_login_large_narrow.png');
            background-size: 183px 43px;
        }
        #socilites a[href="/social/naver"] {
            width: 199px;
            height: 43px;
            background-image: url('/images/naver_login.png');
            background-size: 199px 43px;
        }
    </style>

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
    <hgroup>
        <h1>성경읽기표</h1>
        <h2>대길교회 청년부</h2>
    </hgroup>
</header>
<blockquote>
    주의 말씀은 내 발에 등이요<br />
    내 길에 빛이니이다 (시편 119:105)
</blockquote>
<div id="socilites">
    <a href="/social/kakao">카카오로그인</a>
    <!--<a href="/social/naver">네이버로그인</a>-->
</div>
</body>
</html>
