<?php
include 'conexao.php';
session_start();

$usuario_logado = $_SESSION['usuario'];

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_logado = $_SESSION['usuario_id'];

$sql = "SELECT nome_completo, email, senha FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_logado);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$nome_completo = $usuario['nome_completo'];
$email = $usuario['email'];
$senha = $usuario['senha'];
?>
<?php include 'topo.php'; ?>
<div class="content-wrapper">
    <section class="content pt-3">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Meu Perfil</h3>
          </div>
          <div class="card-body">
            <p><strong>Nome Completo:</strong> <?= htmlspecialchars($nome_completo) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Senha:</strong> <?= htmlspecialchars($senha) ?></p>
          </div>
        </div>
      </div>
    </section>
  </div>


</div>

<?php include 'footer.php'; ?>