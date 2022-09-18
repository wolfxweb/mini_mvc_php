<?php


require_once"../vendor/autoload.php";

$route = new  \App\Route;


echo"<pre>";
var_dump($route->getRoutes());
echo"</pre>";