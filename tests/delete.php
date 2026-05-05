<?php
include "../lab-system/db.php";

if(!isset($_GET['id'])){
    die("<script>alert('Product Not Found')</script>");
    header("Location: list.php");
    exit;
}

$id = $_GET['id'];

$query = "DELETE FROM tests WHERE id = $id";

mysqli_query($conn, $query);

header("Location: list.php");
?>