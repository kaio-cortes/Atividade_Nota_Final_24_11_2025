<?php
require 'database.php';

// Buscar tarefas pendentes (concluida = 0)
$stmt = $pdo->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY data_vencimento ASC");
$pendentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar tarefas concluídas (concluida = 1)
$stmt = $pdo->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY id DESC");
$concluidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 0 20px; }
        h1, h2 { color: #333; }
        .form-group { margin-bottom: 15px; padding: 15px; background: #f4f4f4; border-radius: 5px; }
        input[type="text"], input[type="date"] { padding: 8px; margin-right: 10px; }
        button { padding: 8px 15px; cursor: pointer; background-color: #28a745; color: white; border: none; border-radius: 3px;}
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        
        .btn-check { color: green; text-decoration: none; font-weight: bold; }
        .btn-delete { color: red; text-decoration: none; font-weight: bold; margin-left: 10px; }
        
        .concluida-row { background-color: #e9ecef; color: #6c757d; }
        .concluida-row td { text-decoration: line-through; }
        .concluida-row .btn-delete { text-decoration: none; } /* Remove risco do botão */
    </style>
</head>
<body>

    <h1>Sistema de Gerenciamento de Tarefas</h1>

    <div class="form-group">
        <h3>Nova Tarefa</h3>
        <form action="add_tarefa.php" method="POST">
            <input type="text" name="descricao" placeholder="Descrição da tarefa" required>
            <input type="date" name="data_vencimento" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>

    <h2>Tarefas Pendentes</h2>
    <?php if (count($pendentes) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Vencimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendentes as $tarefa): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
                        <td><?= date('d/m/Y', strtotime($tarefa['data_vencimento'])) ?></td>
                        <td>
                            <a href="update_tarefa.php?id=<?= $tarefa['id'] ?>" class="btn-check">✔ Concluir</a>
                            <a href="delete_tarefa.php?id=<?= $tarefa['id'] ?>" class="btn-delete" onclick="return confirm('Tem certeza?')">✖ Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma tarefa pendente.</p>
    <?php endif; ?>

    <hr>

    <h2>Tarefas Concluídas</h2>
    <?php if (count($concluidas) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Vencimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($concluidas as $tarefa): ?>
                    <tr class="concluida-row">
                        <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
                        <td><?= date('d/m/Y', strtotime($tarefa['data_vencimento'])) ?></td>
                        <td>
                            <a href="delete_tarefa.php?id=<?= $tarefa['id'] ?>" class="btn-delete" onclick="return confirm('Tem certeza?')">✖ Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma tarefa concluída.</p>
    <?php endif; ?>

</body>
</html>
