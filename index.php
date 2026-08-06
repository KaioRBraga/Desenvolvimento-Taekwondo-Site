<?php
$titulo = 'Início';
$descricao = 'Escola de Taekwondo com aulas para crianças, adolescentes e adultos. Turmas por faixa etária e nível técnico, preparação para competições e exames de faixa.';
include 'partials/head.php';
include 'partials/header.php';
?>

<main class="flex-1">

    <!-- ============ Hero ============ -->
    <section class="relative overflow-hidden bg-tkd-950">
        <!-- Textura de fundo: brilho radial + grade sutil -->
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--color-tkd-700)_0%,_transparent_60%)] opacity-70"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.07]
                    bg-[linear-gradient(to_right,white_1px,transparent_1px),linear-gradient(to_bottom,white_1px,transparent_1px)]
                    bg-[size:56px_56px]"></div>

        <div class="container-site relative py-20 sm:py-28">
            <div class="max-w-3xl">
                <span class="chip bg-white/10 text-white ring-white/20">
                    Matrículas abertas o ano todo
                </span>

                <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-6xl">
                    Arte marcial que desenvolve
                    <span class="bg-gradient-to-r from-brasa-400 to-brasa-600 bg-clip-text text-transparent">
                        corpo &amp; alma
                    </span>
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-relaxed text-neutral-300 sm:text-xl">
                    Ensinamos Taekwondo há gerações, com turmas para todas as idades e níveis.
                    Mais que uma luta: uma escola de disciplina, respeito e autoconfiança.
                </p>

                <div class="mt-10 flex flex-wrap gap-3">
                    <a href="sac.php" class="btn-acento">
                        Agende uma aula experimental
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14m-6-6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="tabela.php" class="btn-claro">Conheça as faixas</a>
                </div>
            </div>

            <!-- Indicadores -->
            <dl class="mt-16 grid grid-cols-2 gap-px overflow-hidden rounded-2xl bg-white/10 ring-1 ring-white/15 sm:grid-cols-4">
                <?php
                $indicadores = [
                    ['valor' => '+30',  'rotulo' => 'Anos de tradição'],
                    ['valor' => '6',    'rotulo' => 'Graduações'],
                    ['valor' => '3',    'rotulo' => 'Faixas etárias'],
                    ['valor' => '100%', 'rotulo' => 'Foco no aluno'],
                ];
                foreach ($indicadores as $indicador): ?>
                    <div class="bg-tkd-950/80 px-6 py-6 text-center backdrop-blur">
                        <dt class="text-3xl font-bold text-white"><?= $indicador['valor'] ?></dt>
                        <dd class="mt-1 text-sm text-neutral-400"><?= $indicador['rotulo'] ?></dd>
                    </div>
                <?php endforeach; ?>
            </dl>
        </div>
    </section>

    <!-- ============ Sobre ============ -->
    <section class="secao" id="sobre">
        <div class="container-site grid items-start gap-12 lg:grid-cols-2">
            <div>
                <p class="titulo-apoio">Nossa escola</p>
                <h2 class="titulo-secao">Uma arte marcial coreana milenar</h2>
                <p class="subtitulo-secao">
                    Nossa escola tem como objetivo ensinar o Taekwondo em sua essência, focando no
                    desenvolvimento físico, mental e espiritual de cada aluno. Oferecemos aulas para
                    todas as idades e níveis de experiência.
                </p>
                <p class="mt-4 max-w-2xl text-neutral-600 dark:text-neutral-400">
                    As turmas são separadas por faixa etária e nível técnico, e realizamos ainda
                    treinamentos específicos para competições e exames de faixa.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="integrantes.php" class="btn-primario">Conheça a equipe</a>
                    <a href="alunos.php" class="btn-contorno">Ver nossos alunos</a>
                </div>
            </div>

            <!-- Modalidades -->
            <div class="grid gap-4 sm:grid-cols-2">
                <?php
                $modalidades = [
                    [
                        'titulo' => 'Infantil',
                        'idade'  => '5 a 12 anos',
                        'texto'  => 'Coordenação, disciplina e convivência através de aulas lúdicas.',
                    ],
                    [
                        'titulo' => 'Juvenil',
                        'idade'  => '13 a 17 anos',
                        'texto'  => 'Técnica, condicionamento e preparação para as primeiras competições.',
                    ],
                    [
                        'titulo' => 'Adulto',
                        'idade'  => '18 anos ou mais',
                        'texto'  => 'Condicionamento completo, defesa pessoal e evolução de graduação.',
                    ],
                    [
                        'titulo' => 'Competição',
                        'idade'  => 'Por convite',
                        'texto'  => 'Treino intensivo para atletas que representam a escola.',
                    ],
                ];
                foreach ($modalidades as $modalidade): ?>
                    <div class="card card-hover">
                        <h3 class="text-lg font-bold text-tkd-950 dark:text-white"><?= $modalidade['titulo'] ?></h3>
                        <p class="mt-1 text-xs font-semibold tracking-wider text-brasa-600 uppercase dark:text-brasa-400">
                            <?= $modalidade['idade'] ?>
                        </p>
                        <p class="mt-3 text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
                            <?= $modalidade['texto'] ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ Benefícios ============ -->
    <section class="secao bg-white dark:bg-neutral-900/50" id="beneficios">
        <div class="container-site">
            <div class="max-w-2xl">
                <p class="titulo-apoio">Por que treinar</p>
                <h2 class="titulo-secao">Benefícios do Taekwondo</h2>
                <p class="subtitulo-secao">
                    O treino vai muito além do tatame — os ganhos aparecem na escola, no trabalho
                    e na vida em família.
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php
                // Cada icone e um path SVG inline: sem dependencia externa, acompanha a cor do texto
                $beneficios = [
                    [
                        'titulo' => 'Condição física',
                        'texto'  => 'Melhora do condicionamento, da força e da flexibilidade em todas as idades.',
                        'icone'  => 'M13 2L4.09 12.97a1 1 0 00.78 1.63H11l-1 7.4 8.91-10.97a1 1 0 00-.78-1.63H12l1-7.4z',
                    ],
                    [
                        'titulo' => 'Disciplina',
                        'texto'  => 'Rotina de treino que desenvolve autocontrole e constância.',
                        'icone'  => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    [
                        'titulo' => 'Autoconfiança',
                        'texto'  => 'Cada graduação conquistada fortalece a autoestima do aluno.',
                        'icone'  => 'M12 15a5 5 0 100-10 5 5 0 000 10zm0 0v7l3-2 3 2-2.5-7M12 22l-3-2-3 2 2.5-7',
                    ],
                    [
                        'titulo' => 'Concentração',
                        'texto'  => 'Foco apurado que se reflete diretamente no desempenho escolar.',
                        'icone'  => 'M12 21a9 9 0 100-18 9 9 0 000 18zm0-4a5 5 0 100-10 5 5 0 000 10zm0-4a1 1 0 100-2 1 1 0 000 2z',
                    ],
                    [
                        'titulo' => 'Respeito',
                        'texto'  => 'Valores de cortesia e respeito ao próximo em cada saudação.',
                        'icone'  => 'M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.66-.13-1.3-.36-1.86m0 0a5 5 0 00-9.28 0M7 20H2v-2a3 3 0 015.36-1.86M7 20v-2c0-.66.13-1.3.36-1.86m0 0a5 5 0 019.28 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                    ],
                    [
                        'titulo' => 'Defesa pessoal',
                        'texto'  => 'Técnicas eficazes aplicadas com responsabilidade e consciência.',
                        'icone'  => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                    ],
                ];
                foreach ($beneficios as $beneficio): ?>
                    <div class="card card-hover">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-tkd-50 text-tkd-700 ring-1 ring-tkd-900/10 dark:bg-tkd-900/40 dark:text-tkd-300 dark:ring-white/10">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="<?= $beneficio['icone'] ?>" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <h3 class="mt-5 text-lg font-bold text-tkd-950 dark:text-white"><?= $beneficio['titulo'] ?></h3>
                        <p class="mt-2 text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
                            <?= $beneficio['texto'] ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ Chamada final ============ -->
    <section class="secao">
        <div class="container-site">
            <div class="relative overflow-hidden rounded-3xl bg-tkd-900 px-8 py-14 text-center sm:px-16">
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--color-tkd-600)_0%,_transparent_70%)] opacity-60"></div>
                <div class="relative">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Pronto para vestir o dobok?
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-neutral-300">
                        A primeira aula é experimental e sem compromisso. Venha conhecer o tatame,
                        os professores e a turma.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-3">
                        <a href="sac.php" class="btn-acento">Falar com a escola</a>
                        <a href="tabela.php" class="btn-claro">Ver graduações</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'partials/footer.php'; ?>
