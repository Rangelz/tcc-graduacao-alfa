<form>
    <div class="row">
        <div class="form-group col-2">
            <label for="id_fornecedor">ID</label>
            <input type="text" class="form-control" id="id_fornecedor" readonly>
        </div>
        <div class="form-group col-10">
            <label for="cpf_cnpj">Cnpj</label>
            <input type="text" class="form-control" id="cpf_cnpj" placeholder="00.000.000/0000.00" data-mask="99.999.999/9999.99">
        </div>
        <div class="form-group col-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome">
        </div>
        <div class="form-group col-6">
            <label for="sobrenome">Sobrenome</label>
            <input type="text" class="form-control" id="sobrenome">
        </div>
        <div class="form-group col-4">
            <label for="endereco">Endereco</label>
            <input type="text" class="form-control" id="endereco">
        </div>
        <div class="form-group col-4">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email">
        </div>
        <div class="form-group col-4">
            <label for="telefone">telefone</label>
            <input type="text" class="form-control" id="telefone" placeholder="(00)0000-0000" data-mask="(99) 99999-9999">
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="salvar()">Salvar</button>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Endereco</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Cpf Cnpj</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabelalistagem">

        </tbody>
    </table>
</form>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalProduto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preco</th>
                        <th scope="col">Custo</th>
                    </tr>
                </thead>
                <tbody id="tabelaProdutos">

                </tbody>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function salvar() {
        let id_fornecedor = $('#id_fornecedor').val();
        let nome = $('#nome').val();
        let sobrenome = $('#sobrenome').val();
        let endereco = $('#endereco').val();
        let email = $('#email').val();
        let telefone = $('#telefone').val();
        let cpf_cnpj = $('#cpf_cnpj').val();

        $.ajax({
            url: "../src/Handler/InserirAtualizarFornecedorHandler.php",
            type: "POST",
            data: "&id_fornecedor=" + id_fornecedor +
                "&nome=" + nome +
                "&sobrenome=" + sobrenome +
                "&endereco=" + endereco +
                "&email=" + email +
                "&telefone=" + telefone +
                "&cpf_cnpj=" + cpf_cnpj,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta) //swal mostra o modal bonitao
            buscarTodos()
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarTodos() {
        $.ajax({
            url: "../src/Handler/BuscarFornecedoresHandler.php",
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
        $('#id_fornecedor').val(id);
        $('#nome').val(conteudo.nome);
        $('#sobrenome').val(conteudo.sobrenome);
        $('#endereco').val(conteudo.endereco);
        $('#email').val(conteudo.email);
        $('#telefone').val(conteudo.telefone);
        $('#cpf_cnpj').val(conteudo.cpf_cnpj);
    }

    function excluir(id) {
        $.ajax({
            url: "../src/Handler/ExcluirFornecedorHandler.php",
            type: "POST",
            data: "&id_fornecedor=" + id,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            buscarTodos();
            $('form :input').val(''); //LIMPAR TODOS OS CAMPOS
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function modalProduto(id) {
        buscarProdutos(id)
    }

    function buscarProdutos(id) {
        $.ajax({
            url: "../src/Handler/BuscarProdutoPorFornecedorHandler.php",
            type: "POST",
            data: "&id_fornecedor=" + id,
            dataType: "html"

        }).done(function(resposta) {
            console.log(resposta)
            $('#tabelaProdutos').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    window.onload = function(e) {
        buscarTodos();
    }
</script>