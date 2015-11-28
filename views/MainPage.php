<?php include_once('includes/head.php');?>

<body>
<div id="bg-dim"></div>
<header>
    <?php
    // greeting for returning user
    if (isset($_SESSION['username'])) {
        echo "<h3 id='greeting'>Signed in as " . $_SESSION['username'] . "</h3>";
    }
    ?>
    <img id="menu-button" src="images/menuicon.png" alt="Menu">
    <h1 id="title" class="horizontal-center">Main Page</h1>
    <h3 id="main-date-time" class="date-time"></h3>
</header>

<nav>
    <div id='post-button' class="menu-item"><p>Post</p></div>
    <div id='search-button' class="menu-item"><p>Search</p></div>
    <div id='list-button' class="menu-item"><p>List</p></div>
    <div id='sign-out-button' class="menu-item"><p>Sign Out</p></div>

    <form id="return-to-start-page" action="../controller.php" method="post">
        <input type="hidden" name="page" value="MainPage"/>
        <input type="hidden" name="command" value="SignOut"/>
    </form>

</nav>

<section id="main">


</section>



<footer>
    <a target="_blank" href="http://cs.tru.ca"><h5 class="horizontal-center">About Us</h5></a>
</footer>
</body>
<script src="script/script.js"></script>
<script src="script/main.js"></script>
<script>

    window.addEventListener('load', function() {
        (function setMenuButtonEvents() {
            document.getElementById('sign-out-button').addEventListener('click', signOutButtonClick);
        })();
        startTimeUpdatesFromServer();

        function signOutButtonClick() {
            stopTimeUpdatesFromServer();
            document.getElementById('return-to-start-page').submit();
        }
    });


</script>


</html>