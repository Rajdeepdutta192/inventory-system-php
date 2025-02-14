<?php
include 'inc/header.php';
include 'inc/top_nav.php';
include 'inc/aside.php';


?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Search by date</h1>
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

                        <form method="get" action="res.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product">Enter a Date</label>
                                    <input autofocus name="date" type="date" class="form-control" id="product" placeholder="Enter a Date">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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