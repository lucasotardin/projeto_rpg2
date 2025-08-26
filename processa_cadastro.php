<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Dados do formulário (esta parte não muda)
    $nome = $_POST['nome_personagem'];
    $classe = $_POST['classe_personagem'];
    $raca = $_POST['raca_personagem'];

    // Conexão com o banco (esta parte não muda)
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "rpg_db";
    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    // Verificação da conexão (esta parte não muda)
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // ----- INÍCIO DO NOVO CÓDIGO (A PARTE FINAL) ----- //

    // 1. Criar o "molde" do comando SQL com placeholders (?)
    $sql = "INSERT INTO personagens (nome, classe, raca) VALUES (?, ?, ?)";
    
    // 2. Preparar a consulta para execução
    $stmt = $conexao->prepare($sql);
    
    // 3. Ligar as variáveis PHP aos placeholders do SQL
    // "sss" indica que estamos enviando 3 variáveis do tipo String (texto)
    $stmt->bind_param("sss", $nome, $classe, $raca);
    
    // 4. Executar o comando e dar o feedback final para o usuário
    if ($stmt->execute()) {
        echo "<h1>Novo personagem cadastrado com sucesso!</h1>";
        echo "<p><a href='cadastro.html'>Cadastrar outro personagem</a></p>";
    } else {
        echo "Erro ao cadastrar o personagem: " . $stmt->error;
    }
    
    // 5. Fechar o statement e a conexão para liberar recursos do servidor
    $stmt->close();
    $conexao->close();

    // ----- FIM DO NOVO CÓDIGO ----- //

} else {
    echo "Acesso inválido.";
}

?>