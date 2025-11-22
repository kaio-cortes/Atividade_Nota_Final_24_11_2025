<?php
// add_tarefa.php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $data_vencimento = $_POST['data_vencimento'];

    if (!empty($descricao)) {
        $stmt = $pdo->prepare("INSERT INTO tarefas (descricao, data_vencimento, concluida) VALUES (:descricao, :data_vencimento, 0)");
        
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':data_vencimento', $data_vencimento);
        
        $stmt->execute();
    }
}

// Redireciona de volta para a página principal
header("Location: index.php");
exit;
?>
