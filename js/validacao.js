document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('contact-form');
    if (!formulario) {
        return;
    }

    const campoEmail = document.getElementById('email');
    const campoCpf = document.getElementById('cpf');

    const CLASSES_ERRO = ['ring-2', 'ring-red-500'];
    const CLASSES_OK = ['ring-2', 'ring-emerald-500'];

    function validarEmail(email) {
        return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
    }

    function validarCPF(cpf) {
        return /^\d{3}\.\d{3}\.\d{3}-\d{2}$/.test(cpf);
    }

    function formatarCPF(cpf) {
        return cpf
            .replace(/\D/g, '')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{2})$/, '$1-$2');
    }

    function aplicarEstado(campo, valido, mensagem) {
        const erro = document.getElementById(campo.id + '-error');

        campo.classList.remove(...CLASSES_ERRO, ...CLASSES_OK);
        campo.classList.add(...(valido ? CLASSES_OK : CLASSES_ERRO));
        campo.setAttribute('aria-invalid', String(!valido));

        if (erro) {
            erro.textContent = valido ? '' : mensagem;
        }
    }

    function limparEstado(campo) {
        campo.classList.remove(...CLASSES_ERRO, ...CLASSES_OK);
        campo.removeAttribute('aria-invalid');
        const erro = document.getElementById(campo.id + '-error');
        if (erro) {
            erro.textContent = '';
        }
    }

    if (campoEmail) {
        campoEmail.addEventListener('blur', function () {
            // Campo vazio ainda nao foi preenchido: nao acusa erro antes da hora
            if (this.value === '') {
                limparEstado(this);
                return;
            }
            aplicarEstado(this, validarEmail(this.value), 'Formato inválido. Use: exemplo@dominio.com');
        });
    }

    if (campoCpf) {
        campoCpf.addEventListener('input', function () {
            this.value = formatarCPF(this.value);
        });

        campoCpf.addEventListener('blur', function () {
            if (this.value === '') {
                limparEstado(this);
                return;
            }
            aplicarEstado(this, validarCPF(this.value), 'Formato inválido. Use: 999.999.999-99');
        });
    }

    formulario.addEventListener('submit', function (evento) {
        evento.preventDefault();

        let valido = true;

        if (campoEmail) {
            const emailOk = validarEmail(campoEmail.value);
            aplicarEstado(campoEmail, emailOk, 'Formato inválido. Use: exemplo@dominio.com');
            valido = valido && emailOk;
        }

        if (campoCpf) {
            const cpfOk = validarCPF(campoCpf.value);
            aplicarEstado(campoCpf, cpfOk, 'Formato inválido. Use: 999.999.999-99');
            valido = valido && cpfOk;
        }

        if (!valido) {
            alert('Por favor, corrija os erros no formulário antes de enviar.');
            return;
        }

        alert('Formulário enviado com sucesso!');
        formulario.reset();
        [campoEmail, campoCpf].forEach(function (campo) {
            if (campo) {
                limparEstado(campo);
            }
        });
    });
});
