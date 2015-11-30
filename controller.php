<!-- Controller -->

<?php
// redirect to https, but only on production env
if (!isset($_SERVER['HTTPS']) && $_SERVER['SERVER_NAME'] == 'cs.tru.ca') {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  // https and http_host
    header("Location: " . $url);  // should be before any output; location is changed to the new $url
    // with redirect status code
    exit;
}

require_once("model.php");

// $page - To distinguish StartPage and MainPage
if (empty($_POST['page']))  // If it is empty
    $page = 'StartPage';  // Let's start with the StartPage.
else
    $page = $_POST['page'];
// commands or actions for StartPage or MainPage
if (empty($_POST['command'])) // If it is empty
    $command = '';
else
    $command = $_POST['command'];

if ($page == 'StartPage')
{
    session_start();
    if (isset($_SESSION['username'])) {
        include('views/MainPage.php');
        exit();
    }

    switch($command) {

        // If it is the first time, then display the 'Start' page. In this exercise, the 'Start' page display the 'SignIn' form.
        case '':  // Not command was sent
            $display_type = 'Start';
            // Display the 'StartPage' page with the display type 'Start'
            include('views/StartPage.php');  // ViewStart
            exit();

        // It is not the first time. The user sent data.
        case 'SignIn':  // 'SignIn' action
            // Get username
            if (empty($_POST['username']))  // If username is empty
                $error_msg_username = '*required';
            else  // username
                $username = $_POST['username'];  // in order to redisplay

            // Get password
            if (empty($_POST['password']))  // If password is empty
                $error_msg_password = '*required';  // error message for the missing password
            else
                $password = sha1($_POST['password']);

            // If anyone of them is not missing
            if (empty($error_msg_username) && empty($error_msg_password)) { // If none of them is missing, then display the main page.
                if (validate_user($username, $password)) {
                    $_SESSION['username'] = $username;
                    setcookie('greeting_user', $username); // cookie for greeting when user returns before sign in (ass 7)
                    $display_type = "Main";
	                include('views/MainPage.php');  // ViewMain
                } else {
                    $display_type = 'SignIn';
                    $error_msg_login = 'invalid login credentials';
                    include('views/StartPage.php');
                }
            }
            // If anyone of them is missing, then redisplay with the 'SignIn' box
            else {
                $display_type = 'SignIn';  // If anyone of them is missing, then redisplay the StartPage with the 'SignIn' form having error messages.
                include('views/StartPage.php');  // ViewStart
            }

            exit();  // exit

        case 'Join':
            $display_type = 'Join';

            // Get username
            if (empty($_POST['username'])) {  // If username is empty
                $error_msg_username = '*required';
            }
            else if (usernameExists($_POST['username'])) {
                $error_msg_username = 'Username already exists';
            }
            else { // username
                $username = $_POST['username'];  // in order to redisplay
            }

            //get name
            if (empty($_POST['name']))  // If username is empty
                $error_msg_name = '*required';
            else  // username
                $name = $_POST['name'];  // in order to redisplay

            //get email
            if (empty($_POST['email']))  // If username is empty
                $error_msg_email = '*required';
            else  // username
                $email = $_POST['email'];  // in order to redisplay

            // Get password
            if (empty($_POST['password']))  // If password is empty
                $error_msg_password = '*required';  // error message for the missing password
            else
                $password = sha1($_POST['password']);

            // Get password confirm
            if (empty($_POST['passwordconfirm']))  // If password is empty
                $error_msg_password_confirm = '*required';  // error message for the missing password
            else
                $password_confirm = sha1($_POST['passwordconfirm']);

            // If anyone of them is not missing
            if (empty($error_msg_username) && empty($error_msg_name) && empty($error_msg_password) && empty($error_msg_password_confirm) && empty($error_msg_email)) {  // If none of them is missing, then display the main page.
                if(create_user($username, $password, $name, $email)) {
                    $display_type = 'SignIn';   // go to sign in
                    include('views/StartPage.php');
                }
                else {
                    echo "derp";
                    $error_msg_name = "An error occurred.";
                }
            }
            // If anyone of them is missing, then redisplay with the 'SignIn' box
            else {
                $display_type = 'Join';  // If anyone of them is missing, then redisplay the StartPage with the 'SignIn' form having error messages.
                include('views/StartPage.php');  // ViewStart
            }
            exit();

        case 'ForgotPassword':
            //get email
            if (empty($_POST['email']))  // If username is empty
                $error_msg_email = '*required';
            else  // username
                $email = $_POST['email'];  // in order to redisplay

            // If anyone of them is not missing
            if (empty($error_msg_email)) { // If none of them is missing, then display the main page.
                $display_type = 'SignIn';   // go to sign in
                include('views/StartPage.php');
            }
            // If anyone of them is missing, then redisplay with the 'SignIn' box
            else {
                $display_type = 'ForgotPassword';  // If anyone of them is missing, then redisplay the StartPage with the 'SignIn' form having error messages.
                include('views/StartPage.php');  // ViewStart
            }
            exit();

        default:
            $display_type = 'Start';
            include('views/StartPage.php'); // ViewStart
            exit();
    }
}

else if ($page == 'MainPage') {
    session_start();
    switch ($command) {
        case 'SignOut' :
            // sign out
            session_unset();
            session_destroy();
            $display_type = 'Start';
            include('views/StartPage.php'); // ViewStart
            exit();

	    case 'Post' :
			$display_type = "Post";
		    // post memo
		    $title = htmlspecialchars($_POST['title']);
		    $memo = htmlspecialchars($_POST['memo']);
		    $isPrivate = (empty($_POST['private'])) ? 0 : 1;
		    createMemo($title, $memo, $isPrivate);
			echo "<script>alert('Memo posted successfully.');</script>";
		    include('views/MainPage.php');
		    exit();

	    default :
		    $display_type = 'Main';
		    include('views/MainPage.php'); // ViewStart
		    exit();
    }
}

else {
}

?>
