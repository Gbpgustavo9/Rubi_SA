<?php 
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_logado = $_SESSION['usuario'];
$id_logado = $_SESSION['usuario_id'];

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>
