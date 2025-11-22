<?php
// delete_tarefa.php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>
