<?php
// database.php

try {
    // Conexão com SQLite (cria o arquivo se não existir)
    $pdo = new PDO("sqlite:db_tarefas.sqlite");
    
    // Configura para lançar erros em caso de falha
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela 'tarefas' se ela ainda não existir
    $query = "CREATE TABLE IF NOT EXISTS tarefas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        descricao TEXT NOT NULL,
        data_vencimento DATE,
        concluida INTEGER DEFAULT 0
    )";
    
    $pdo->exec($query);

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>
