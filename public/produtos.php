<form>
    <div class="row">
        <div class="form-group col-2">
            <label for="id_produto">ID Produto</label>
            <input type="text" class="form-control" id="id_produto" readonly>
        </div>
        <div class="form-group col-6">
            <label for="nome">Produto</label>
            <input type="text" class="form-control" id="nome">
        </div>
        <div class="form-group col-6">
            <label for="sobrenome">Quantidade</label>
            <input type="text" class="form-control" id="quantidade" value="0">
        </div>
        <div class="form-group col-4">
            <label for="endereco">Preco</label>
            <input type="number" class="form-control" id="preco" value="0">
        </div>
        <div class="form-group col-12">
            <label for="categoria">Categoria</label>
            <select id="selectCategorias" class="custom-select my-1 mr-sm-2">
            </select>
        </div>
    </div>
    <button type="button" onclick="salvar()" class="btn btn-primary">Salvar</button>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preco</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="tabelalistagem">

        </tbody>
    </table>
</form>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalProdutoFornecedor">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-8">
                        <label for="nome">Fornecedor</label>
                        <select id="selectFornecedores" class="form-control">
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>Custo</label>
                        <input type="text" class="form-control" id="custo">
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-success" onclick="salvarProdutoFornecedor()">Salvar</button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Custo</th>
                    </tr>
                </thead>
                <tbody id="tabelaFornecedores">

                </tbody>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalQuantidade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Quantidade de Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-8">
                        <label for="nome">ID</label>
                        <input type="text" class="form-control" id="idprodutomodal" readonly>
                    </div>
                    <div class="form-group col-8">
                        <label for="nome">Produto</label>
                        <input type="text" class="form-control" id="produtomodal" readonly>
                    </div>
                    <div class="form-group col-2">
                        <label>Quantidade</label>
                        <input type="text" class="form-control" id="quantidademodal" readonly>
                    </div>
                    <div class="form-group col-12">
                        <label>Quantidade a adicionar</label>
                        <input type="text" class="form-control" id="quantidadeadicionarmodal">
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-success" onclick="adicionarQuantidade()">Salvar</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function salvar() {
        let id_produto = $('#id_produto').val();
        let nome = $('#nome').val();
        let quantidade = $('#quantidade').val();
        let id_categoria = $('#selectCategorias').val();
        let preco = $('#preco').val();
        let idfornecedor = $('#selectFornecedores').val();
        //        $('#selectFornecedores').val(conteudo.id_fornecedor);

        $.ajax({
            url: "../src/Handler/InserirAtualizarProdutoHandler.php",
            type: "POST",
            data: "&id_produto=" + id_produto +
                "&id_categoria=" + id_categoria +
                "&nome=" + nome +
                "&quantidade=" + quantidade +
                "&preco=" + preco +
                "&idFornecedor=" + idfornecedor,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta) //swal mostra o modal bonitao
            buscarTodos()
            $('form :input').val(''); //LIMPAR TODOS OS CAMPOS
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarFornecedores() {
        $.ajax({
            url: "../src/Handler/BuscarFornecedoresHandler.php",
            type: "POST",
            data: "&acao=listarform",
            dataType: "html"

        }).done(function(resposta) {
            console.log(resposta)
            $('#selectFornecedores').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarCategorias() {
        $.ajax({
            url: "../src/Handler/BuscarCategoriasHandler.php",
            type: "POST",
            data: "&acao=listarform",
            dataType: "html"

        }).done(function(resposta) {
            console.log(resposta)
            $('#selectCategorias').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarTodos() {
        $.ajax({
            url: "../src/Handler/BuscarProdutoHandler.php",
            type: "POST",
            data: "&nome=" + "",
            dataType: "html"

        }).done(function(resposta) {
            $('#tabelalistagem').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function editar(id, conteudo) {
        let id_produto = $('#id_produto').val();
        let nome = $('#nome').val();
        let quantidade = $('#quantidade').val();
        let id_categoria = $('#selectCategorias').val();
        let preco = $('#preco').val();

        $('#id_produto').val(id);
        $('#nome').val(conteudo.nome);
        $('#quantidade').prop("disabled", true);
        $('#quantidade').val(conteudo.quantidade);
        $('#selectCategorias').val(conteudo.id_categoria);
        $('#preco').val(conteudo.preco);
    }

    function excluir(id) {
        console.log(id)
        $.ajax({
            url: "../src/Handler/ExcluirProdutoHandler.php",
            type: "POST",
            data: "&id_produto=" + id,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            buscarTodos();
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function fornecedor(idProduto) {
        $.ajax({
            url: "../src/Handler/BuscarFornecedoresProdutosHandler.php",
            type: "POST",
            data: "&id_produto=" + idProduto,
            dataType: "html"

        }).done(function(resposta) {
            console.log(idProduto)
            $('#tabelaFornecedores').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });

        localStorage.setItem('produto', idProduto)
    }

    function salvarProdutoFornecedor()
    {
        let id_produto = localStorage.getItem('produto');
        let id_fornecedor = $('#selectFornecedores').val();
        let custo = $("#custo").val();

        $.ajax({
            url: "../src/Handler/InserirAtualizarProdutoFornecedorHandler.php",
            type: "POST",
            data: "&id_produto=" + id_produto + "&id_fornecedor=" + id_fornecedor + "&custo=" + custo,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            fornecedor(id_produto);
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {
        });
    }

    function modalQuantidade(idProduto, quantidade, nome)
    {
        $("#idprodutomodal").val(idProduto);
        $("#quantidademodal").val(quantidade);
        $("#produtomodal").val(nome);
    }

    function adicionarQuantidade()
    {
        let quantidade = parseInt($("#quantidadeadicionarmodal").val());
        let id = $("#idprodutomodal").val();

        if (!quantidade) {
            swal('O campo deve de quantidade deve ser preenchido!')
            return;

        }
        
        if (quantidade < 0) {
            swal('O campo deve de quantidade deve ser maior que 0!')
            return;
        }

        if (isNaN(quantidade)) {
            swal('Número inválido!')
            return;
        }

        $.ajax({
            url: "../src/Handler/AdicionarQuantidadeHandler.php",
            type: "POST",
            data: "&id_produto=" + id + "&quantidade=" + quantidade,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            buscarTodos()
            $('#modalQuantidade').modal('toggle')
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {
        });

    }

    window.onload = function(e) {
        buscarTodos();
        buscarFornecedores();
        buscarCategorias();
    }
</script>