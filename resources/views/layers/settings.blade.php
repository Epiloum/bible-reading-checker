<div id="layerSettings">
    <form id="frmSettings">
        <h2>프로필 설정</h2>
        <blockquote>소속과 이름, 휴대전화 번호를 작성해주세요! 입력해주신 내용은 매월 추첨으로 선물을 드릴 때 이용됩니다.</blockquote>
        <ul>
            <li>
                <label><input type="radio" name="division" value="청년1부" />청년1부</label>
                <label><input type="radio" name="division" value="청년2부" />청년2부</label>
            </li>
            <li>
                <input type="text" name="name" placeholder="이름을 입력해주세요" />
            </li>
            <li><input type="text" name="mobile" placeholder="휴대전화 번호를 입력해주세요" /></li>
        </ul>
        <div>
            <input type="submit" value="저장하기" />
        </div>
        @csrf
    </form>
</div>
