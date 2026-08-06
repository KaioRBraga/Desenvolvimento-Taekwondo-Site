<?php
$titulo = 'Contato';
$descricao = 'Fale com a Escola de Taekwondo: tire dúvidas sobre matrículas, turmas e horários, ou envie sugestões.';
$scripts = ['js/validacao.js'];
include 'partials/head.php';
include 'partials/header.php';
?>

<main class="flex-1">
    <section class="secao">
        <div class="container-site">

            <div class="max-w-2xl">
                <p class="titulo-apoio">Atendimento</p>
                <h1 class="titulo-secao">Fale com a escola</h1>
                <p class="subtitulo-secao">
                    Tire dúvidas sobre turmas e matrículas, faça sugestões ou relate um problema.
                    Respondemos em até um dia útil.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">

                <!-- Canais -->
                <aside class="space-y-4 lg:order-2">
                    <?php
                    $canais = [
                        [
                            'titulo' => 'Horário de atendimento',
                            'linhas' => ['Segunda a sexta, 8h às 21h', 'Sábado, 8h às 12h'],
                            'icone'  => 'M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z',
                        ],
                        [
                            'titulo' => 'Aula experimental',
                            'linhas' => ['Gratuita e sem compromisso', 'Basta agendar pelo formulário'],
                            'icone'  => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        ],
                        [
                            'titulo' => 'Documentos',
                            'linhas' => ['Para matrícula: RG e comprovante', 'Menores: autorização do responsável'],
                            'icone'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        ],
                    ];
                    foreach ($canais as $canal): ?>
                        <div class="card">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-tkd-50 text-tkd-700 ring-1 ring-tkd-900/10 dark:bg-tkd-900/40 dark:text-tkd-300 dark:ring-white/10">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="<?= $canal['icone'] ?>" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <h2 class="mt-4 font-bold text-tkd-950 dark:text-white"><?= $canal['titulo'] ?></h2>
                            <?php foreach ($canal['linhas'] as $linha): ?>
                                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400"><?= $linha ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </aside>

                <!-- Formulário -->
                <div class="card lg:order-1 lg:col-span-2">
                    <form id="contact-form" novalidate>

                        <div class="campo">
                            <label class="rotulo" for="nome">Nome completo</label>
                            <input class="input" type="text" id="nome" name="nome"
                                   placeholder="Como devemos te chamar?" required>
                        </div>

                        <div class="grid gap-x-5 sm:grid-cols-2">
                            <div class="campo">
                                <label class="rotulo" for="email">E-mail</label>
                                <input class="input" type="email" id="email" name="email"
                                       placeholder="exemplo@dominio.com" required>
                                <small class="erro-campo" id="email-error"></small>
                            </div>

                            <div class="campo">
                                <label class="rotulo" for="cpf">CPF</label>
                                <input class="input" type="text" id="cpf" name="cpf"
                                       placeholder="999.999.999-99" inputmode="numeric" maxlength="14" required>
                                <small class="erro-campo" id="cpf-error"></small>
                            </div>
                        </div>

                        <div class="campo">
                            <label class="rotulo" for="assunto">Assunto</label>
                            <select class="input" id="assunto" name="assunto" required>
                                <option value="">Selecione um assunto</option>
                                <option value="duvida">Dúvida sobre as turmas</option>
                                <option value="matricula">Matrícula</option>
                                <option value="experimental">Aula experimental</option>
                                <option value="reclamacao">Reclamação</option>
                                <option value="sugestao">Sugestão</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="campo">
                            <label class="rotulo" for="mensagem">Mensagem</label>
                            <textarea class="input resize-y" id="mensagem" name="mensagem" rows="6"
                                      placeholder="Descreva sua dúvida, sugestão ou problema..." required></textarea>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-4">
                            <button type="submit" class="btn-primario">
                                Enviar mensagem
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12h14m-6-6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400">
                                Seus dados são usados apenas para responder ao contato.
                            </p>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>
