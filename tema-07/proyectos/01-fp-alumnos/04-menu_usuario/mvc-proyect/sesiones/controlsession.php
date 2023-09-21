<?php


	function sec_session_start() {
		
		$session_name = 'sec_session_id';
		$secure = false;
		$httponly = true;
		
		if (ini_set('session.use_only_cookies', 1) === FALSE) {
			header("Location: index.php");
			exit();
		}
		
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"],$cookieParams["path"], $cookieParams["domain"], $secure,$httponly);
		
		session_name($session_name);
		session_start();            
		session_regenerate_id();
	}

	function sec_session_destroy() {

		session_destroy();
		session_unset();

	}

	
?>