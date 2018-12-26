<?php

require_once("config.php");

$database = new Database();

$usuarios = $database->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);

?>