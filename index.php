<?php

include "./data/menuData.php";

$page = $_GET["page"] ?? 'home';
$filePath = "pages/" . $page . ".php";

if (file_exists($filePath)) {
        include $filePath;
} else {
        include_once "pages/404.php";
}
