<?php
include 'inc/dbcon.php';
include 'inc/header.php';


if (isset($_GET['chalan']) && $_GET['chalan'] != '') {
    $chalan = $_GET['chalan'];

    $query = mysqli_query($con, "delete from transaction where chalan_no = '$chalan'");

    redirect('invoice.php');
} else {
    redirect('invoice.php');
}
