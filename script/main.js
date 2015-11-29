var timeSSE;
var memoListDocument;

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
	hideMemos();
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

function toggleMemosDisplayed(action) {
	if (document.getElementById('list-search').style.display == 'block') {
		hideMemos();
	}
	else {
		if (action == 'search') {
			searchMemos();
		}
		else {
			listMemos();
		}
		showMemos();
	}
}

function showMemos() {

	hideBoxes();
	document.getElementById('list-search').style.display = 'block';
	hideMenu();
}

function hideMemos() {
	document.getElementById('list-search').style.display = 'none';
	hideMenu();
}

function setMemoListDocument(frame) {
	memoListDocument = (frame.contentDocument || frame.contentWindow);
}

function listMemos() {
	var heading = memoListDocument.getElementById('header-row') ;
	clearMemoList(heading);
	memoListDocument.getElementById('memo-list-heading').innerHTML = "10 Most Recent Memos";
	var memos;
	var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		memoListDocument.getElementById('msg-load').style.display = "block";
		if (request.readyState == 4 && request.status == 200) {
			memos= JSON.parse(request.responseText);
			memos.forEach(function (memo) {
				addMemoRow(memo);
			});
			startTimeUpdatesFromServer();
			memoListDocument.getElementById('msg-load').style.display = "none";
		}
	};
	request.open("GET", "getMemos.php", true);
	stopTimeUpdatesFromServer();
	request.send();
	console.log('list');
	console.log()
}

function searchMemos() {
	// TODO search for memos and display results
	console.log('search');

}

function addMemoRow(memo) {
	console.log(memo);

	var memoTable = memoListDocument.getElementsByTagName('table')[0];

	var row = document.createElement('tr');
	var date = document.createElement('td');
	date.innerHTML = memo.datetime;

	var title = document.createElement('td');
	title.innerHTML = memo.title;

	var text = document.createElement('td');
	text.innerHTML = memo.memo;

	var username = document.createElement('td');
	username.innerHTML = memo.username;

	row.appendChild(date);
	row.appendChild(title);
	row.appendChild(text);
	row.appendChild(username);

	memoTable.appendChild(row);
}

function clearMemoList(heading) {
	var memoTable = memoListDocument.getElementsByTagName('table')[0];
	while (memoTable.firstChild) {
		memoTable.removeChild(memoTable.firstChild);
	}
	memoTable.appendChild(heading);
}

// TODO fix memo list alignment when menu open