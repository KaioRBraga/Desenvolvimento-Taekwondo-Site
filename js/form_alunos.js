// Preview de foto (URL ou upload), arrastar-e-soltar e validacao do formulario de aluno.
document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.querySelector('form');
    if (!formulario) {
        return;
    }

    const campoUrl = document.getElementById('foto_url');
    const campoArquivo = document.getElementById('foto_upload');
    const areaSoltar = document.getElementById('areaSoltar');
    const areaPreview = document.getElementById('areaPreview');
    const preview = document.getElementById('preview');
    const nomeArquivo = document.getElementById('nomeArquivo');
    const btnRemover = document.getElementById('removePreview');
    const areaMensagem = document.getElementById('mensagemForm');

    const TAMANHO_MAXIMO = 5 * 1024 * 1024;
    const TIPOS_ACEITOS = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

    // ---------- Mensagens ----------
    function mostrarMensagem(texto, tipo) {
        if (!areaMensagem) {
            return;
        }
        areaMensagem.innerHTML =
            '<div class="' + (tipo === 'erro' ? 'alerta-erro' : 'alerta-sucesso') + '">' +
            '<span>' + texto + '</span></div>';

        clearTimeout(mostrarMensagem.temporizador);
        mostrarMensagem.temporizador = setTimeout(function () {
            areaMensagem.innerHTML = '';
        }, 5000);
    }

    // ---------- Preview ----------
    function exibirPreview(fonte, rotulo) {
        preview.src = fonte;
        nomeArquivo.textContent = rotulo || '';
        areaPreview.classList.remove('hidden');
        areaPreview.classList.add('flex');
    }

    function ocultarPreview() {
        preview.removeAttribute('src');
        nomeArquivo.textContent = '';
        areaPreview.classList.add('hidden');
        areaPreview.classList.remove('flex');
    }

    function urlDeImagemValida(url) {
        try {
            return /\.(jpe?g|png|gif|webp|bmp)$/i.test(new URL(url).pathname);
        } catch (erro) {
            return false;
        }
    }

    function processarArquivo(arquivo) {
        if (!TIPOS_ACEITOS.includes(arquivo.type)) {
            mostrarMensagem('Formato não permitido. Use JPG, PNG, GIF ou WebP.', 'erro');
            campoArquivo.value = '';
            return;
        }

        if (arquivo.size > TAMANHO_MAXIMO) {
            mostrarMensagem('Arquivo muito grande. O tamanho máximo é 5 MB.', 'erro');
            campoArquivo.value = '';
            return;
        }

        const leitor = new FileReader();
        leitor.onload = function (evento) {
            exibirPreview(evento.target.result, arquivo.name);
            if (campoUrl) {
                campoUrl.value = '';
            }
        };
        leitor.onerror = function () {
            mostrarMensagem('Erro ao ler a imagem. Tente novamente.', 'erro');
        };
        leitor.readAsDataURL(arquivo);
    }

    if (campoUrl) {
        campoUrl.addEventListener('input', function () {
            const valor = this.value.trim();

            if (valor === '') {
                ocultarPreview();
                return;
            }

            if (urlDeImagemValida(valor)) {
                exibirPreview(valor, valor);
                if (campoArquivo) {
                    campoArquivo.value = '';
                }
            } else {
                ocultarPreview();
            }
        });
    }

    if (campoArquivo) {
        campoArquivo.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                processarArquivo(this.files[0]);
            } else {
                ocultarPreview();
            }
        });
    }

    if (btnRemover) {
        btnRemover.addEventListener('click', function () {
            if (campoUrl) campoUrl.value = '';
            if (campoArquivo) campoArquivo.value = '';
            ocultarPreview();
        });
    }

    // ---------- Arrastar e soltar ----------
    if (areaSoltar && campoArquivo) {
        const CLASSES_ATIVA = ['border-tkd-500', 'bg-tkd-50/50'];

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function (evento) {
            areaSoltar.addEventListener(evento, function (e) {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        ['dragenter', 'dragover'].forEach(function (evento) {
            areaSoltar.addEventListener(evento, function () {
                areaSoltar.classList.add(...CLASSES_ATIVA);
            });
        });

        ['dragleave', 'drop'].forEach(function (evento) {
            areaSoltar.addEventListener(evento, function () {
                areaSoltar.classList.remove(...CLASSES_ATIVA);
            });
        });

        areaSoltar.addEventListener('drop', function (e) {
            const arquivos = e.dataTransfer.files;
            if (arquivos.length > 0) {
                campoArquivo.files = arquivos;
                processarArquivo(arquivos[0]);
            }
        });
    }

    // ---------- Validação ----------
    const CLASSES_ERRO = ['ring-2', 'ring-red-500'];

    formulario.addEventListener('submit', function (evento) {
        let valido = true;

        formulario.querySelectorAll('[required]').forEach(function (campo) {
            campo.classList.remove(...CLASSES_ERRO);
            if (campo.value.trim() === '') {
                campo.classList.add(...CLASSES_ERRO);
                valido = false;
            }
        });

        const campoIdade = document.getElementById('idade');
        if (campoIdade && campoIdade.value !== '') {
            const idade = parseInt(campoIdade.value, 10);
            if (idade < 5 || idade > 100) {
                campoIdade.classList.add(...CLASSES_ERRO);
                mostrarMensagem('A idade deve estar entre 5 e 100 anos.', 'erro');
                evento.preventDefault();
                return;
            }
        }

        if (!valido) {
            evento.preventDefault();
            mostrarMensagem('Preencha todos os campos obrigatórios.', 'erro');
        }
    });
});
