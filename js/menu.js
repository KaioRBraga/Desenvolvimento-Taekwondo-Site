// Abre e fecha o menu de navegacao nas telas pequenas.
document.addEventListener('DOMContentLoaded', function () {
    const botao = document.getElementById('abreMenu');
    const menu = document.getElementById('menuMobile');

    if (!botao || !menu) {
        return;
    }

    botao.addEventListener('click', function () {
        const aberto = menu.classList.toggle('hidden') === false;
        botao.setAttribute('aria-expanded', String(aberto));
        botao.setAttribute('aria-label', aberto ? 'Fechar menu' : 'Abrir menu');
    });

    // Voltar ao desktop com o menu aberto deixaria o estado inconsistente
    window.matchMedia('(min-width: 768px)').addEventListener('change', function (evento) {
        if (evento.matches) {
            menu.classList.add('hidden');
            botao.setAttribute('aria-expanded', 'false');
            botao.setAttribute('aria-label', 'Abrir menu');
        }
    });
});
