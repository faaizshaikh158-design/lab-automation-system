<?php
$conn = mysqli_connect("localhost","root","","lab_automation");

if(!$conn){
    die("Database Connection Failed".mysqli_connect_error());
}
?>