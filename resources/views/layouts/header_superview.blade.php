<header>
    <h1>@yield('headline')</h1>
    <div id="menu_left">
        <button id="button_nav">메뉴</button>
    </div>
    <div id="menu_right">
        @if($manager ?? false)
        <button id="button_tickets">추첨대상</button>
        @endif
        <button id="button_profile">프로필 수정</button>
    </div>
</header>
