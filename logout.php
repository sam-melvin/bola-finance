<?php
	session_start();
	session_unset();
	session_destroy();
?>
	<script>location.replace("./");</script>