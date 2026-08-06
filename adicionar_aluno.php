<?php
require_once __DIR__ . '/config/faixas.php';

$erro = '';

try {
    require __DIR__ . '/config/database.php';
} catch (PDOException $e) {
    $erro = 'Não foi possível conectar ao banco de dados. Verifique se o MySQL está em execução.';
}

if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $erro === '') {
    $nome  = trim($_POST['nome'] ?? '');
    $idade = $_POST['idade'] ?? '';
    $faixa = $_POST['faixa'] ?? '';
    $tempo = trim($_POST['tempo'] ?? '');

    $foto = 'placeholder.jpg';

    if (!empty($_POST['foto_url'])) {
        $foto = $_POST['foto_url'];
    }

    if (isset($_FILES['foto_upload']) && $_FILES['foto_upload']['error'] === UPLOAD_ERR_OK) {
        $arquivo   = $_FILES['foto_upload'];
        $extensao  = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($extensao, $permitidas, true)) {
            $nomeArquivo = uniqid() . '_' . time() . '.' . $extensao;

            if (move_uploaded_file($arquivo['tmp_name'], 'uploads/' . $nomeArquivo)) {
                $foto = $nomeArquivo;
            } else {
                $erro = 'Erro ao fazer upload da imagem.';
            }
        } else {
            $erro = 'Formato de arquivo não permitido. Use JPG, PNG, GIF ou WebP.';
        }
    }

    if ($erro === '') {
        if ($nome !== '' && $idade !== '' && $faixa !== '' && $tempo !== '') {
            try {
                $stmt = $pdo->prepare('INSERT INTO alunos (foto, nome, idade, faixa, tempo) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$foto, $nome, $idade, $faixa, $tempo]);
                header('Location: alunos.php?sucesso=1');
                exit;
            } catch (PDOException $e) {
                $erro = 'Erro ao adicionar aluno. Tente novamente.';
            }
        } else {
            $erro = 'Por favor, preencha todos os campos obrigatórios.';
        }
    }
}

// Repopula o formulario apos um envio com erro
$aluno = [
    'nome'  => $_POST['nome'] ?? '',
    'idade' => $_POST['idade'] ?? '',
    'faixa' => $_POST['faixa'] ?? '',
    'tempo' => $_POST['tempo'] ?? '',
];
$textoEnviar = 'Adicionar aluno';

$titulo = 'Adicionar aluno';
$scripts = ['js/form_alunos.js'];
include 'partials/head.php';
include 'partials/header.php';
?>

<main class="flex-1">
    <section class="secao">
        <div class="container-site max-w-3xl">

            <nav class="mb-8 flex items-center gap-2 text-sm text-neutral-500" aria-label="Trilha de navegação">
                <a href="alunos.php" class="transition hover:text-tkd-700 dark:hover:text-white">Alunos</a>
                <span aria-hidden="true">/</span>
                <span class="font-medium text-tkd-950 dark:text-neutral-200">Adicionar</span>
            </nav>

            <p class="titulo-apoio">Cadastro</p>
            <h1 class="titulo-secao">Adicionar aluno</h1>
            <p class="subtitulo-secao">
                Preencha os dados abaixo para incluir um novo praticante na escola.
            </p>

            <?php if ($erro): ?>
                <div class="alerta-erro mt-8">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 9v4m0 4h.01M10.3 3.9L1.8 18a2 2 0 001.7 3h17a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?= htmlspecialchars($erro) ?></span>
                </div>
            <?php endif; ?>

            <div class="mt-8">
                <?php include 'partials/form_aluno.php'; ?>
            </div>

        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>

