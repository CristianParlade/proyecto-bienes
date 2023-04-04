<?php

function conectorDB():mysqli{
   //utilizamos new para crear un  nuevo onjeto 
   $db = new mysqli('localhost','root',41366,'bienesraices_crud');

   if(!$db){
    echo "No se conecto";
    exit;
   }
   return $db;


}