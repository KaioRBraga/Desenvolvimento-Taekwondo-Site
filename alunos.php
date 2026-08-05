<?php
require_once __DIR__ . '/config/faixas.php';

$alunos = [];
$erro_bd = '';

try {
    require __DIR__ . '/config/database.php';
    $alunos = $pdo->query('SELECT * FROM alunos ORDER BY nome')->fetchAll();
} catch (PDOException $e) {
    $erro_bd = 'Não foi possível conectar ao banco de dados. Verifique se o MySQL está em execução.';
}

// Distribuicao por faixa, para o resumo no topo da pagina
$porFaixa = array_count_values(array_column($alunos, 'faixa'));

$titulo = 'Alunos';
$descricao = 'Conheça os alunos da Escola de Taekwondo, suas graduações e tempo de prática.';
include 'partials/head.php';
include 'partials/header.php';
?>

<main class="flex-1">
    <section class="secao">
        <div class="container-site">

            <div class="flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <p class="titulo-apoio">Nosso tatame</p>
                    <h1 class="titulo-secao">Nossos alunos</h1>
                    <p class="subtitulo-secao">
                        Conheça os praticantes da escola, suas graduações e o tempo de dedicação
                        de cada um.
                    </p>
                </div>

                <a href="adicionar_aluno.php" class="btn-primario">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Adicionar aluno
                </a>
            </div>

            <?php if ($erro_bd): ?>
                <div class="alerta-erro mt-8">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 9v4m0 4h.01M10.3 3.9L1.8 18a2 2 0 001.7 3h17a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?= htmlspecialchars($erro_bd) ?></span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alerta-sucesso mt-8">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Operação realizada com sucesso.</span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alerta-erro mt-8">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 9v4m0 4h.01M10.3 3.9L1.8 18a2 2 0 001.7 3h17a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Erro ao realizar a operação. Tente novamente.</span>
                </div>
            <?php endif; ?>

            <?php if ($alunos): ?>
                <!-- Resumo por graduação -->
                <div class="mt-10 flex flex-wrap items-center gap-2">
                    <span class="chip bg-tkd-900 text-white ring-tkd-900">
                        <?= count($alunos) ?> <?= count($alunos) === 1 ? 'aluno' : 'alunos' ?>
                    </span>
                    <?php foreach ($FAIXAS as $faixa): ?>
                        <?php if (!empty($porFaixa[$faixa])): ?>
                            <span class="chip ring-inset <?= classesFaixa($faixa) ?>">
                                <?= $faixa ?> &middot; <?= $porFaixa[$faixa] ?>
                            </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="tabela-wrap mt-6">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th class="w-24">Idade</th>
                            <th class="w-36">Faixa</th>
                            <th class="w-40">Tempo de prática</th>
                            <th class="w-44 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$alunos): ?>
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <span class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-neutral-100 text-neutral-400 dark:bg-neutral-800">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.66-.13-1.3-.36-1.86M7 20H2v-2a3 3 0 015.36-1.86M7 20v-2c0-.66.13-1.3.36-1.86m0 0a5 5 0 019.28 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                                                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <p class="mt-4 font-semibold text-tkd-950 dark:text-white">
                                        <?= $erro_bd ? 'Não foi possível carregar os alunos' : 'Nenhum aluno cadastrado' ?>
                                    </p>
                                    <p class="mt-1 text-sm text-neutral-500">
                                        <?= $erro_bd
                                            ? 'Ligue o MySQL no painel do XAMPP e recarregue a página.'
                                            : 'Comece adicionando o primeiro aluno da escola.' ?>
                                    </p>
                                    <?php if (!$erro_bd): ?>
                                        <a href="adicionar_aluno.php" class="btn-primario btn-sm mt-6">Adicionar aluno</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($alunos as $aluno): ?>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="<?= htmlspecialchars(caminhoFoto($aluno['foto'])) ?>"
                                                 alt="Foto de <?= htmlspecialchars($aluno['nome']) ?>"
                                                 class="h-11 w-11 shrink-0 rounded-full object-cover ring-1 ring-neutral-200 dark:ring-neutral-700"
                                                 onerror="this.src='img/placeholder.jpg'">
                                            <span class="font-semibold text-tkd-950 dark:text-white">
                                                <?= htmlspecialchars($aluno['nome']) ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap text-neutral-600 dark:text-neutral-400">
                                        <?= htmlspecialchars($aluno['idade']) ?> anos
                                    </td>
                                    <td>
                                        <span class="chip ring-inset <?= classesFaixa($aluno['faixa']) ?>">
                                            <?= htmlspecialchars($aluno['faixa']) ?>
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap text-neutral-600 dark:text-neutral-400">
                                        <?= htmlspecialchars($aluno['tempo']) ?>
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <a href="editar_aluno.php?id=<?= (int) $aluno['id'] ?>" class="btn-contorno btn-sm">
                                                Editar
                                            </a>
                                            <a href="excluir_aluno.php?id=<?= (int) $aluno['id'] ?>" class="btn-perigo btn-sm"
                                               onclick="return confirm('Deseja mesmo excluir o aluno <?= htmlspecialchars(addslashes($aluno['nome']), ENT_QUOTES) ?>?')">
                                                Excluir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>
