<?php
session_start();
include 'inc/dbcon.php';

if (isset($_SESSION['GODOWN1']) && $_SESSION['GODOWN1'] === 'godown1') {
} else {
    redirect('login.php');
}

$chalan_no = mres($con, $_GET['chalan']);
$select = mysqli_query($con, "select * from transaction where chalan_no =  '$chalan_no'");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kirtidhara | Invoice Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                                                <img style="width: 100px;" src="dist/img/logo-1.jpg" alt="Kirtidhara Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

                        <small class="float-right">Date:<?php echo date('d-m-Y') ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Kirtidhara</strong><br>
                        <h4>Chalan No: <strong><?php echo $chalan_no ?></strong></h4>
                    </address>
                </div>

            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Transaction Type</th>
                                <th>Quantity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                <tr>
                                    <td style="text-transform: capitalize;"><?php echo $row['product_name'] ?></td>
                                    <td style="text-transform: capitalize;"><?php echo $row['tran_type']  ?></td>
                                    <td style="text-transform: capitalize;"><?php echo $row['qty'] . ' ' . $row['unit'] ?></td>
                                    <td style="text-transform: capitalize;"><?php echo $row['date'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>