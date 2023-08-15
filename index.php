<!DOCTYPE html>
<html>
  <head>
    <title>Yunohost SSO</title>
  </head>
  <body>
<?php
    if (array_key_exists("REMOTE_USER", $_SERVER) && $_SERVER["REMOTE_USER"] != "") {
        echo "Welcome, " . $_SERVER["REMOTE_USER"] . "!";
        echo "<br><a href='/yunohost/portalapi/logout?referer_redirect'>Log out</a><br>";
    } else {
?>
    <form method="POST" action="/yunohost/portalapi/login?referer_redirect">
        <input type="text" name="username" id="username">
        <br><input type="password" name="password" id="password">
        <br><input type="submit">
    </form>
<?php
    }
?>
    <br><br>
<?php
    $headers = getallheaders();
    if (array_key_exists("Remote-User", $headers)) {
        if ($_SERVER["REMOTE_USER"] != $headers["Remote-User"]) {
            echo "FastCGI REMOTE_USER and HTTP Remote-User header do not match: " . $_SERVER["REMOTE_USER"] . " vs " . $headers["Remote-User"];
        } else {
            echo "FastCGI REMOTE_USER and HTTP Remote-User header match.";
        }
    } else {
        if (array_key_exists("REMOTE_USER", $_SERVER) && $_SERVER["REMOTE_USER"] != "") {
                echo "Missing HTTP header: Remote-User";
                foreach($headers as $key => $val) {
                        echo "<br>$key: $val";
                }
        }
    }
?>
  </body>
</html>
