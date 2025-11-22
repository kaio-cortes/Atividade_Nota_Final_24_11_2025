<?php
// delete_book.php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe o ID do livro a ser excluído
    $id = $_POST['id'];

    if (!empty($id)) {
        try {
            // Prepara a query de exclusão
            $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
            
            // Executa a exclusão
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Erro ao excluir livro: " . $e->getMessage();
        }
    }
}

// Redireciona de volta para a página principal
header('Location: index.php');
exit;
?>
