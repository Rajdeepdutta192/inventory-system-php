<?php
include 'inc/dbcon.php';
include 'inc/header.php';
include 'inc/top_nav.php';
include 'inc/aside.php';

$query = mysqli_query($con, "select * from product");
$rows  = mysqli_fetch_all($query, MYSQLI_ASSOC);
$query_unit = mysqli_query($con, "select * from unit");
$rows_unit  = mysqli_fetch_all($query_unit, MYSQLI_ASSOC);

$msg = '';

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaction</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <form method="POST">
                            <div class="card-body">
                                <div class="form-group col-md-12">
                                    <label for="chalan">Chalan No</label>
                                    <input name="chalan_no" required type="text" class="form-control" id="chalan" placeholder="Enter Chalan No">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Transaction Type</label>
                                        <select name="tran_type" required autofocus class="form-control">
                                            <option value="stock_in">Stock In</option>
                                            <option value="dispatch">Dispatch</option>
                                            <option value="cancel">Cancel</option>
                                            <option value="damage">Damage</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Product</label>
                                        <select name="product_name" required class="form-control">
                                            <?php
                                            foreach ($rows as $row) {
                                            ?>
                                                <option value="<?php echo $row['product_name'] ?>"><?php echo $row['product_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="qty">Quantity</label>
                                        <input name="quantity" required type="number" placeholder="Quantity" class="form-control" id="qty">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Unit</label>
                                        <select name="unit" required class="form-control">
                                            <?php
                                            foreach ($rows_unit as $row_unit) {
                                            ?>
                                                <option value="<?php echo $row_unit['unit_name'] ?>"><?php echo $row_unit['unit_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
<?php
include 'inc/footer.php';
?>





<!-- Page specific script -->
<script>
    $(function() {
        $('form').on('submit', function(event) {
            // using this page stop being refreshing 
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'action_tran.php',
                data: $('form').serialize(),
                success: function(msg) {
                    $('input[name=quantity]').val('')
                    $('input[name=product_name]').val('')
                    $('input[name=tran_type]').val('')
                    alert(msg)
                }
            });
        });
    });
</script>
</body>

</html>