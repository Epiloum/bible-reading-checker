<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width">
    <meta charset="utf-8">
    <title>청년부 현장예배 예약</title>
    <script>
        <?php
        if (date('wH') >= 613) {
            echo 'location.href = "http://naver.me/FjoQCYWo";';
        }
        ?>
        setTimeout(function () { location.reload(); }, 10000);
    </script>
</head>
<body>
<div style="text-align:center; line-height:1.7em; margin-top:120px">
    <img src="http://daegil.net/images/logo.png" alt="대길교회" width="270" height="65"><br /><br />
    <b><?=date('n/d', time() + 86400 * (7 - date('w')))?>(주일) 현장예배 사전신청</b><br />
    <?=date('n/d', time() + 86400 * (6 - date('w')))?>(토) 오후 1시에 시작합니다!
</div>
</body>
</html>
