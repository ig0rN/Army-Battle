<?php
function __autoload($c){
	require_once("classes/{$c}.php");
}


function dd($variable) {
	echo "<pre>";
    var_dump($variable);
    echo "</pre>";
	die();
}

