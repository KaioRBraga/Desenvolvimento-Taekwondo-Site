<?php
$titulo = $titulo ?? 'Escola de Taekwondo';
$descricao = $descricao ?? 'Escola de Taekwondo: aulas para todas as idades, com foco no desenvolvimento fisico, mental e espiritual.';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($descricao) ?>">
    <title><?= htmlspecialchars($titulo) ?> &middot; Escola de Taekwondo</title>
    <link rel="stylesheet" href="css/tailwind.css">
    <script>
        // Aplica o tema antes da primeira renderizacao, senao a pagina pisca branca
        if (localStorage.getItem('preferenciaTema') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="flex min-h-screen flex-col bg-neutral-50 font-sans text-neutral-700 antialiased dark:bg-neutral-950 dark:text-neutral-300">
