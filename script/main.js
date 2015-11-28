var timeSSE;

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

function signOutButtonClick() {
	stopTimeUpdatesFromServer();
	document.getElementById('return-to-start-page').submit();
}

function hideBoxes() {
	hidePostBox();
}

function togglePostBoxDisplayed() {
	if (document.getElementById('post-form').style.display == 'block') {
		hidePostBox();
	}
	else {
		showPostBox();
	}
}

function showPostBox() {

	hideBoxes();
	document.getElementById('post-form').style.display = 'block';
	document.getElementById('bg-dim').style.display = 'block';
	hideMenu();
}

function hidePostBox() {
	document.getElementById('post-form').style.display = 'none';
	document.getElementById('bg-dim').style.display = 'none';
	hideMenu();
}