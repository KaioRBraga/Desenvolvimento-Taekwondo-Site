# Desenvolvimento Taekwondo Site

Repositório destinado ao projeto de desenvolvimento web da aula de quarta-feira. O projeto consiste em um site institucional para uma escola de Taekwondo, com páginas informativas em HTML e um módulo de gerenciamento de alunos desenvolvido em PHP.

## Sobre o projeto

O site reúne informações sobre a escola (integrantes, tabela de graduações, canal de atendimento/SAC) e um pequeno sistema CRUD para cadastro, edição, listagem e exclusão de alunos, com dados persistidos em banco de dados.

## Estrutura do repositório

```
Desenvolvimento-Taekwondo-Site/
├── ara0062-escola-quarta/   # Material/entrega da disciplina
├── config/                  # Configurações do projeto (ex: conexão com o banco de dados)
├── css/                     # Folhas de estilo do site
├── data/                    # Dados utilizados pela aplicação
├── img/                     # Imagens do site
├── js/                      # Scripts JavaScript
├── uploads/                 # Arquivos enviados pelos usuários (ex: fotos de alunos)
├── adicionar_aluno.php      # Cadastro de novos alunos
├── alunos.php                # Listagem de alunos cadastrados
├── editar_aluno.php          # Edição dos dados de um aluno
├── excluir_aluno.php         # Exclusão de um aluno
├── index.html                # Página inicial do site
├── integrantes.html          # Página com os integrantes/equipe
├── sac.html                   # Página de atendimento ao cliente
└── tabela.html                 # Página com tabela de graduações/faixas
```

## Tecnologias utilizadas

- **HTML5** — estrutura das páginas
- **CSS3** — estilização do site
- **JavaScript** — interatividade no front-end
- **PHP** — lógica de back-end e integração com banco de dados
- **MySQL** (via arquivos de `config`) — persistência dos dados dos alunos

## Como executar o projeto

1. Clone o repositório:
   ```bash
   git clone https://github.com/KaioRBraga/Desenvolvimento-Taekwondo-Site.git
   ```
2. Coloque a pasta do projeto em um servidor local com suporte a PHP, como o **XAMPP**, **WAMP** ou **MAMP** (ex: dentro de `htdocs`).
3. Crie o banco de dados necessário e ajuste as credenciais de conexão na pasta `config/`.
4. Inicie o Apache e o MySQL pelo painel do seu servidor local.
5. Acesse no navegador:
   ```
   http://localhost/Desenvolvimento-Taekwondo-Site/index.html
   ```

## Funcionalidades

- Página inicial institucional
- Página com os integrantes do projeto
- Página de atendimento (SAC)
- Tabela de faixas/graduações
- Cadastro de alunos
- Listagem de alunos
- Edição de dados de alunos
- Exclusão de alunos

## Licença

Este projeto foi desenvolvido para fins acadêmicos, como parte da disciplina de Desenvolvimento Web.

## Autor

Desenvolvido por [Kaio Rodrigues Braga](https://github.com/KaioRBraga).
