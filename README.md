# Emissão Nota Fiscal Eletrônica

<h3>Visão geral</h3>
<p>Esse projeto foi desenvolvido em Laravel na versão 5.7 abrangendo os seguintes modulos de NF-e: Emissão, consulta, cancelamento, devolução e validação de certificado. Também incorpora um modulo para consulta de CEP, ambos utilizando a REST API disponibilizado <a href="https://webmaniabr.com/docs/rest-api-nfe/">WebManiaBR </a>.</p>

<h3>Banco de dados</h3>
<p>Está sendo utilizado o banco de dados sqlite para armazenar os dados de NF-e emitida pelo sistema web, menos os dados de resposta da API, como chave e xml devido a restrição de acesso a REST API.</p>

<h3>Modelos</h3>
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
<p>Os metodos da NF-e estão inseridas no controlador NfeController, nele está toda a lógica de comunicação com a REST API NF-e utilizando a biblioteca <a href="https://github.com/guzzle/guzzle">Guzzle</a>. Também existe o controlador CepController responsavel pela comunicação com a REST API CEP.</p>

<h3>Validação do formulario</h3>
<p>As validações dos dados informados no formulário estão sendo tratados em uma classe request, localizado no diretório app/Http/Requests.</p>
<p>As mensagens de erros não estão sendo traduzidas permanecendo assim as respostas padrões do laravel.
    O campo CPF e CEP são validados utilizando a biblioteca <a href="https://github.com/LaravelLegends/pt-br-validator">LaravelLegends/pt-br-validator</a>.</p>

<h3>Rotas</h3>
<p>Nesse projeto existem 2 grupos de rotas definidas, que são <pre>/nfe</pre> e <pre>/cep</pre>.</p>
<p>Grupo de rotas NF-e</p>
<ul>
    <li><strong>/</strong> - Redireciona para pagina index.</li>
    <li><strong>/emitir_nfe</strong> – Redireciona para o formulário de emissão.</li>
    <li><strong>/salvar_nfe</strong> – Redireciona para o controlador NfeController função salvar.</li>
    <li><strong>/consulta</strong> – Redireciona para o formulário de consulta</li>
    <li><strong>/consultar_nfe</strong> – Redireciona para o controlador NfeController função consultar_nfe</li>
    <li><strong>/cancelamento_nfe</strong> - Redireciona para o formulário de cancelamento</li>
    <li><strong>/cancelar_nfe</strong> - Redireciona para o controlador NfeController função cancelar_nfe</li>
    <li><strong>/devolver_nfe</strong> - Redireciona para o formulário de devolução</li>
    <li><strong>/devolucao_nfe</strong> - Redireciona para o controlador NfeController função devolucao_nfe</li>
    <li><strong>/validacao_cert</strong> - Redireciona para o formulário de validação de certificado</li>
    <li><strong>/validar_cert</strong> - Redireciona para o controlador NfeController função validar_cert</li>
    <li><strong>/status_sefaz</strong> - Redireciona para o controlador NfeController função status_sefaz</li>
</ul>

<p>Grupo de rotas CEP</p>
<ul>
    <li><strong>/</strong> – Redireciona para o formulário de consulta CEP.</li>
    <li><strong>/consultar_cep</strong> – Redireciona para o controlador CepController função consultar_cep</li>
</ul>

<h3>Requisitos</h3>
<p>Para execução do sistema é necessário ter instalado</p>
<ul>
    <li><a href="https://getcomposer.org/download/">Composer</a>.</li>
    <li>Contratação de um plano de <a href="https://webmaniabr.com/smartsales/nota-fiscal-eletronica/">NF-e</a>.</li>
    <li>Para consulta de CEP é necessario apenas cadastrar um e-mail no site da WebmaniaBR para receber as chaves de acesso gratuitamente, para mais informações acessar a <a href="https://webmaniabr.com/docs/rest-api-cep-ibge/">documentação</a>.</li>
</ul>

<h3>Utilização</h3>
<p>Para comunicação com a API é preciso adicionar as chaves de acesso no cabeçalho das requisições, e para isso elas devem ser inseridas no construtor de cada controlador.</p>
<p>Exemplo construtor do controlador CEP:</p>
<pre><code php>
public function __construct(){
    $this->app_key = "seu_app_key";
    $this->app_secret = "seu_app_secret";
    $this->client = new Client(['headers' => 
        [
            'Content-type' => 'application/json'
        ]
    ]);
}
</code></pre>

<p>Inicialmente é necessário atualizar e instalar as dependências do framework, e para isso acontecer deve ser executado um comando no terminal. Navegue até a pasta do projeto utilizando um terminal e execute o seguinte comando:</p>

<pre><code>composer update</code></pre>

<p>Com o framework atualizado pode dar início a migração das tabelas para o banco de dados, e para isso é necessário executar:</p>

<pre><code>php artisan migrate</code></pre>

<p>Com isso, todas as tabelas já estão criadas no banco, sendo necessário agora apenas preencher algumas tabelas que servem para armazenar dados que são utilizados para preencher campos do formulário de emissão, como por exemplo a tabela Operação, onde está armazenado as opções 0 – Entrada 1 – Saída.</p>
<p>Para preencher essas tabelas executar o seguinte comando:</p>

<pre><code>php artisan db:seed</code></pre>

<p>Após os passos anteriores o projeto já está pronto para ser iniciado, e para isso falta apenas iniciar o servidor web do próprio laravel:</p>

<pre><code>php artisan serve</code></pre>

<p>Com isso será informado um link de acesso ao sistema, por padrão esse link disponibilizado é localhost:8000.</p>
<p>E dessa forma já se tem acesso ao sistema web podendo assim realizar os devidos testes.</p>
