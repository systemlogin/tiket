 <?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();
echo "<script>window.location.href = \"http://localhost/tp/v2/index.php#tiket\"</script> ";
?>
</body>
</html> 