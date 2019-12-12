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
            <label for="id_categoria">id categoria</label>
            <input type="text" class="form-control" id="id_categoria" readonly>
        </div> 
        <div class="form-group col-10">
            <label for="nome">nome</label>
            <input type="text" class="form-control" id="nome">
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="salvar()">Salvar</button>
    <hr>
    <div  class="datatable">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabelalistagem">

        </tbody>
    </table>
    </div>
</form>
<script>
    function salvar(){
        let id_categoria = $('#id_categoria').val();
        let nome = $('#nome').val();

        $.ajax({
            url: "../src/Handler/InserirAtualizarCategoriaHandler.php",
            type: "POST",
            data: 
                "&id_categoria=" + id_categoria +
                "&nome=" + nome,
            dataType: "html"

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
            url: "../src/Handler/BuscarCategoriasHandler.php",
            type: "POST",
            data: "&nome=" + "",
            dataType: "html"

        }).done(function(resposta) {
            $('#tabelalistagem').html(resposta)
            aplicarDataTable()
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {
            
        });
    }

    function editar(id, conteudo){
        $('#id_categoria').val(id);
        $('#nome').val(conteudo.nome_categoria);
    }

    function excluir(id) {
        $.ajax({
            url: "../src/Handler/ExcluirCategoriaHandler.php",
            type: "POST",
            data: "&id_categoria=" + id,
            dataType: "html"

        }).done(function(resposta) {
            swal(resposta)
            buscarTodos();
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {
            
        });
    }

    function aplicarDataTable() {
        $('#datatable table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            paging: false,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
            }
        });
    }

    window.onload = function(e) {
        buscarTodos();
    }
</script>