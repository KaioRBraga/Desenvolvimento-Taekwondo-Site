<?php
$titulo = 'Equipe';
$descricao = 'Conheça os desenvolvedores responsáveis pelo projeto do site da Escola de Taekwondo.';
include 'partials/head.php';
include 'partials/header.php';

$integrantes = [
    [
        'nome'      => 'Kaio Rodrigues Braga',
        'matricula' => '202502997434',
        'papel'     => 'Desenvolvimento full stack',
    ],
];
?>

<main class="flex-1">
    <section class="secao">
        <div class="container-site">

            <div class="max-w-2xl">
                <p class="titulo-apoio">Quem faz</p>
                <h1 class="titulo-secao">Integrantes da equipe</h1>
                <p class="subtitulo-secao">
                    Este site foi desenvolvido como projeto acadêmico da disciplina de
                    Desenvolvimento Web.
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($integrantes as $integrante): ?>
                    <article class="card card-hover">
                        <div class="flex items-center gap-4">
                            <span class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-tkd-900 text-lg font-bold text-white">
                                <?php
                                // Iniciais do primeiro e do ultimo nome
                                $partes = preg_split('/\s+/', trim($integrante['nome']));
                                echo mb_strtoupper(mb_substr($partes[0], 0, 1) . mb_substr(end($partes), 0, 1));
                                ?>
                            </span>
                            <div class="min-w-0">
                                <h2 class="truncate text-lg font-bold text-tkd-950 dark:text-white">
                                    <?= htmlspecialchars($integrante['nome']) ?>
                                </h2>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                    <?= htmlspecialchars($integrante['papel']) ?>
                                </p>
                            </div>
                        </div>

                        <dl class="mt-6 border-t border-neutral-200 pt-4 text-sm dark:border-neutral-800">
                            <div class="flex items-center justify-between">
                                <dt class="text-neutral-500 dark:text-neutral-400">Matrícula</dt>
                                <dd class="font-mono font-medium text-tkd-950 dark:text-neutral-200">
                                    <?= htmlspecialchars($integrante['matricula']) ?>
                                </dd>
                            </div>
                        </dl>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>
