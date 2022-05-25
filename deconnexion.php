<?php
session_start();
unset($_SESSION["connected-admin-id"]);
header("Location:index.php");