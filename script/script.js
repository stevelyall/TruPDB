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

	if (img != undefined) {
        img.setImageToMainCenterLocation();
	}
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