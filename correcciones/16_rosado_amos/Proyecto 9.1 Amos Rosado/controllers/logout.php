<?php

    class Logout Extends Controller {

        function render() {

            sec_session_start();

            $_SESSION = [];

   
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            sec_session_destroy();

            header("location:".URL."index");
        }
    }

?>