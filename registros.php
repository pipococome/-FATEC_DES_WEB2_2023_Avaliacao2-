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

// Configurações do banco de dados
$servername = "127.0.0.1";
$username = "fatec";
$password = "portaria";
$dbname = "portaria";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT placa FROM veiculos");
    $stmt->execute();
    $placas = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <title>Verificar Veículos</title>
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
        <h1>Verificar Veículos</h1>
    </div>

    <form action="registros_encontrados.php" method="POST">
        <label for="placa">Selecione uma placa:</label>
        <select id="placa" name="placa">
            <?php foreach ($placas as $placa) { ?>
                <option value="<?php echo $placa; ?>"><?php echo $placa; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <input type="submit" value="Acessar" class="btn btn-primary">
    </form>
</body>

</html>