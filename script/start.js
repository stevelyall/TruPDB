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