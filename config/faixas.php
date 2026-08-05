<?php
// Graduacoes usadas nos formularios e na listagem de alunos.

$FAIXAS = ['Branca', 'Amarela', 'Verde', 'Azul', 'Vermelha', 'Preta'];

/**
 * Classes Tailwind do selo de cada faixa.
 * As strings ficam literais para o Tailwind detecta-las durante o build.
 */
function classesFaixa(string $faixa): string
{
    $mapa = [
        'Branca'   => 'bg-white text-neutral-800 ring-neutral-300',
        'Amarela'  => 'bg-yellow-300 text-yellow-950 ring-yellow-500',
        'Verde'    => 'bg-green-600 text-white ring-green-700',
        'Azul'     => 'bg-blue-600 text-white ring-blue-700',
        'Vermelha' => 'bg-red-600 text-white ring-red-700',
        'Preta'    => 'bg-neutral-900 text-white ring-neutral-600',
    ];

    return $mapa[$faixa] ?? 'bg-neutral-200 text-neutral-700 ring-neutral-400';
}

/**
 * Resolve o caminho da foto do aluno, aceitando URL externa ou arquivo enviado.
 */
function caminhoFoto(?string $foto): string
{
    if (empty($foto)) {
        return 'img/placeholder.jpg';
    }

    return filter_var($foto, FILTER_VALIDATE_URL) ? $foto : 'uploads/' . $foto;
}
