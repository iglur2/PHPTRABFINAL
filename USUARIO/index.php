<?php
include_once 'conexao.php';
include_once 'Usuario.php';

$conexao_banco = new Conexao();
$banco = $conexao_banco->conectar();

$Usuario = new Usuario($banco);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['Usuario']) && !empty($_POST['telefone'])) {
        $Usuario->Usuario = $_POST['Usuario'];
        $Usuario->telefone = $_POST['telefone'];

        if ($Usuario->criar()) {
            echo "<p>Usuario criado com sucesso.</p>";
        } else {
            echo "<p>Não foi possível criar o Usuario.</p>";
        }
    } else {
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
}

$stmt = $Usuario->ler();
$num = $stmt->rowCount();

if ($num > 0) {
    echo "<h2>Usuarios Cadastrados</h2>";
    echo "<div class='lista-Usuarios'>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<li>ID: {$id}, Usuario: {$Usuario}, telefone: {$telefone}</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "<p>Nenhum Usuario cadastrado.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuarios</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Adicionar Novo Usuario</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="Usuario">Usuario:</label>
            <input type="text" id="Usuario" name="Usuario" required>

            <label for="telefone">telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <input type="submit" value="Adicionar Usuario">
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('#telefone').mask('(00)0 0000-0000');
        });
    </script>
</body>
</html>
