<?php
// database.php

// Cria (ou abre) o arquivo do banco de dados SQLite chamado 'livraria.db'
try {
    $pdo = new PDO('sqlite:livraria.db');
    
    // Configura para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela 'livros' se ela ainda não existir
    $query = "CREATE TABLE IF NOT EXISTS livros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        autor TEXT NOT NULL,
        ano INTEGER NOT NULL
    )";
    
    $pdo->exec($query);

} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit;
}
?>
