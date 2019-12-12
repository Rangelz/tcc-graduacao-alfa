<form>
    <div class="row">
        <div class="form-group col-2">
            <label for="id_cliente">ID Cliente</label>
            <input type="text" class="form-control" id="id_cliente" readonly>
        </div>
        <div class="form-group col-10">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" placeholder="000.000.000-00" data-mask="999.999.999-99">
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
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email">
        </div>
        <div class="form-group col-4">
            <label for="telefone">Telefone</label>
            <input type="text" data-mask="(99) 99999-9999" class="form-control" id="telefone" placeholder="(00)00000-0000" >
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="salvar()">Salvar</button>
    <hr>
    <table id="tabela" class=" tabela table table-striped table-advance table-hover"> 
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">Endereco</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Cpf</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="tabelalistagem">

        </tbody>
    </table>
</form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    function salvar(){
        let id_cliente = $('#id_cliente').val();
        let nome = $('#nome').val();
        let sobrenome = $('#sobrenome').val();
        let endereco = $('#endereco').val();
        let email = $('#email').val();
        let telefone = $('#telefone').val();
        let cpf = $('#cpf').val();
        console.log(id_cliente)
        $.ajax({
            url: "../src/Handler/InserirAtualizarClienteHandler.php",
            type: "POST",
            data: 
                "&id_cliente=" + id_cliente +
                "&nome=" + nome +
                "&sobrenome=" + sobrenome +
                "&endereco=" + endereco +
                "&email=" + email +
                "&telefone=" + telefone +
                "&cpf=" + cpf,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta) //swal mostra o modal bonitao
            buscarTodos()
            $('form :input').val(''); //LIMPAR TODOS OS CAMPOS
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarTodos() {
        $.ajax({
            url: "../src/Handler/BuscarClienteHandler.php",
            type: "POST",
            data: "&nome=" + "",
            dataType: "html"

        }).done(function(resposta) {
            $('#tabelalistagem').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {
            
        });
    }

    function editar(id, conteudo){
        $('#id_cliente').val(id);
        $('#nome').val(conteudo.nome);
        $('#sobrenome').val(conteudo.sobrenome);
        $('#endereco').val(conteudo.endereco);
        $('#email').val(conteudo.email);
        $('#telefone').val(conteudo.telefone);
        $('#cpf').val(conteudo.cpf);
    }

    function excluir(id) {
        $.ajax({
            url: "../src/Handler/ExcluirClienteHandler.php",
            type: "POST",
            data: "&id_cliente=" + id,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            buscarTodos();
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {
            
        });
    }

    window.onload = function(e) {
        buscarTodos();
    }
</script>