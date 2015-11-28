<?php
header("Content-Type:application/json");

//if (isset($_SESSION['username'])) {
	require_once('model.php');
	$result = get10MostRecentMemos();

	$memos = array();

	while ($memo = mysqli_fetch_assoc($result)) {
		array_push($memos, $memo);
	}

	echo json_encode($memos);
//}
//else {
//	echo "Not authorized";
//	exit();
//}
//
