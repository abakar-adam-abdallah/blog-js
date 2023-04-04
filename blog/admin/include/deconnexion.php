<?php
    session_start();
    session_destroy();
    header("Location: /Blog-js/index.php");
?>