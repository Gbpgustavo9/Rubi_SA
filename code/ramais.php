<?php include 'header.php'; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_login"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_ramal = $_POST['numero_ramal'];
    $nome_departamento = $_POST['nome_departamento'];

    $sql = "INSERT INTO ramais (numero_ramal, nome_departamento) VALUES ('$numero_ramal', '$nome_departamento')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Novo ramal cadastrado com sucesso!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erro: ' . $conn->error . '</div>';
    }
}

$conn->close();
?>
<?php include 'topo.php'; ?>
<div class="container mt-5">
        <h2>Cadastro de Ramais</h2>
        <form method="POST">
            <div class="form-group">
                <label for="numero_ramal">Número do Ramal:</label>
                <input type="text" class="form-control" id="numero_ramal" name="numero_ramal" required>
            </div>
            <div class="form-group">
                <label for="nome_departamento">Nome do Departamento:</label>
                <input type="text" class="form-control" id="nome_departamento" name="nome_departamento" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
<?php include 'footer.php'; ?>