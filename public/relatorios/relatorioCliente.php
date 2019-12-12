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
        var cpf = $('#cpf').val();
        var nome = $('#nome').val();
        
        $('#conteudoRelatorio').html("Carregando...");

        $.ajax({
            url: "../src/Handler/GerarRelatorioClientesHandler.php",
            type: "POST",
            data: {
                cpf: cpf,
                nome: nome
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
</script>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-5 ">
            <label for="cpf"> CPF: </label>
            <input type="text" class="form-control" id="cpf" name="cpf">
        </div>
        <div class="col-md-5 ">
            <label for="nome"> Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary mt-3" onclick="busca()">
                Gerar
            </button>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12" id="conteudoRelatorio">
            <!-- conteudo relatório -->
        </div>
    </div>
</div>