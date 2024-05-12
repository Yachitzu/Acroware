<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/Acroware/patrones/Strategy/Authenticator.php');
    $authenticator = new Authenticator();
    $authenticator-> closeSession();
?>