<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Personagens</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2em auto; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Lista de Personagens Cadastrados</h1>

    <?php
    // --- CONEXÃO COM O BANCO DE DADOS --- //
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "rpg_db";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // --- BUSCAR E EXIBIR OS DADOS --- //
    $sql = "SELECT id, nome, classe, raca FROM personagens";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        // Adicione 'Ações' ao cabeçalho
        echo "<tr><th>ID</th><th>Nome</th><th>Classe</th><th>Raça</th><th>Ações</th></tr>";

        while($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha["id"] . "</td>";
            echo "<td>" . htmlspecialchars($linha["nome"]) . "</td>";
            echo "<td>" . htmlspecialchars($linha["classe"]) . "</td>";
            echo "<td>" . htmlspecialchars($linha["raca"]) . "</td>";
            // Adicione a célula com o link de edição
            echo '<td><a href="formulario_editar.php?id=' . $linha["id"] . '">Editar</a></td>';
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum personagem cadastrado ainda.</p>";
    }

    $conexao->close();
    ?>
    
    <br>
    <a href="cadastro.html">Cadastrar Novo Personagem</a>
</body>
</html>