<?php
	
	if (!($_SESSION['PROFILE']['role']=="admin")){

		header("location:$_SERVER[HTTP_REFERER]");
	}
?>