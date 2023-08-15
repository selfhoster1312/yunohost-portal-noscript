<?php
	require_once 'vendor/autoload.php';
	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig = new \Twig\Environment($loader, [
	    //'cache' => 'compilation_cache',
	]);

	$env = [];
	$logged_in = false;
	if (array_key_exists("REMOTE_USER", $_SERVER) && $_SERVER["REMOTE_USER"] != "")  {
		$logged_in = true;
		$env["user"] = $_SERVER["REMOTE_USER"];
		$headers = getallheaders();
		if (array_key_exists("Remote-User", $headers)) {
			$env["http_user"] = $headers["Remote-User"];
		}
	}
	
	if ($logged_in == true) {
		$env["headers"] = getallheaders();
		echo $twig->render("panel.html.twig", $env);
	}
	else {
		echo $twig->render("login.html.twig", []);
	}
?>
