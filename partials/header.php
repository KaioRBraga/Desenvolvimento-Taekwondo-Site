<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);

$links = [
    'index.php'       => 'Início',
    'alunos.php'      => 'Alunos',
    'tabela.php'      => 'Faixas',
    'sac.php'         => 'Contato',
    'integrantes.php' => 'Equipe',
];

// Paginas filhas herdam o destaque do item de menu correspondente
$mapaPaisAtivos = [
    'adicionar_aluno.php' => 'alunos.php',
    'editar_aluno.php'    => 'alunos.php',
];
$itemAtivo = $mapaPaisAtivos[$paginaAtual] ?? $paginaAtual;
?>
<header class="sticky top-0 z-50 border-b border-white/10 bg-tkd-950/95 backdrop-blur supports-[backdrop-filter]:bg-tkd-950/80">
    <div class="container-site flex h-16 items-center justify-between gap-4">

        <a href="index.php" class="flex shrink-0 items-center gap-2.5 text-white">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-white/10 ring-1 ring-white/20">
                <!-- Taegeuk simplificado -->
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M12 2a5 5 0 010 10 5 5 0 000 10" stroke="currentColor" stroke-width="1.5"/>
                </svg>
            </span>
            <span class="hidden text-base font-bold tracking-tight sm:block">Escola Taekwondo</span>
        </a>

        <nav class="hidden md:block" aria-label="Navegação principal">
            <ul class="flex items-center gap-1">
                <?php foreach ($links as $href => $rotulo): ?>
                    <li>
                        <a href="<?= $href ?>"
                           class="link-nav <?= $itemAtivo === $href ? 'link-nav-ativo' : '' ?>"
                           <?= $itemAtivo === $href ? 'aria-current="page"' : '' ?>>
                            <?= $rotulo ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="flex items-center gap-1">
            <button id="alternaTema" type="button" aria-label="Alternar tema"
                    class="grid h-9 w-9 place-items-center rounded-lg text-white/80 transition hover:bg-white/10 hover:text-white">
                <svg class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M21 12.8A9 9 0 1111.2 3a7 7 0 009.8 9.8z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
                <svg class="hidden h-5 w-5 dark:block" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M12 2v2m0 16v2M4.9 4.9l1.4 1.4m11.4 11.4l1.4 1.4M2 12h2m16 0h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>

            <button id="abreMenu" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="menuMobile"
                    class="grid h-9 w-9 place-items-center rounded-lg text-white/80 transition hover:bg-white/10 hover:text-white md:hidden">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </div>

    <nav id="menuMobile" class="hidden border-t border-white/10 md:hidden" aria-label="Navegação principal (mobile)">
        <ul class="container-site space-y-1 py-3">
            <?php foreach ($links as $href => $rotulo): ?>
                <li>
                    <a href="<?= $href ?>" class="link-nav <?= $itemAtivo === $href ? 'link-nav-ativo' : '' ?>">
                        <?= $rotulo ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
