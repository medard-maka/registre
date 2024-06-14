
<?php
session_start();
$_SESSION = array(); // Effacez toutes les variables de session
session_destroy(); // Détruisez la session
header('Location: index.php'); // Redirigez vers la page de connexion
exit();
?>
