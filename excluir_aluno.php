<?php
// Sem interface propria: executa a exclusao e devolve o usuario para a listagem.

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: alunos.php');
    exit;
}

try {
    require __DIR__ . '/config/database.php';

    // Busca antes de apagar, para remover tambem o arquivo de foto local
    $stmt = $pdo->prepare('SELECT foto FROM alunos WHERE id = ?');
    $stmt->execute([$id]);
    $aluno = $stmt->fetch();

    if ($aluno
        && !filter_var($aluno['foto'], FILTER_VALIDATE_URL)
        && $aluno['foto'] !== 'placeholder.jpg') {
        @unlink('uploads/' . $aluno['foto']);
    }

    $pdo->prepare('DELETE FROM alunos WHERE id = ?')->execute([$id]);

    header('Location: alunos.php?sucesso=1');
    exit;
} catch (PDOException $e) {
    header('Location: alunos.php?erro=1');
    exit;
}
