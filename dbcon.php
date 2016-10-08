<?php
const DB_HOST = 'nikolajdommergaard.dk.mysql';
const DB_USER = 'nikolajdommerga';
const DB_PASS = 'GHAdaJqK';
const DB_NAME = 'nikolajdommerga';
$link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($link->connect_error) { 
   die('Connect Error ('.$link->connect_errno.') '.$link->connect_error);
}
$link->set_charset("utf8"); 
?>