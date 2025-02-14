<?php
include 'inc/dbcon.php';
include 'inc/header.php';
include 'inc/top_nav.php';
include 'inc/aside.php';
$msg = '';
?>
<?php
$username = $_SESSION['NAME'];
if (isset($_POST['submit'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $update = mysqli_query($con, "update admin set password = '$password' where username = '$username'");
    if ($update) {
        redirect('logout.php');
    } else {
        $msg = 'Password update failed';
    }
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
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
                                    <label for="password">Passsword</label>
                                    <input autofocus name="password" type="password" class="form-control" id="password" placeholder="Enter Password">
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