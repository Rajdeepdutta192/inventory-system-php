<?php
include 'inc/dbcon.php';

$chalan_no = mres($con, $_POST['chalan_no']);
$product_name = mres($con, $_POST['product_name']);
$quantity = mres($con, $_POST['quantity']);
$tran_type = mres($con, $_POST['tran_type']);
$date = date("Y-m-d");
$unit = mres($con, $_POST['unit']);


if ($_POST['tran_type'] == 'stock_in') {


    //updating total stock 
    $stock_in_select = mysqli_query($con, "select * from product where product_name = '$product_name'");
    $res = mysqli_fetch_assoc($stock_in_select);
    $new_total_stock = $res['total_stock'] + $quantity;
    $update_in_product_after_stockin = mysqli_query($con, "update product set total_stock = $new_total_stock where product_name = '$product_name'");


    //add new record in transaction table
    $insert_transaction = mysqli_query($con, "insert into transaction(product_name, chalan_no, tran_type, qty,unit, date) values('$product_name', '$chalan_no', '$tran_type', $quantity,'$unit', '$date')");

    if ($insert_transaction && $update_in_product_after_stockin) {
        echo 'stock in done';
    } else {
        echo 'something happened wrong';
    }

    //add new record in product_transaction table
    $check = mysqli_query($con, "select * from product_transaction where date = '$date' and product_name='$product_name'");
    $result = mysqli_fetch_assoc($check);
    if (mysqli_num_rows($check) > 0) {
        $new_stock_in = $result['stock_in'] + $quantity;
        $update_query = mysqli_query($con, "UPDATE product_transaction SET stock_in = $new_stock_in, closing=$new_total_stock where product_name = '$product_name' and date = '$date'");
    } else {

        $insert_query = mysqli_query($con, "insert into product_transaction values(NULL, '$product_name', '$quantity', '0', '0', '0', $new_total_stock, '$date')");
    }
}



if ($_POST['tran_type'] == 'dispatch') {
    //updating total stock 
    $dispatch_select = mysqli_query($con, "select * from product where product_name = '$product_name'");
    $res = mysqli_fetch_assoc($dispatch_select);
    if ($res['total_stock'] < $quantity) {
        echo 'You have ' . $res['total_stock'] . ' left, you cannot dispatch ' . $quantity . ' stock';
    } else {
        $new_total_stock = $res['total_stock'] - $quantity;
        $update_in_product_after_dispatch = mysqli_query($con, "update product set total_stock = $new_total_stock where product_name = '$product_name'");

        //add new record in transaction table
        $insert_transaction = mysqli_query($con, "insert into transaction(product_name, chalan_no, tran_type, qty,unit, date) values('$product_name', '$chalan_no', '$tran_type', $quantity,'$unit', '$date')");

        if ($insert_transaction && $update_in_product_after_dispatch) {
            echo 'dispatch done';
        } else {
            echo 'something happened wrong';
        }

        //add new record in product_transaction table
        $check = mysqli_query($con, "select * from product_transaction where date = '$date' and product_name='$product_name'");
        $result = mysqli_fetch_assoc($check);
        if (mysqli_num_rows($check) > 0) {
            $new_stock_in = $result['dispatch'] + $quantity;
            $update_query = mysqli_query($con, "UPDATE product_transaction SET dispatch = $new_stock_in, closing=$new_total_stock where product_name = '$product_name' and date = '$date'");
        } else {

            $insert_query = mysqli_query($con, "insert into product_transaction values(NULL, '$product_name',  '0', '$quantity', '0', '0', $new_total_stock, '$date')");
        }
    }
}



if ($_POST['tran_type'] == 'cancel') {
    //updating total stock 
    $cancel_select = mysqli_query($con, "select * from product where product_name = '$product_name'");
    $res = mysqli_fetch_assoc($cancel_select);
    $new_total_stock = $res['total_stock'] + $quantity;
    $update_in_product_after_cancel = mysqli_query($con, "update product set total_stock = $new_total_stock where product_name = '$product_name'");


    //add new record in transaction table
    $insert_transaction = mysqli_query($con, "insert into transaction(product_name, chalan_no, tran_type, qty,unit, date) values('$product_name', '$chalan_no', '$tran_type', $quantity,'$unit', '$date')");

    if ($insert_transaction && $update_in_product_after_cancel) {
        echo 'cancel done';
    } else {
        echo 'something happened wrong';
    }

    //add new record in product_transaction table
    $check = mysqli_query($con, "select * from product_transaction where date = '$date' and product_name='$product_name'");
    $result = mysqli_fetch_assoc($check);
    if (mysqli_num_rows($check) > 0) {
        $new_stock_in = $result['cancel'] + $quantity;
        $update_query = mysqli_query($con, "UPDATE product_transaction SET cancel = $new_stock_in, closing=$new_total_stock where product_name = '$product_name' and date = '$date'");
    } else {

        $insert_query = mysqli_query($con, "insert into product_transaction values(NULL, '$product_name',  '0', '0','$quantity', '0', $new_total_stock, '$date')");
    }
}




if ($_POST['tran_type'] == 'damage') {
    // //updating total stock 
    $damage_select = mysqli_query($con, "select * from product where product_name = '$product_name'");
    $res = mysqli_fetch_assoc($damage_select);
    if ($res['total_stock'] < $quantity) {
        echo 'You have ' . $res['total_stock'] . ' left, you cannot damage ' . $quantity . ' stock';
    } else {
        $new_total_stock = $res['total_stock'] - $quantity;
        $update_in_product_after_dispatch = mysqli_query($con, "update product set total_stock = $new_total_stock where product_name = '$product_name'");

        //add new record in transaction table
        $insert_transaction = mysqli_query($con, "insert into transaction(product_name, chalan_no, tran_type, qty,unit, date) values('$product_name', '$chalan_no', '$tran_type', $quantity,'$unit', '$date')");

        if ($insert_transaction) {
            echo 'damage entry done';
        } else {
            echo 'something happened wrong';
        }
        //add new record in product_transaction table
        $check = mysqli_query($con, "select * from product_transaction where date = '$date' and product_name='$product_name'");
        $result = mysqli_fetch_assoc($check);
        if (mysqli_num_rows($check) > 0) {
            $new_stock_in = $result['damage'] + $quantity;
            $update_query = mysqli_query($con, "UPDATE product_transaction SET damage = $new_stock_in, closing=$new_total_stock where product_name = '$product_name' and date = '$date'");
        } else {

            $insert_query = mysqli_query($con, "insert into product_transaction values(NULL, '$product_name',  '0', '0', '0','$quantity', $new_total_stock, '$date')");
        }
    }
}
