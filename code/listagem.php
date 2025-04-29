<?php include 'header.php'; ?>
<?php include 'topo.php'; ?>
      <?php
include 'conexao.php';
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);
?>
<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">
  <thead class="thead-dark">
    <tr>
      <th>Nome</th>
      <th>Email</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
      <tr>
        <td><?= htmlspecialchars($usuario['nome_completo']) ?></td>
        <td><?= htmlspecialchars($usuario['email']) ?></td>
        <td>
          <a href="editar.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i> Editar
          </a>
          <a href="excluir.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
            <i class="fas fa-trash"></i> Excluir
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
    </div>
      <?php include 'footer.php'; ?>