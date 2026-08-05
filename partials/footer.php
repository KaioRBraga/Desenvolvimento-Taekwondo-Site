<footer class="mt-auto bg-tkd-950 text-neutral-400">
    <div class="container-site py-14">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

            <div class="lg:col-span-2">
                <div class="flex items-center gap-2.5 text-white">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-white/10 ring-1 ring-white/20">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M12 2a5 5 0 010 10 5 5 0 000 10" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                    </span>
                    <span class="text-base font-bold tracking-tight">Escola Taekwondo</span>
                </div>
                <p class="mt-4 max-w-sm text-sm leading-relaxed">
                    Arte marcial coreana milenar, ensinada com foco no desenvolvimento físico,
                    mental e espiritual de cada aluno.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold tracking-wider text-white uppercase">Navegação</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="index.php" class="transition hover:text-white">Início</a></li>
                    <li><a href="alunos.php" class="transition hover:text-white">Alunos</a></li>
                    <li><a href="tabela.php" class="transition hover:text-white">Faixas</a></li>
                    <li><a href="integrantes.php" class="transition hover:text-white">Equipe</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold tracking-wider text-white uppercase">Atendimento</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="sac.php" class="transition hover:text-white">Fale conosco</a></li>
                    <li>Segunda a sexta, 8h às 21h</li>
                    <li>Sábado, 8h às 12h</li>
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-white/10 pt-6 text-center text-sm">
            <p>&copy; <?= date('Y') ?> Escola de Taekwondo &middot; Todos os direitos reservados</p>
        </div>
    </div>
</footer>

<script src="js/tema.js"></script>
<script src="js/menu.js"></script>
<?php foreach ($scripts ?? [] as $script): ?>
    <script src="<?= $script ?>"></script>
<?php endforeach; ?>
</body>
</html>
