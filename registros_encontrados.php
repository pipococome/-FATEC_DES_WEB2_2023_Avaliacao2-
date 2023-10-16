<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location: registros.php");
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
    $placa = $_POST['placa'];

    $servername = "127.0.0.1";
    $username = "fatec";
    $password = "portaria";
    $dbname = "portaria";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM registro WHERE placa = :placa");
        $stmt->bindParam(':placa', $placa);
        $stmt->execute();
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <title>Registros Encontrados</title>
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
        <h1>Registros Encontrados</h1>
    </div>

    <?php if (isset($registros) && is_array($registros) && count($registros) > 0) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Id dos veículos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro) { ?>
                    <tr>
                        <td><?php echo $registro['data_hora']; ?></td>
                        <td><?php echo $registro['veiculos_id']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Nenhum registro encontrado.</p>
    <?php endif; ?>
</body>

</html>