<?php


class Session{
   
   // DECLARING PROPERTIES FOR SESSION CLASS 
   private $signed_in = false;
   public  $user_id;
   public  $count;
   public  $message;
   


   function __construct(){
   	session_start();
   	$this->check_the_login();
      $this->visitor_count();
      $this->check_message();
   } //END OF CONSTUCT METHOD

   
   public function is_signed_in(){
   	 return $this->signed_in;
   }// END OF A GETTER METHOD(IS_SIGNED_IN) 


   public function visitor_count(){
      if(isset($_SESSION['count'])){
         return $this->count = $_SESSION['count']++;
      }else{
         return $_SESSION['count'] = 1;
      }

   }// END OF VISITOR_COUNT METHOD


   private function check_message(){
      if(isset($_SESSION['message'])){
         $this->message = $_SESSION['message'];
         unset($_SESSION['message']);
      
      }else{
         $this->message = "";
      }

   }//END OF CHECK_MESSAGE METHOD


   public function message($msg =""){
      if(!empty($msg)){
         $_SESSION['message'] = $msg;
       }else{
         return $this->message;
      }
   }//END OF MESSAGE METHOD



   public function login($user){
   	if($user){
   		$this->user_id = $_SESSION['user_id'] = $user->id;
   		$this->signed_in = true;
   	}
   }// END OF LOGIN METHOD


   public function logout(){
   	unset($_SESSION['user_id']);
   	unset($this->user_id);
   	$this->signed_in = false;
   }// END OF LOGOUT METHOD


   private function check_the_login(){
	if(isset($_SESSION['user_id'])){
		$this->user_id = $_SESSION['user_id'];
		$this->signed_in = true;
	}else{
		unset($this->user_id);
		$this->signed_in = false;
	}
   }// END OF CHECK SIGNED IN METHOD



}

//SESSION INSTANTIATION
$session = new Session();
$message = $session->message();







?>