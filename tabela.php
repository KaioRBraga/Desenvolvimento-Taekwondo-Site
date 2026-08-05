<?php
$titulo = 'Faixas';
$descricao = 'Conheça as graduações do Taekwondo, o significado de cada faixa e o tempo mínimo de treino entre elas.';
$scripts = ['js/carregar_faixas.js'];
include 'partials/head.php';
include 'partials/header.php';
?>

<main class="flex-1">
    <section class="secao">
        <div class="container-site">

            <div class="max-w-2xl">
                <p class="titulo-apoio">Graduações</p>
                <h1 class="titulo-secao">Faixas do Taekwondo</h1>
                <p class="subtitulo-secao">
                    Cada faixa representa uma etapa da jornada do praticante. A cor não mede apenas
                    técnica: ela conta a história da evolução do aluno, da inocência da branca à
                    maturidade da preta.
                </p>
            </div>

            <div class="tabela-wrap mt-10">
                <table class="tabela" id="tabela-faixas">
                    <thead>
                        <tr>
                            <th class="w-40">Cor</th>
                            <th>Faixa</th>
                            <th>Significado</th>
                            <th class="w-40">Tempo mínimo</th>
                        </tr>
                    </thead>
                    <tbody id="faixa">
                        <tr>
                            <td colspan="4" class="py-10 text-center text-neutral-500">
                                Carregando graduações...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="mt-6 text-sm text-neutral-500 dark:text-neutral-400">
                O tempo mínimo é uma referência: a promoção depende da avaliação técnica e da
                frequência do aluno.
            </p>

        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>
