<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "rpg_db";
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if($conexao->connect_error) {
die("Falha na conexão: " . $conexao->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT id, nome, classe, raca FROM personagens WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();
$personagem = $resultado->fetch_assoc();

if(!$personagem) {
    die("Personagem não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Personagem</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 2em auto; background-color: #f4f4f4; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin-bottom: 5px; color: #666; }
        input { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Personagem: <?php echo htmlspecialchars($personagem['nome']); ?></h2>

        <form action="processa_edicao.php" method="POST">
        
            <input type="hidden" name="id" value="<?php echo $personagem['id']; ?>">

            <div>
                <label for="nome">Nome do Personagem:</label>
                <input type="text" id="nome" name="nome_personagem" value="<?php echo htmlspecialchars($personagem['nome']); ?>" required>
            </div>
            <div>
                <label for="classe">Classe:</label>
                <input type="text" id="classe" name="classe_personagem" value="<?php echo htmlspecialchars($personagem['classe']); ?>" required>
            </div>
            <div>
                <label for="raca">Raça:</label>
                <input type="text" id="raca" name="raca_personagem" value="<?php echo htmlspecialchars($personagem['raca']); ?>" required>
            </div>
            
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>

<?php
// Fecha as conexões
$stmt->close();
$conexao->close();
?>