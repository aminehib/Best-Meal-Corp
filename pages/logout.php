<?php
session_start();
session_destroy();
$src = $_GET["src"];
header("Location:$src");
exit();