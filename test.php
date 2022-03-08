<?php


class A {
	public static function who(){
		echo __CLASS__;
	}

	public static function test(){
		static::who();
	}
}

class B extends A{
   public static function who(){
   	   echo __CLASS__;
   }
}

B::test();


//define('SP', DIRECTORY_SEPARATOR);
define('SP', '/');
echo SP;


?>