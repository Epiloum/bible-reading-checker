// Init
apps = {
    'forms': {},
    'methods': {},
    'metadata' : document.getElementsByName('application-name')[0].dataset
};

// Methods
apps.methods.showToastMsg = function (msg) {
    var elm = document.getElementById('toast_msg');
    var cra = elm.cloneNode(true);
    elm.parentNode.replaceChild(cra, elm);

    cra.innerHTML = msg;
    cra.style.display = 'inline-block';

    setTimeout(function () {
        cra.style.display = 'none';
    }, 3500);
};

apps.methods.toggleNav = function () {
    var o = document.getElementsByTagName('nav')[0];
    o.className = (o.className == 'show')? '': 'show';
}

apps.methods.drawPieGraph = function (canvas, data) {
    const ctx = canvas.getContext('2d');

    // calculate total value of data
    const total = data.reduce((acc, value) => acc + value);

    // set the center of the pie chart
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;

    // set the radius of the pie chart
    const radius = Math.min(centerX, centerY) * 0.98;

    // define starting and ending angles for each wedge
    let startAngle = Math.PI / -2;
    let endAngle = 0;

    // loop through the data and draw each wedge
    let ord = 0;
    let colors = ['#E74C3C', '#EEEEEE'];

    data.forEach((value) => {
        // calculate the percentage of this wedge
        const percentage = value / total;

        // calculate the ending angle for this wedge
        endAngle = startAngle + percentage * Math.PI * 2;

        // draw the wedge
        ctx.beginPath();
        ctx.moveTo(centerX, centerY);
        ctx.arc(centerX, centerY, radius, startAngle, endAngle);
        ctx.closePath();

        // generate a random color for this wedge
        ctx.fillStyle = colors[ord++];
        ctx.fill();

        // update the starting angle for the next wedge
        startAngle = endAngle;
    });
}

// Document Ready
document.addEventListener('DOMContentLoaded', function () {
    // Init
    var o;

    // Apps object
    apps.forms['settings'] = document.getElementById('frmSettings');

    // Submit Profile Settings
    apps.forms['settings'].addEventListener('submit', function (e) {
        e.preventDefault();

        var layer = document.getElementById('layerSettings');

        var body = 'division=' + encodeURIComponent(this.division.value) +
            '&name=' + encodeURIComponent(this.name.value) +
            '&mobile=' + encodeURIComponent(this.mobile.value) +
            '&target_date=' + encodeURIComponent(this.target_date.value) +
            '&_token=' + encodeURIComponent(apps.metadata.csrfToken);

        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    apps.methods.showToastMsg('프로필이 저장되었습니다.');
                    layer.style.display = 'none';
                } else {
                    apps.methods.showToastMsg('프로필 저장에 실패했습니다.<br />빠진 내용이 없나 한 번 더 확인해주세요.');
                }
            }
        };
        xhr.open('PATCH', '/api/app/users/' + apps.metadata.userId, true);
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

                    if(user.data.target_date) {
                        document.querySelector('#frmSettings input[name=target_date]').value = user.data.target_date;
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
        xhr.open('GET', '/api/app/users/' + apps.metadata.userId);
        xhr.setRequestHeader('X-CSRF-Token', apps.metadata.csrfToken);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();
    })();

    // Draw a pie graph for count reading
    (function() {
        let canvas = document.getElementById('canvas_read_count');
        let count = parseInt(canvas.dataset.readCount, 10);

        apps.methods.drawPieGraph(canvas, [count, 1189 - count])
        document.getElementById('stat_count').innerHTML = count + '장 완료';
        document.getElementById('stat_rate').innerHTML = '(' + (Math.floor(count / 1189 * 10000) / 100) + '%)';
    })();

    // Event Handler: Toggle Navigation UI
    if(o = document.getElementById('button_nav')) {
        o.addEventListener('click', e => {
            apps.methods.toggleNav();
        });

        // Event Handler: Shortcut on Navigation
        (function () {
            var els = document.querySelectorAll('nav dd');

            for(var i=0; i<els.length; i++) {
                let o = els[i];
                o.addEventListener('click', e => {
                    document.getElementById(o.dataset['to']).scrollIntoView();
                    window.scrollBy(0, -1 * document.getElementsByTagName('header')[0].clientHeight);
                    apps.methods.toggleNav();
                    apps.methods.showToastMsg(o.innerText + ' 위치로 이동하였습니다.');
                });
            }
        })();
    }

    // Event Handler: Profile Setting
    if(o = document.getElementById('button_profile')) {
        o.addEventListener('click', e => {
            document.getElementById('layerSettings').style.display = 'block';
        });
    }

    // Event Handler: Back Button
    if(o = document.getElementById('button_back')) {
        o.addEventListener('click', e => {
            history.back();
        });
    }

    // Event Handler: Tickets
    if(o = document.getElementById('button_tickets')) {
        o.addEventListener('click', e => {
            location.href = '/app/tickets';
        });
    }

    // Event Handler: Checking Read it or not
    Object.values(document.getElementsByTagName('main')[0].getElementsByTagName('button')).forEach(o => {
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

    document.querySelector('#btn_init button').addEventListener('click', function () {
        if (confirm('모든 성경읽기 표시가 지워집니다. 초기화를 진행하겠습니까?')) {
            let xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 204) {
                        alert('초기화가 완료되었습니다.');
                        location.reload();
                    }
                }
            };
            xhr.open('DELETE', '/api/app/reads/init', true);
            xhr.setRequestHeader('X-CSRF-Token', apps.metadata.csrfToken);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send();
        }
    })
});
