<?php
/**
 * Formulario compartilhado por adicionar_aluno.php e editar_aluno.php.
 *
 * Espera:
 *   $aluno        array com nome, idade, faixa, tempo (valores atuais ou vazios)
 *   $textoEnviar  rotulo do botao de envio
 *   $FAIXAS       lista de graduacoes (config/faixas.php)
 */
$aluno = $aluno ?? [];
?>
<form method="post" enctype="multipart/form-data" class="card" novalidate>

    <div id="mensagemForm"></div>

    <!-- ---------- Foto ---------- -->
    <fieldset class="mb-8">
        <legend class="text-sm font-semibold tracking-wider text-tkd-600 uppercase dark:text-tkd-300">
            Foto do aluno
        </legend>
        <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
            Use o endereço de uma imagem da web ou envie um arquivo do computador. É opcional.
        </p>

        <div class="mt-5 grid gap-5 lg:grid-cols-[1fr_auto_1fr]">

            <!-- Opção 1: URL -->
            <div>
                <label class="rotulo" for="foto_url">Endereço da imagem</label>
                <input class="input" type="url" id="foto_url" name="foto_url"
                       placeholder="https://exemplo.com/imagem.jpg">
                <small class="ajuda">Clique com o botão direito na imagem &rsaquo; "Copiar endereço da imagem".</small>
            </div>

            <div class="hidden flex-col items-center gap-2 lg:flex">
                <span class="w-px flex-1 bg-neutral-200 dark:bg-neutral-700"></span>
                <span class="text-xs font-semibold text-neutral-400 uppercase">ou</span>
                <span class="w-px flex-1 bg-neutral-200 dark:bg-neutral-700"></span>
            </div>

            <!-- Opção 2: upload -->
            <div>
                <span class="rotulo">Enviar do computador</span>
                <label id="areaSoltar" for="foto_upload"
                       class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-neutral-300 px-4 py-6 text-center transition hover:border-tkd-500 hover:bg-tkd-50/50 dark:border-neutral-700 dark:hover:border-tkd-400 dark:hover:bg-white/5">
                    <svg class="h-6 w-6 text-neutral-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 16V4m0 0L8 8m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="mt-2 text-sm font-medium text-tkd-900 dark:text-neutral-200">
                        Clique ou arraste um arquivo
                    </span>
                    <span class="mt-0.5 text-xs text-neutral-500">JPG, PNG, GIF ou WebP &middot; até 5 MB</span>
                    <input type="file" id="foto_upload" name="foto_upload" accept="image/*" class="sr-only">
                </label>
            </div>
        </div>

        <div id="areaPreview" class="mt-5 hidden items-center gap-4 rounded-xl bg-neutral-50 p-4 ring-1 ring-neutral-200 dark:bg-neutral-800/50 dark:ring-neutral-700">
            <img id="preview" alt="Pré-visualização da foto"
                 class="h-20 w-20 rounded-lg object-cover ring-1 ring-neutral-200 dark:ring-neutral-700">
            <div class="min-w-0">
                <p class="text-sm font-semibold text-tkd-950 dark:text-white">Pré-visualização</p>
                <p id="nomeArquivo" class="truncate text-xs text-neutral-500"></p>
                <button type="button" id="removePreview" class="mt-2 text-xs font-semibold text-red-600 hover:underline dark:text-red-400">
                    Remover
                </button>
            </div>
        </div>
    </fieldset>

    <!-- ---------- Dados ---------- -->
    <fieldset>
        <legend class="text-sm font-semibold tracking-wider text-tkd-600 uppercase dark:text-tkd-300">
            Dados do aluno
        </legend>

        <div class="mt-5">
            <div class="campo">
                <label class="rotulo" for="nome">Nome completo</label>
                <input class="input" type="text" id="nome" name="nome" required
                       value="<?= htmlspecialchars($aluno['nome'] ?? '') ?>">
            </div>

            <div class="grid gap-x-5 sm:grid-cols-3">
                <div class="campo">
                    <label class="rotulo" for="idade">Idade</label>
                    <input class="input" type="number" id="idade" name="idade" min="5" max="100" required
                           value="<?= htmlspecialchars($aluno['idade'] ?? '') ?>">
                </div>

                <div class="campo">
                    <label class="rotulo" for="faixa">Faixa</label>
                    <select class="input" id="faixa" name="faixa" required>
                        <option value="">Selecione</option>
                        <?php foreach ($FAIXAS as $opcao): ?>
                            <option value="<?= $opcao ?>" <?= ($aluno['faixa'] ?? '') === $opcao ? 'selected' : '' ?>>
                                <?= $opcao ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label class="rotulo" for="tempo">Tempo de prática</label>
                    <input class="input" type="text" id="tempo" name="tempo" placeholder="ex: 2 anos" required
                           value="<?= htmlspecialchars($aluno['tempo'] ?? '') ?>">
                </div>
            </div>
        </div>
    </fieldset>

    <div class="mt-8 flex flex-wrap gap-3 border-t border-neutral-200 pt-6 dark:border-neutral-800">
        <button type="submit" class="btn-primario"><?= htmlspecialchars($textoEnviar) ?></button>
        <a href="alunos.php" class="btn-contorno">Cancelar</a>
    </div>

</form>
