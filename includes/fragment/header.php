<style>
    .topnav {
        overflow: hidden;
        background-color: #2cccc4;
        padding-top: 24px;
        padding-right: 24px;

    }

    #logo {
        float: left;
        padding-left: 24px;
        padding-top: 0px;
    }

    .topnav a {
        float: right;
        color: white;
        text-align: center;
        padding: 16px 18px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav #logo:hover {
        background-color: rgba(0, 0, 255, 0) !important
    }

    .topnav a.active {
        background-color: #04AA6D;
        color: white;
    }
</style>

<header>
    <div class="topnav">
        <a id="logo" href="index.php" title="logo">
            <img src="images/logo.png" width="224" height="50">
        </a>
        <?php if ($_SESSION["user_name"]) { ?>
            <b> <a href="logout.php">Logout</a></b>
        <?php } else { ?>
            <b> <a href="login.php">Login</a></b>
        <?php } ?>
        <b> <a href="register.php">Register</a></b>
        <b> <a href="https://sites.google.com/view/xxxxxxxxxxx">Path to Success</a></b>
        <b> <a href="manager.php">Manager</a></b>
        <b> <a href="index.php">Home</a></b>
    </div>
</header>