<?php
// add_book.php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];

    if (!empty($titulo) && !empty($autor) && !empty($ano)) {
        try {
            // Prepara a query de inserção (segurança contra SQL Injection)
            $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
            
            // Executa a query substituindo os placeholders
            $stmt->execute([
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':ano' => $ano
            ]);
        } catch (PDOException $e) {
            echo "Erro ao adicionar livro: " . $e->getMessage();
        }
    }
}

// Redireciona de volta para a página principal
header('Location: index.php');
exit;
?>
