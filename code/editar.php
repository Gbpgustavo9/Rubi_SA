<?php
session_start();
include 'conexao.php';

$usuario_logado = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['self']) && $_GET['self'] == 1) {
    $id = $_SESSION['usuario_id'];
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Usuário inválido.";
    exit();
}

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "UPDATE usuarios SET nome_completo = ?, email = ?, senha = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $senha, $id);

    if ($stmt->execute()) {
        if ($id == $_SESSION['usuario_id']) {
            $_SESSION['usuario'] = $nome;
        }

        header("Location: painel.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<?php include 'topo.php'; ?>


      <div class="container mt-5">
    <h2>Editar Usuário</h2>
    <form method="POST">
        <input type="text" name="nome_completo" class="form-control mb-3" placeholder="Nome completo" value="<?php echo $usuario['nome_completo']; ?>" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" value="<?php echo $usuario['email']; ?>" required>
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" value="<?php echo $usuario['senha']; ?>" required>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="painel.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

      <?php include 'footer.php'; ?>