<?php
session_start();
session_unset( $_SESSION['id_sizes'] );
session_unset( $_SESSION['user'] );

echo "<script>window.location = '../pages/vc_account.php'</script>";

?>