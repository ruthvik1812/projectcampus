<?php
session_start();
session_destroy();
header("Location: myprofile.html");
exit;
?>
<?php
session_start();
session_destroy(); // Destroy the session

// Redirect to home page after logout
header("Location: index.html");
exit;
?>
