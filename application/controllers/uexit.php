<?php
 error_reporting(0);
	class uexit extends CI_Controller 
	{
		public function index()
		{
			$this->session->sess_destroy();
			echo '<script type="text/javascript">
            window.location.href = "/diplom/index.php/"
            </script>';
		}
	}

?>