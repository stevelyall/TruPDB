var mousePositionX, mousePositionY;
var img = document.getElementById('image');
var timeSSE;

window.addEventListener('load', function() {
    // set up event handlers
    document.getElementById('menu-button').addEventListener('click', toggleMenuDisplayed);
    document.addEventListener('mousemove', function () {
        mousePositionX = event.clientX;
        mousePositionY = event.clientY;
    });


    (function setCancelButtonEvents() {
        var cancelBtns = document.getElementsByClassName('cancel-btn');

        for (var i = 0; i < cancelBtns.length; i++) {
            cancelBtns[i].addEventListener('click', hideBoxes);
        }
    })();
});



/* functions for showing and hiding menu */

function toggleMenuDisplayed() {
    //console.log('menu clicked');
    if (document.getElementsByTagName('nav')[0].style.display != 'block') {
        showMenu();
    }
    else {
        hideMenu();
    }

    img.setImageToMainCenterLocation();
}

function showMenu() {
    document.getElementsByTagName('nav')[0].style.display = 'block';
    //adjust body width
    document.getElementById('main').style.width = 'calc(100vw - 152px)';
    document.getElementById('main').style.position = 'relative';
    document.getElementById('main').style.left = '152px';
}

function hideMenu() {
    document.getElementsByTagName('nav')[0].style.display = 'none';
    //adjust body width
    document.getElementById('main').style.position = 'static';
    document.getElementById('main').style.width = '100vw';

}


function hideBoxes() {
    hideSignInBox();
    hideJoinBox();
    hideForgotPasswordBox();
}

function toggleSignInBoxDisplayed() {
    if (document.getElementById('signin-form').style.display == 'block') {
        hideSignInBox();
    }
    else {
        showSignInBox();
    }
}

function showSignInBox() {

    hideBoxes();
    document.getElementById('signin-form').style.display = 'block';
    document.getElementById('bg-dim').style.display = 'block';
    img.style.display = 'none';
    img.stopAnimation();
    hideMenu();
}

function hideSignInBox() {
    document.getElementById('signin-form').style.display = 'none';
    document.getElementById('bg-dim').style.display = 'none';
    img.style.display = 'block';
    img.setImageToMainCenterLocation();
    img.startAnimation();
    hideMenu();
}

function toggleJoinBoxDisplayed() {
    if (document.getElementById('join-form').style.display == 'block') {
        hideJoinBox();
    }
    else {
        showJoinBox();
    }
}

function showJoinBox() {
    hideBoxes();
    document.getElementById('join-form').style.display = 'block';
    document.getElementById('bg-dim').style.display = 'block';
    img.style.display = 'none';
    img.stopAnimation();
    hideMenu();
}

function hideJoinBox() {
    document.getElementById('join-form').style.display = 'none';
    document.getElementById('bg-dim').style.display = 'none';
    img.style.display = 'block';
    img.setImageToMainCenterLocation();
    img.startAnimation();
    hideMenu();
}

function toggleForgotPasswordBoxDisplayed() {
    if (document.getElementById('forgot-password-form').style.display == 'block') {
        hideForgotPasswordBox();
    }
    else {
        showForgotPasswordBox();
    }
}

function showForgotPasswordBox() {
    hideBoxes();
    document.getElementById('forgot-password-form').style.display = 'block';
    document.getElementById('bg-dim').style.display = 'block';
    img.style.display = 'none';
    img.stopAnimation();
    hideMenu();
}

function hideForgotPasswordBox() {
    document.getElementById('forgot-password-form').style.display = 'none';
    document.getElementById('bg-dim').style.display = 'none';
    img.style.display = 'block';
    img.setImageToMainCenterLocation();
    img.startAnimation();
    hideMenu();
}

function startTimeUpdatesFromServer() {
    var timeUpdateURI = 'updateTime.php';
    timeSSE = new EventSource(timeUpdateURI);

    timeSSE.addEventListener('updateTime', function(event) {
            //console.log('time updated ' + event.data);
            document.getElementById('main-date-time').innerHTML = event.data;
        }
    );
}

function stopTimeUpdatesFromServer() {
    timeSSE.close();
    //console.log('time updates stopped');
}