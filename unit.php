<?php
include 'inc/dbcon.php';
include 'inc/header.php';
include 'inc/top_nav.php';
include 'inc/aside.php';
$msg = '';
?>
<?php
if (isset($_POST['submit'])) {
    $unit_name = mysqli_real_escape_string($con, $_POST['unit_name']);
    $check = mysqli_query($con, "select * from unit where unit_name = '$unit_name'");
    if (mysqli_num_rows($check) > 0) {
        $msg = '<div class="card-header">
                            <h3 class="card-title">unit already exists</h3>
                        </div>';
    } else {
        $sql = "insert into unit(unit_name) values ('$unit_name')";
        $query = mysqli_query($con, $sql);
        $msg = '<div class="card-header">
                            <h3 class="card-title">unit added</h3>
                        </div>';
    }
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Unit</h1>
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
                                    <label for="unit">Unit Name</label>
                                    <input autofocus name="unit_name" type="text" class="form-control" id="unit" placeholder="Enter Unit Name">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-6">
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