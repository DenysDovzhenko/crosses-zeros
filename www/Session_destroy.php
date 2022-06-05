<?php
	$sessionName = session_name();
	if (isset($_COOKIE[$sessionName]) || isset($_REQUEST[$sessionName])){
		session_start();
		session_destroy();
	}
?>