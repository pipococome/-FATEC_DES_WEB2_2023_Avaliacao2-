<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location: cadastro.php");
    exit;
}
?>

<?php
session_start();

if (!isset($_SESSION['online'])) {
    header("location: index.php");
    exit;
}

if (!$_SESSION['online']) {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $aluno = $_POST['aluno'];
    $placa = $_POST['placa'];

    $servername = "127.0.0.1";
    $username = "fatec";
    $password = "portaria";
    $dbname = "portaria";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO veiculos (aluno, placa) VALUES (:aluno, :placa)");
        $stmt->bindParam(':aluno', $aluno);
        $stmt->bindParam(':placa', $placa);
        $stmt->execute();

        echo "Aluno: <b>" . $aluno . "</b> cadastrado com sucesso.";

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Placa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Cadastro de Placa</h1>
    </div>

    <form action="cadastro_placa.php" method="POST">
        <div class="form-group">
            <label>Nome Completo:</label>
            <input type="text" name="aluno" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Placa do Veículo:</label>
            <input type="text" name="placa" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Cadastrar">
        </div>
    </form>

    <br>
    <a href="cadastro.php" class="btn btn-primary">Voltar</a>

</body>

</html>