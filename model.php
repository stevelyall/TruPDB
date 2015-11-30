<?php

// db for production
if ($_SERVER['SERVER_NAME'] == 'cs.tru.ca') {
	$conn = mysqli_connect("localhost", "slyall3540f15", "Password1", "COMP3540F15_slyall");
}
// development
else {
	$conn = mysqli_connect("127.0.0.1", "root", "", "COMP3540F15_slyall");


}

if (mysqli_connect_errno()) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
}

function validate_user($username, $password) {
    global $conn;
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function create_user($username, $password, $name, $email) {
    global $conn;
    $sql = "INSERT INTO user VALUES ('$username','$password','$name','$email')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function usernameExists($username) {
    global $conn;
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function createMemo($title, $memo, $isPrivate){
	global $conn;

	$date = date("Y-m-d H:i:s");
	$sql = "INSERT INTO memo (private, title, memo, datetime, username) " .
		"VALUES ({$isPrivate}, '{$title}', '{$memo}', '{$date}', '{$_SESSION['username']}');";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		return false;
	}
}

function get10MostRecentMemos() {
	global $conn;
	session_start();
	$sql = "SELECT * FROM memo WHERE private = 0 OR private = 1 AND username = '{$_SESSION['username']}' ORDER BY datetime DESC LIMIT 10";
	$result = mysqli_query($conn, $sql);
	return $result;
}

function searchMemosForTerms($searches) {
	global $conn;
	session_start();
	$sql = "SELECT * FROM memo WHERE private = 0";

	for ($i = 0; $i < count($searches); $i++) {
		$sql .= " AND memo LIKE '%{$searches[$i]}%' OR title LIKE '%{$searches[$i]}%'";
	}
	$sql .= "OR private = 1 AND username = '{$_SESSION['username']}'";

	for ($i = 0; $i < count($searches); $i++) {
		$sql .= " AND memo LIKE '%{$searches[$i]}%' OR title LIKE '%{$searches[$i]}%'";
	}


//	/var_dump($sql);
	$result = mysqli_query($conn, $sql);
	return $result;

}
?>