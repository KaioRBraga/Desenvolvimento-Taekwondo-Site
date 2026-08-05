const URL_FAIXAS = 'data/carrega_dados.json';

// Aparencia de cada faixa. As classes ficam literais para o Tailwind detecta-las no build.
const ESTILOS_FAIXA = {
    'Branca':   'bg-white ring-neutral-300',
    'Amarela':  'bg-yellow-400 ring-yellow-500',
    'Verde':    'bg-green-600 ring-green-700',
    'Azul':     'bg-blue-600 ring-blue-700',
    'Vermelha': 'bg-red-600 ring-red-700',
    'Preta':    'bg-neutral-900 ring-neutral-600',
};

// Usado apenas se o JSON estiver indisponivel
const FAIXAS_FALLBACK = [
    { faixa: 'Branca',   significado: 'Inocência e pureza, como uma tela em branco',                  tempo: '3 meses' },
    { faixa: 'Amarela',  significado: 'Terra fértil onde a semente do conhecimento é plantada',       tempo: '4 meses' },
    { faixa: 'Verde',    significado: 'Crescimento, como a planta que brota da terra',                tempo: '4 meses' },
    { faixa: 'Azul',     significado: 'Céu, para onde a planta cresce e se torna forte',              tempo: '5 meses' },
    { faixa: 'Vermelha', significado: 'Perigo, alertando o aluno para controlar seu conhecimento',    tempo: '6 meses' },
    { faixa: 'Preta',    significado: 'Maturidade e domínio, o oposto da inocência da faixa branca',  tempo: '12 meses' },
];

document.addEventListener('DOMContentLoaded', carregarFaixas);

function carregarFaixas() {
    fetch(URL_FAIXAS)
        .then(function (resposta) {
            if (!resposta.ok) {
                throw new Error('HTTP ' + resposta.status);
            }
            return resposta.json();
        })
        .then(function (dados) {
            if (!dados.faixas || dados.faixas.length === 0) {
                throw new Error('JSON sem dados de faixas');
            }
            preencherTabelaFaixas(dados.faixas);
        })
        .catch(function (erro) {
            console.warn('Não foi possível carregar o JSON, usando dados embutidos:', erro);
            preencherTabelaFaixas(FAIXAS_FALLBACK);
        });
}

function escaparHtml(texto) {
    const elemento = document.createElement('div');
    elemento.textContent = texto;
    return elemento.innerHTML;
}

function preencherTabelaFaixas(faixas) {
    const corpo = document.getElementById('faixa');
    if (!corpo) {
        console.error('Corpo da tabela de faixas não encontrado');
        return;
    }

    corpo.innerHTML = '';

    faixas.forEach(function (item, indice) {
        const estilo = ESTILOS_FAIXA[item.faixa] || 'bg-neutral-400 ring-neutral-500';
        const linha = document.createElement('tr');

        linha.innerHTML = `
            <td>
                <div class="flex items-center gap-3">
                    <span class="grid h-6 w-6 shrink-0 place-items-center rounded-full bg-tkd-50 text-[11px] font-bold text-tkd-700 dark:bg-tkd-900/50 dark:text-tkd-300">
                        ${indice + 1}
                    </span>
                    <span class="h-5 w-20 rounded-md ring-1 ring-inset ${estilo}"></span>
                </div>
            </td>
            <td class="font-semibold text-tkd-950 dark:text-white">${escaparHtml(item.faixa)}</td>
            <td class="text-neutral-600 dark:text-neutral-400">${escaparHtml(item.significado)}</td>
            <td class="whitespace-nowrap">
                <span class="chip bg-tkd-50 text-tkd-700 ring-tkd-900/10 dark:bg-tkd-900/40 dark:text-tkd-300 dark:ring-white/10">
                    ${escaparHtml(item.tempo)}
                </span>
            </td>
        `;

        corpo.appendChild(linha);
    });
}
