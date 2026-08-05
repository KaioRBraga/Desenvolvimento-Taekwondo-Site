// A classe .dark ja e aplicada no <head> (partials/head.php) antes da renderizacao,
// para a pagina nao piscar branca. Aqui so tratamos o botao e a persistencia.
document.addEventListener('DOMContentLoaded', function () {
    const raiz = document.documentElement;
    const btnAlternarTema = document.getElementById('alternaTema');

    if (!btnAlternarTema) {
        return;
    }

    btnAlternarTema.addEventListener('click', function () {
        raiz.classList.toggle('dark');
        localStorage.setItem('preferenciaTema', raiz.classList.contains('dark') ? 'dark' : 'light');
    });
});
