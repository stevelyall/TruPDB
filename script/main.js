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