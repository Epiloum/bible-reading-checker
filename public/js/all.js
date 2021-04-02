// Init
apps = {
    'forms': {}
};

// Document Ready
document.addEventListener('DOMContentLoaded', function () {
    // Apps object
    apps.forms['settings'] = document.getElementById('frmSettings');

    // Settings
    apps.forms['settings'].addEventListener('submit', function (e) {
        e.preventDefault();

        var layer = document.getElementById('layerSettings');

        var body = 'division=' + this.division.value
            + '&name=' + this.name.value
            + '&mobile=' + this.mobile.value;

        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function(){
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    alert('프로필이 저장되었습니다.');
                    layer.style.display = 'none';
                }
                else
                {
                    alert('프로필 저장에 실패했습니다. 한 번 더 저장해주세요.');
                }
            }
        };
        xhr.open('PATCH', '/api/app/users/' + this.kid.value, true);
        xhr.send(body);
    })
});
