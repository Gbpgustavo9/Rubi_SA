<?php
session_start();
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $usuario_logado = $_SESSION['usuario'];

    $sql_usuario = "SELECT * FROM usuarios WHERE id = ?";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->bind_param("i", $id);
    $stmt_usuario->execute();
    $resultado = $stmt_usuario->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario['nome_completo'] == $usuario_logado) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: painel.php");
            exit();
        } else {
            echo "Erro ao excluir: " . $conn->error;
        }
    }
}
?>
