<?php 

class Flash{

    const SUCCESS = "success";
    const DANGER  = "danger";


	public static function add_message($message, $type = "success"){
		if(! isset($_SESSION['flash_message'])){
            $_SESSION['flash_message'] = array();
		}

		$_SESSION['flash_message'][] = [
		'messaeg' => $message,
		'type' => $type
	];
	
}





}


 ?>