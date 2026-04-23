<?php
// Vernietigd de huidige sessie en logt de gebruiker uit en de gebruiker wordt naar de homepage gestuurd.
session_start();
session_destroy();
header("Location: index.php");
exit;