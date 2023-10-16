<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Veículo</title>
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
        <h2>Cadastrar Novo Veículo</h2>
    </div>
    <form action="cadastro.php" method="POST">
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

    <?php
    class Conexao {
        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $conn;

        public function __construct() {
            $this->servername = '127.0.0.1'; // altere para o seu servidor MySQL
            $this->username = 'fatec'; // altere para o seu nome de usuário do MySQL
            $this->password = 'portaria'; // adicione sua senha do MySQL aqui
            $this->dbname = 'portaria'; // altere para o nome do seu banco de dados
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                die("Conexão falhou: " . $this->conn->connect_error);
            }
        }

        public function cadastrarveiculo($aluno, $placa) {
            $sql = "INSERT INTO veiculos (aluno, placa) VALUES ('$aluno', '$placa')";

            if ($this->conn->query($sql) === TRUE) {
                echo "Novo registro criado com sucesso.";
            } else {
                echo "Erro: " . $sql . "<br>" . $this->conn->error;
            }
        }

        // Outros métodos para ler, atualizar e excluir candidatos
        // Implemente conforme as necessidades do seu aplicativo

        public function fecharConexao() {
            $this->conn->close();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $aluno = $_POST['aluno'];
        $placa = $_POST['placa'];

        $conexao = new Conexao();
        $conexao->cadastrarveiculo($aluno, $placa);
        $conexao->fecharConexao();
    }
    ?>

</body>

</html>