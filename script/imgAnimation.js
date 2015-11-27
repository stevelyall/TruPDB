
// update logo position by 1px in X and Y direction
function updateImagePosition() {
    var imgLocY = img.getBoundingClientRect().top;
    var imgLocX = img.getBoundingClientRect().left;


    if (!img.isWithinMainContentSection()) {
        return;
    }

    //x
    if (mousePositionX > imgLocX) {
        img.moveX('right', 1);
    }
    else if (mousePositionX < imgLocX) {
        img.moveX('left', 1);
    }
    else {
        // don't move
    }

    if (mousePositionY > imgLocY) {
        img.moveY('down', 1);
    }
    else if (mousePositionY < imgLocY) {
        img.moveY('up', 1);
    }
    else {
        // don't move
    }
}

/* image movement functions */

img.startAnimation = function() {
    clearInterval(img.timer);
    img.timer = window.setInterval(updateImagePosition, 100);  // update logo position 1px every 100ms = 10px per second
};

img.stopAnimation = function() {
    clearInterval(img.timer);
};

img.moveY = function(direction, toMove) {
    var imgLocY = img.getBoundingClientRect().top;

    if (direction === 'up') {
        img.style.top = imgLocY - toMove + "px";
    }
    if (direction === 'down') {
        img.style.top = imgLocY + toMove + "px";
    }
};

img.moveX = function(direction, toMove) {
    var imgLocX = img.getBoundingClientRect().left;

    if (direction === 'left') {
        img.style.left = imgLocX - toMove + "px";
    }
    if (direction === 'right') {
        img.style.left = imgLocX + toMove + "px";
    }
};

img.setImageToMainCenterLocation = function() {
    if (img.isWithinMainContentSection()) {
        return;
    }
    var x = (document.getElementById('main').getBoundingClientRect().width/2) + 20;
    var y = document.getElementById('main').getBoundingClientRect().height/2;
    //console.log('x ' + x + ' y ' + y);
    img.style.left = x;
    img.style.top = y;
};

img.isWithinMainContentSection = function() {
    var imgLocX = this.getBoundingClientRect().left;
    var imgLocY = this.getBoundingClientRect().top;

    var mainSectionBounds = document.getElementById('main').getBoundingClientRect();
    // too far left
    if (imgLocX < mainSectionBounds.left) {
        // console.log('too far left');
        img.moveX('right', 1);
        return false;
    }
    if (imgLocX > mainSectionBounds.width - 81) {
        // console.log("too far right");
        img.moveX('left', 1);
        return false;
    }
    if (imgLocY < mainSectionBounds.top) {
        // console.log('too high');
        img.moveY('down', 1);
        return false;
    }
    if (imgLocY > mainSectionBounds.height - 25) {
        //console.log('too low');
        img.moveY('up', 1);
        return false;
    }
    return true;

};
