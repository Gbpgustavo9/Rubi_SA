<?php 
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['nome_completo'];
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: painel.php");
            exit();
        } else {
            $erro = "Email ou senha inválidos!";
        }
    } else {
        $erro = "Email ou senha inválidos!";
    }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="AdminLTE-master/dist/css/adminlte.min.css">
  </head>

  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Bem vindo </b>ao Sistema</a>
      </div>

      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Para continuar, faça o login</p>

          <?php if (isset($erro)) { echo "<div class='alert alert-danger'>$erro</div>"; } ?>

          <form method="POST">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email" required />
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Senha" name="senha" required />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>

            <div class="row">
              <div class="col-8">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="salvarSenha" />
                  <label class="form-check-label" for="salvarSenha">Salvar senha</label>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
              </div>
            </div>
          </form>

          <p class="mb-0 mt-3">
            <a href="cadastro.php" class="text-center">Ou faça seu cadastro</a>
          </p>
        </div>
      </div>
    </div><br>
    <div class="row">
    <div class="col-12">
        <div class="d-grid gap-2">
            <a href="lista_ramais.php" class="btn btn-secondary">Ver Lista de Ramais</a>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="AdminLTE-master/dist/js/adminlte.min.js"></script>
  </body>
</html>
