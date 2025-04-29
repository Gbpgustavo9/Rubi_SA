<?php
session_start();
include 'conexao.php';  // Inclua o arquivo de conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Consulta para listar os ramais
$sql = "SELECT * FROM ramais";  // Supondo que exista uma tabela 'ramais'
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Ramais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="AdminLTE-master/dist/css/adminlte.min.css">
</head>
<body class="sidebar-mini layout-fixed">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Lista de Ramais</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Ramais</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Ramais</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($resultado->num_rows > 0): ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Ramal</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($ramal = $resultado->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $ramal['id']; ?></td>
                                            <td><?php echo $ramal['nome']; ?></td>
                                            <td><?php echo $ramal['numero']; ?></td>
                                            <td>
                                                <!-- Exemplo de botão para editar ou excluir -->
                                                <a href="editar_ramal.php?id=<?php echo $ramal['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <a href="excluir_ramal.php?id=<?php echo $ramal['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Nenhum ramal encontrado.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <a href="index.php" class="btn btn-primary">Voltar ao Início</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="AdminLTE-master/dist/js/adminlte.min.js"></script>
</body>
</html>
