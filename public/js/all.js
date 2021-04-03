// Init
apps = {
    'forms': {},
    'methods': {},
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
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
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

    // Show Profile Settings Automatically
    (function () {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var user = JSON.parse(xhr.responseText);

                    // Fill previous info
                    if(user.data.division) {
                        document.querySelector('#frmSettings input[value="' + user.data.division + '"]').checked = true;
                    }

                    if(user.data.name) {
                        document.querySelector('#frmSettings input[name=name]').value = user.data.name;
                    }

                    if(user.data.mobile) {
                        document.querySelector('#frmSettings input[name=mobile]').value = user.data.mobile;
                    }

                    // Show layer if there are empty info.
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

    // Event Handler: Profile Setting
    document.getElementById('button_profile').addEventListener('click', e => {
        document.getElementById('layerSettings').style.display = 'block';
    })

    // Event Handler: Checking Read it or not
    Object.values(document.getElementsByTagName('button')).forEach(o => {
        o.addEventListener('click', e => {
            e.preventDefault();

            var body = 'chapter_id=' + o.dataset.chapter +
                '&_token=' + encodeURIComponent(apps.metadata.csrfToken);


            var xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    switch(xhr.status) {
                        case 200:
                            o.dataset.read = 'n';
                            break;

                        case 201:
                            o.dataset.read = 'y';
                            break;
                    }
                }
            };

            if (o.dataset.read == 'y') {
                xhr.open('DELETE', '/api/app/reads/' + o.dataset.chapter, true);
            } else {
                xhr.open('POST', '/api/app/reads', true);
            }
            xhr.setRequestHeader('X-CSRF-Token', apps.metadata.csrfToken);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(body);
        });
    });


});
