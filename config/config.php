<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "site_rh";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: ".$e->getMessage());
}