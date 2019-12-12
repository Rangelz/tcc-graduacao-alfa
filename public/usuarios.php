<script src="dist/js/jquery-3.4.1.min.js"></script>
<link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

<script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<form>
    <div class="row">
        <div class="form-group col-2">
            <label for="id">ID Usuario</label>
            <input type="text" class="form-control" id="id" readonly>
        </div>
        <div class="form-group col-10">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome">
        </div>
        <div class="form-group col-12">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email">
        </div>
        <div class="form-group col-12">
            <label for="user">Usuario</label>
            <input type="text" class="form-control" id="user">
        </div>
        <div class="form-group col-6">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha">
        </div>
        <div class="form-group col-6">
            <label for="confirmarsenha">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirmarsenha">
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="salvar()">Salvar</button>
    <hr>
    <div id="tabelalistagem"></div>
</form>
<script>
    function salvar() {
        let id = $('#id').val();
        let nome = $('#nome').val();
        let email = $('#email').val();
        let senha = $('#senha').val();
        let user = $('#user').val();
        let confirmarsenha = $('#confirmarsenha').val();

        if (senha !== confirmarsenha) {
            swal({
                icon: 'error',
                title: 'Oops...',
                text: 'As senhas devem ser iguais'
            });
            return;
        }

        $.ajax({
            url: "../src/Handler/InserirAtualizarUsuarioHandler.php",
            type: "POST",
            data: {
                id: id,
                nome: nome,
                email: email,
                senha: senha,
                user: user
            },
            dataType: "text"

        }).done(function(resposta) {
            swal(resposta) //swal mostra o modal bonitao
            $('form :input').val(''); //LIMPAR TODOS OS CAMPOS
            buscarTodos()
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarTodos() {
        $.ajax({
            url: "../src/Handler/BuscarUsuarioHandler.php",
            type: "POST",
            dataType: "html"

        }).done(function(resposta) {
            $('#tabelalistagem').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function editar(id, conteudo) {
        $('#id_cliente').val(id);
        $('#nome').val(conteudo.nome);
        $('#email').val(conteudo.email);
        $('#user').val(conteudo.user);
    }

    function excluir(id) {
        $.ajax({
            url: "../src/Handler/ExcluirUsuarioHandler.php",
            type: "POST",
            data: "&id=" + id,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            buscarTodos();
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    $(document).ready(function(){
        $('#tabelatable').DataTable({
            "language": {
                "url": "plugins/js/Portuguese-Brasil.json"
            }
        });
	});

    window.onload = function(e) {
        buscarTodos();
    }
</script>