<?php include 'header.php'; ?>
<?php include 'topo.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Ouvidoria - Reclamações</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          include 'conexao.php';

          $reclamacao = trim($_POST["reclamacao"]);

          if (!empty($reclamacao)) {
              $stmt = $conn->prepare("INSERT INTO ouvidoria (reclamacao) VALUES (?)");
              $stmt->bind_param("s", $reclamacao);

              if ($stmt->execute()) {
                  echo '<div class="alert alert-success">Reclamação enviada com sucesso!</div>';
              } else {
                  echo '<div class="alert alert-danger">Erro ao enviar reclamação: ' . $conn->error . '</div>';
              }

              $stmt->close();
              $conn->close();
          } else {
              echo '<div class="alert alert-warning">Por favor, escreva sua reclamação antes de enviar.</div>';
          }
        }
      ?>

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Envie sua Reclamação</h3>
        </div>

        <form method="POST" action="reclamacoes.php">
          <div class="card-body">
            <div class="form-group">
              <label for="reclamacao">Mensagem:</label>
              <textarea name="reclamacao" id="reclamacao" class="form-control" rows="5" placeholder="Descreva sua reclamação aqui..."></textarea>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>

    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
