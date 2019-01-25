# Emissão Nota Fiscal Eletrônica
<h3>Visão geral</h3>
<p>Esse projeto foi desenvolvido em Laravel na versão 5.7 abrangendo os módulos de emissão e consulta de nota fiscal eletrônica utilizando a API REST disponibilizado pela <a href="https://webmaniabr.com/docs/rest-api-nfe/">WebManiaBR </a>.</p>

<h3>Banco de dados</h3>
<p>Está sendo utilizado o banco de dados sqlite para armazenar todos os dados de uma nota fiscal emitida pelo sistema web, menos os dados de resposta da API como chave e xml devido a restrição de acesso.</p>

<h3>Modelos</h3>
<p>Os modelos criados para a interação do sistema com o banco de dados, onde cada um representa uma tabela no banco de dados:</p>
<ul>
    <li><strong>Cliente</strong></li>
    <li><strong>ModalidadeFrete</strong></li>
    <li><strong>Nfe</strong></li>
    <li><strong>Operacao</strong></li>
    <li><strong>Origem</strong></li>
    <li><strong>Pedido</strong></li>
    <li><strong>Presença</strong></li>
    <li><strong>Produto</strong></li>
    <li><strong>Unidade</strong></li>
</ul>

<h3>Controladores</h3>
<p>Tanto a função de consulta quanto a de emissão estão inseridas em apenas um controlador, NfeController, nesse controlador está toda a lógica de comunicação com a API utilizando a biblioteca <a href="https://github.com/guzzle/guzzle">Guzzle</a>, inserção e consulta de NF-e.</p>

<h3>Validação do formulario</h3>
<p>As validações dos dados informados no formulário estão sendo tratados em uma classe request, localizado no diretório app/Http/Requests.</p>
<p>As mensagens de erros não estão sendo traduzidas permanecendo assim as respostas padrões do laravel.
    O campo CPF e CEP são validados utilizando a biblioteca <a href="https://github.com/LaravelLegends/pt-br-validator">LaravelLegends/pt-br-validator</a>.</p>

<h3>Rotas</h3>
<p>Nesse projeto existem 5 rotas definidas:</p>
<ul>
    <li><strong>/</strong> - Redireciona para pagina index.</li>
    <li><strong>/emitirnfe</strong> – Redireciona para o formulário de emissão.</li>
    <li><strong>/salvarnfe</strong> – Redireciona para o controlador NfeController função salvar.</li>
    <li><strong>/consultar</strong> – Redireciona para o formulário de consulta</li>
    <li><strong>/consultar_nfe</strong> – Redireciona para o controlador NfeController função consultar_nfe</li>
</ul>

<h3>Requisitos</h3>
<p>Para execução do sistema é necessário ter instalado</p>
<ul>
    <li><a href="https://getcomposer.org/download/">Composer</a></li>
</ul>

<h3>Inicialização</h3>
<p>Inicialmente é necessário atualizar e instalar as dependências do framework, e para isso acontecer deve ser executado um comando no terminal. Navegue até a pasta do projeto utilizando um terminal e execute o seguinte comando:</p>

<code><h4>composer update</h4></code>

<p>Com o framework atualizado pode dar início a migração das tabelas para o banco de dados, e para isso é necessário executar:</p>

<code><h4>php artisan migrate</h4></code>

<p>Com isso, todas as tabelas já estão criadas no banco, sendo necessário agora apenas preencher algumas tabelas que servem para armazenar dados que são utilizados para preencher campos do formulário de emissão, como por exemplo a tabela Operação, onde está armazenado as opções 0 – Entrada 1 – Saída.</p>
<p>Para preencher essas tabelas executar o seguinte comando:</p>

<code><h4>php artisan db:seed</h4></code>

<p>Após os passos anteriores o projeto já está pronto para ser iniciado, e para isso falta apenas iniciar o servidor web do próprio laravel:</p>

<code><h4>php artisan serve</h4></code>

<p>Com isso será informado um link de acesso ao sistema, por padrão esse link disponibilizado é localhost:8000.</p>
<p>E dessa forma já se tem acesso ao sistema web podendo assim realizar os devidos testes.</p>
