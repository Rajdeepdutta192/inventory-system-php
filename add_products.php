<?php
include 'inc/dbcon.php';
include 'inc/header.php';
include 'inc/top_nav.php';
include 'inc/aside.php';
$msg = '';
if (isset($_POST['submit'])) {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $check = mysqli_query($con, "select * from product where product_name = '$product_name'");
    if (mysqli_num_rows($check) > 0) {
        $msg = '<div class="card-header">
        <h3 class="card-title">Product already exists</h3>
        </div>';
    } else {
        $sql = "insert into product(product_name, total_stock) values ('$product_name', 0)";
        $query = mysqli_query($con, $sql);
        $msg = '<div class="card-header">
        <h3 class="card-title">Product added</h3>
        </div>';
    }
}
$date = date("Y-m-d");
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $name = mysqli_query($con, "select product_name from product where product_id = $id");
    $res = mysqli_fetch_assoc($name);
    $p_name = $res['product_name'];
    $delete_query1 = mysqli_query($con, "delete from product where product_name = '$p_name'");
    $delete_query2 = mysqli_query($con, "delete from transaction where product_name = '$p_name' and date='$date'");
    $delete_query3 = mysqli_query($con, "delete from product_transaction where product_name = '$p_name' and date='$date'");
}

$query_select = mysqli_query($con, "select * from product");

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Product</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <?php echo $msg ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product">Product Name</label>
                                    <input autofocus name="product_name" type="text" class="form-control" id="product" placeholder="Enter Product Name">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    while ($row = mysqli_fetch_assoc($query_select)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['product_name'] ?></td>
                                            <td><a href="add_products.php?id=<?php echo $row['product_id'] ?>">Delete</a></td>
                                        </tr>
                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include 'inc/footer.php';
?>





<!-- Page specific script -->
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
</body>

</html>