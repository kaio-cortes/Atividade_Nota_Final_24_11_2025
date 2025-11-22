<?php
// index.php
require 'database.php';

// Busca todos os livros cadastrados para exibir na lista
$stmt = $pdo->query("SELECT * FROM livros");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Banco de Dados Livraria</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 0 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-group { margin-bottom: 10px; }
        input[type="text"], input[type="number"] { padding: 5px; width: 200px; }
        button { padding: 5px 10px; cursor: pointer; }
        .delete-btn { background-color: #ff4444; color: white; border: none; }
        .section { margin-bottom: 40px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
    </style>
</head>
<body>

    <h1>Sistema de Livraria</h1>

    <div class="section">
        <h2>Adicionar Novo Livro</h2>
        <form action="add_book.php" method="POST">
            <div class="form-group">
                <label>Título:</label><br>
                <input type="text" name="titulo" required>
            </div>
            <div class="form-group">
                <label>Autor:</label><br>
                <input type="text" name="autor" required>
            </div>
            <div class="form-group">
                <label>Ano de Publicação:</label><br>
                <input type="number" name="ano" required>
            </div>
            <button type="submit">Salvar Livro</button>
        </form>
    </div>

    <div class="section">
        <h2>Livros Cadastrados</h2>
        <?php if (count($livros) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livro['id']); ?></td>
                            <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                            <td><?php echo htmlspecialchars($livro['ano']); ?></td>
                            <td>
                                <form action="delete_book.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                    <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">
                                    <button type="submit" class="delete-btn">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum livro cadastrado.</p>
        <?php endif; ?>
    </div>

    <div class="section">
        <h2>Excluir Livro por ID</h2>
        <form action="delete_book.php" method="POST">
            <label>Digite o ID do livro para excluir:</label>
            <input type="number" name="id" required>
            <button type="submit" class="delete-btn">Excluir</button>
        </form>
    </div>

</body>
</html>
