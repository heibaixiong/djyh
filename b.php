<?php
class bigclass(){
	private $a;
	$a=11;
	function __get($name){
		echo $this->$name;
	}
}
$ob=new bigclass();
echo $ob->a;
?>