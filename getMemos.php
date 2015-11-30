<?php
//header("Content-Type:application/json");
require_once('model.php');
$memos = array();

//if (isset($_SESSION['username'])) {


	if (count($_GET) > 0) {
		//search
		$result = searchMemosForTerms($_GET);

		while ($memo = mysqli_fetch_assoc($result)) {
			array_push($memos, $memo);
		}


	}
	else {
		// no params, list 10 most recent
		$result = get10MostRecentMemos();

		while ($memo = mysqli_fetch_assoc($result)) {
			array_push($memos, $memo);
		}
	}

echo json_encode($memos);

//}
//else {
//	echo "Not authorized";
//	exit();
//}
//
