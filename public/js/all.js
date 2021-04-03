// Init
apps = {
    'forms': {},
    'metadata' : document.getElementsByName('application-name')[0].dataset
};

// Document Ready
document.addEventListener('DOMContentLoaded', function () {
    // Apps object
    apps.forms['settings'] = document.getElementById('frmSettings');

    // Submit Profile Settings
    apps.forms['settings'].addEventListener('submit', function (e) {
        e.preventDefault();

        var layer = document.getElementById('layerSettings');

        var body = 'division=' + encodeURIComponent(this.division.value) +
            '&name=' + encodeURIComponent(this.name.value) +
            '&mobile=' + encodeURIComponent(this.mobile.value) +
            '&_token=' + encodeURIComponent(apps.metadata.csrfToken);

        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function(){
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    alert('프로필이 저장되었습니다.');
                    layer.style.display = 'none';
                } else if (xhr.status === 200) {
                    alert('프로필은 빠진 항목 없이 입력해주세요.');
                } else {
                    alert('프로필 저장에 실패했습니다. 한 번 더 저장해주세요.');
                }
            }
        };
        xhr.open('PATCH', '/api/app/users/' + apps.metadata.kakaoId, true);
        xhr.setRequestHeader('X-CSRF-Token', apps.metadata.csrfToken);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(body);
    });

    // Show Profile Settings
    (function () {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function(){
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    var user = JSON.parse(xhr.responseText);

                    if (!user.data.name || !user.data.mobile || !user.data.division) {
                        document.getElementById('layerSettings').style.display = 'block';
                    }
                } else {
                    document.getElementById('layerSettings').style.display = 'block';
                }
            }
        };
        xhr.open('GET', '/api/app/users/' + apps.metadata.kakaoId);
        xhr.setRequestHeader('X-CSRF-Token', apps.metadata.csrfToken);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();
    })();
});
