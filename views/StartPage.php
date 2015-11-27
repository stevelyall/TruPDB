<html>
<head>

    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div id="bg-dim"></div>
    <header>
        <img id="menu-button" src="../images/menuicon.png" alt="Menu">
        <?php
        // greeting for returning user
        if (isset($_COOKIE['greeting_user'])) {
            echo "<h3 id='greeting'>Welcome back, " . $_COOKIE['greeting_user'] . "!</h3>";
        }
        ?>
        <h1 id="title" class="horizontal-center">TRU Personal DB</h1>
        <h3 class="date-time">
            <?php
                date_default_timezone_set('America/Vancouver');
                echo date("Y-m-d H:i:s", time());
            ?>
        </h3>
    </header>

    <nav>
        <div id='sign-in-button' class="menu-item"><p>Sign In</p></div>
        <div id='join-button' class="menu-item"><p>Join</p></div>
        <div id='forgot-password-button' class="menu-item"><p>Forgot Password</p></div>
        <div id='public-search-button' class="menu-item"><p>Public Search</p></div>
    </nav>

    <section id="main">
        <img id="image" src="../images/tru_logo.png" alt="TRU">

        <form class="form-box" id='signin-form'
              method='post' action='../controller.php'>
            <input type='hidden' name='page' value='StartPage'>
            <input type='hidden' name='command' value='SignIn'>
            <div class="input-center">
                <h3>Sign In</h3>
                <label for="username-signin">Username</label>
                <input id="username-signin" type='text' autocomplete="on" name='username'
                    value="<?php if (!empty($username)) echo $username ?>">
                <span id="signin-username-error"><?php if (!empty($error_msg_username)) echo $error_msg_username; ?></span>
                 <br>
                <label for="password-signin">Password</label>
                <input id="password-signin" type='password' name='password'
                                 value="<?php if (!empty($password)) echo $password ?>">
                <span id="signin-password-error"><?php if (!empty($error_msg_password)) echo $error_msg_password; ?></span>
                <br>
                <span><?php if (!empty($error_msg_login)) echo $error_msg_login; ?></span>
            </div>
            <input class='cancel-btn' type='button' value='Cancel'>
            <input class='submit-btn' type='submit' value='Sign In'>

        </form>

        <form class="form-box" id='join-form'
              method='post' action='../controller.php'>
            <input type='hidden' name='page' value='StartPage'>
            <input type='hidden' name='command' value='Join'>
            <div class="input-center">
                <h3>Join</h3>
                <label for="username-join">Username</label>
                <input id="username-join" type='text' autocomplete="on" name='username'
                       value="<?php if (!empty($username)) echo $username ?>">
                <span id="join-username-error"><?php if (!empty($error_msg_username)) echo $error_msg_username; ?></span>
                <br>
                <label for="name-join">Full Name</label>
                <input id="name-join" type='text' autocomplete="on" name='name'
                       value="<?php if (!empty($name)) echo $name ?>">
                <span id="join-email-error"><?php if (!empty($error_msg_name)) echo $error_msg_name; ?></span>
                <br>
                <label for="email-join">Email</label>
                <input id="email-join" type='email' autocomplete="on" name='email'
                       value="<?php if (!empty($email)) echo $email ?>">
                <span id="join-email-error"><?php if (!empty($error_msg_email)) echo $error_msg_email; ?></span>
                <br>
                <label for="password-join">Password</label>
                <input id="password-join" type='password' name='password'
                       value="<?php if (!empty($password)) echo $password ?>">
                <span id="join-password-error"><?php if (!empty($error_msg_password)) echo $error_msg_password; ?></span>
                <br>
                <label for="passwordconfirm-join">Confirm</label>
                <input id="passwordconfirm-join" type='password' name='passwordconfirm'
                       value="<?php if (!empty($password_confirm)) echo $password_confirm ?>">
                <span><?php if (!empty($error_msg_password_confirm)) echo $error_msg_password_confirm; ?></span>
            </div>

            <input class='cancel-btn' type='button' value='Cancel'>
            <input id="join-submit-btn" class="submit-btn" type='button' value='Create Account'>
        </form>

        <form class="form-box" id='forgot-password-form'
              method='post' action='../controller.php'>
            <input type='hidden' name='page' value='StartPage'>
            <input type='hidden' name='command' value='ForgotPassword'>
            <div class="input-center">
                <h3>Forgot Password</h3>
                <label for="email-forgotpassword">Email</label>
                <input id="email-forgotpassword" type='email' autocomplete="on" name='email'
                       value="<?php if (!empty($email)) echo $email ?>">
                <span><?php if (!empty($error_msg_email)) echo $error_msg_email; ?></span>
            </div>

            <input class='cancel-btn' type='button' value='Cancel'>
            <input class="submit-btn" type='submit' value='Create Account'>
        </form>


    </section>



    <footer>
        <a target="_blank" href="http://cs.tru.ca"><h5 class="horizontal-center">About Us</h5></a>
    </footer>
</body>
<script src="../script/script.js"></script>
<script src="../script/formValidation.js"></script>
<script src="../script/imgAnimation.js"></script>
<script>



    window.addEventListener('load', function() {
        // set up page state depending which box state posted from
        var img = document.getElementById('image');

        (function setMenuButtonEvents() {
            document.getElementById('sign-in-button').addEventListener('click', toggleSignInBoxDisplayed);
            document.getElementById('join-button').addEventListener('click', toggleJoinBoxDisplayed);
            document.getElementById('forgot-password-button').addEventListener('click', toggleForgotPasswordBoxDisplayed);
        })();

        // sign in / join submit button handlers
        document.getElementById('join-submit-btn').addEventListener('click', joinFormButtonClick);

        <?php

        switch ($display_type) {
            case 'Start' :
                echo "console.log('{$display_type}');";
                echo '
                    img.startAnimation();
                    ';
                break;

            case 'SignIn' :
                echo "console.log('{$display_type}');";
                echo '
                    showSignInBox();
                    img.stopAnimation();
                    ';
                break;

            case 'Join' :
                echo "console.log('{$display_type}');";
                echo '
                    showJoinBox();
                    img.stopAnimation();
                    ';
                break;

             case 'ForgotPassword' :
                echo "console.log('{$display_type}');";
                echo '
                    showForgotPasswordBox();
                    img.stopAnimation();
                    ';
                break;

        }
        ?>
    });
</script>


</html>