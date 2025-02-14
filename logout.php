<?php
session_start();
 unset($_SESSION['NAME']); 
  unset($_SESSION['GODOWN1']); 
?>
<script>
    window.location.href = 'index.php';
</script>