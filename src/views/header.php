<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PHP Login App bd-index-custom-example">
        <title>Core PHP + Okta Login Example </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    </head>
    <body class="layout-default">
        <nav id="navbar" class="navbar has-shadow is-spaced">
            <div class="container">
            <div class="content">
                <h1>Core PHP + Okta Login Example</h1>
                <?php
                    if (isset($_SESSION['username'])) {
                ?>
                        <p>
                            Logged in as <?php echo $_SESSION['username'] ?>
                        </p>
                        <p><a href="/?logout">Log Out</a></p>
                <?php 
                    } else {
                ?>
                        <p>Not logged in</p>
                        <p><a href="/?login">Log In</a> | <a href="/?forgot">Forgot Password</a> | <a href="/?register">Register</a></p>
                <?php
                    }
                ?>
            </div>
            </div>
        </nav>
