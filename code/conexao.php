<?php
$servidor = "db";
$usuario = "root";
$senha = "123";
$banco = "sistema_login";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
