<?php
require_once __DIR__ . '/config/faixas.php';

$erro = '';

try {
    require __DIR__ . '/config/database.php';
} catch (PDOException $e) {
    // Sem banco nao ha o que editar
    header('Location: alunos.php?erro=1');
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: alunos.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$stmt->execute([$id]);
$aluno = $stmt->fetch();

if (!$aluno) {
    header('Location: alunos.php');
    exit;
}

if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $idade = $_POST['idade'] ?? '';
    $faixa = $_POST['faixa'] ?? '';
    $tempo = trim($_POST['tempo'] ?? '');

    // Mantem a foto atual, a menos que uma nova seja informada
    $foto = $aluno['foto'];

    if (!empty($_POST['foto_url'])) {
        $foto = $_POST['foto_url'];
    }

    if (isset($_FILES['foto_upload']) && $_FILES['foto_upload']['error'] === UPLOAD_ERR_OK) {
        $arquivo    = $_FILES['foto_upload'];
        $extensao   = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($extensao, $permitidas, true)) {
            $nomeArquivo = uniqid() . '_' . time() . '.' . $extensao;

            if (move_uploaded_file($arquivo['tmp_name'], 'uploads/' . $nomeArquivo)) {
                $foto = $nomeArquivo;

                // Remove o arquivo antigo, se era local e nao a imagem padrao
                if (!filter_var($aluno['foto'], FILTER_VALIDATE_URL) && $aluno['foto'] !== 'placeholder.jpg') {
                    @unlink('uploads/' . $aluno['foto']);
                }
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
                $stmt = $pdo->prepare('UPDATE alunos SET foto = ?, nome = ?, idade = ?, faixa = ?, tempo = ? WHERE id = ?');
                $stmt->execute([$foto, $nome, $idade, $faixa, $tempo, $id]);
                header('Location: alunos.php?sucesso=1');
                exit;
            } catch (PDOException $e) {
                $erro = 'Erro ao atualizar aluno. Tente novamente.';
            }
        } else {
            $erro = 'Por favor, preencha todos os campos obrigatórios.';
        }
    }

    // Mantem na tela o que o usuario acabou de digitar
    $aluno = array_merge($aluno, [
        'nome'  => $nome,
        'idade' => $idade,
        'faixa' => $faixa,
        'tempo' => $tempo,
    ]);
}

$fotoEhUrl = filter_var($aluno['foto'], FILTER_VALIDATE_URL) !== false;
$textoEnviar = 'Salvar alterações';

$titulo = 'Editar aluno';
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
                <span class="font-medium text-tkd-950 dark:text-neutral-200">Editar</span>
            </nav>

            <p class="titulo-apoio">Cadastro</p>
            <h1 class="titulo-secao">Editar aluno</h1>
            <p class="subtitulo-secao">
                Atualize os dados de <strong class="font-semibold text-tkd-900 dark:text-white"><?= htmlspecialchars($aluno['nome']) ?></strong>.
                A foto só muda se você informar uma nova.
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

            <!-- Foto atual -->
            <div class="card mt-8 flex items-center gap-4">
                <img src="<?= htmlspecialchars(caminhoFoto($aluno['foto'])) ?>"
                     alt="Foto atual de <?= htmlspecialchars($aluno['nome']) ?>"
                     class="h-20 w-20 rounded-lg object-cover ring-1 ring-neutral-200 dark:ring-neutral-700"
                     onerror="this.src='img/placeholder.jpg'">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-tkd-950 dark:text-white">Foto atual</p>
                    <p class="mt-0.5 text-xs text-neutral-500">
                        <?= $fotoEhUrl ? 'Imagem externa (URL)' : 'Arquivo enviado' ?>
                    </p>
                    <span class="chip mt-2 ring-inset <?= classesFaixa($aluno['faixa']) ?>">
                        Faixa <?= htmlspecialchars($aluno['faixa']) ?>
                    </span>
                </div>
            </div>

            <div class="mt-6">
                <?php include 'partials/form_aluno.php'; ?>
            </div>

        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>
