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

<script>
    function busca() {
        var codigo = $('#codigo').val();
        var descricao = $('#descricao').val();
        var sem_estoque = $('#sem_estoque').is(":checked");/*Estoque True-False*/
        var categoria = $('#selectCategorias').val();

        $('#conteudoRelatorio').html("Carregando...");

        $.ajax({
            url: "../src/Handler/GerarRelatorioProdutosHandler.php",
            type: "POST",
            data: {
                codigo: codigo,
                descricao: descricao,
                sem_estoque: sem_estoque,
                categoria: categoria
            },
            dataType: "html"

        }).done(function(resposta) {
            console.log(resposta)
            $('#conteudoRelatorio').html(resposta)
            aplicarDataTable();
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
            $('#selectCategorias').append(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function aplicarDataTable() {
        $('#conteudoRelatorio table').DataTable({
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

    buscarCategorias();
</script>

<div class="container mt-3">
    <form>
        <div class="form-group">
            <label for="codigo"> Codigo: </label>
            <input type="text" class="form-control" id="codigo" name="codigo">
        </div>
        <div class="form-group">
            <label for="descricao"> Descricao: </label>
            <input type="text" class="form-control" id="descricao" name="descricao">
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select id="selectCategorias" class="custom-select my-1 mr-sm-2">
                <option value='0'>Selecione</option>
            </select>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="sem_estoque">
            <label class="form-check-label" for="sem_estoque">Sem Estoque</label>
        </div>
        <button type="button" class="btn btn-primary mt-3" onclick="busca()">
            Gerar
        </button>
    </form>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12" id="conteudoRelatorio">
            <!-- conteudo relatório -->
        </div>
    </div>
</div>