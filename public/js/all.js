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

        /*
        var body = 'division=' + this.getElementsByName('division').value
            + '&name=' + this.getElementsByName('name').value
            + '&mobile=' + this.getElementsByName('mobile').value;

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
        xhr.open('POST', '/api/settings', true);
        xhr.send(body);
        */

        alert('아직 만드는 중이어서 프로필은 저장되지 않아요!');
        layer.style.display = 'none';
    })
});
