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
        var tipo_pagamento = $('#tipo_pagamento').val();
        var dataInicio = $('#datainicio').val();
        var dataFim = $('#datafim').val();

        $('#conteudoRelatorio').html("Carregando...");

        $.ajax({
            url: "../src/Handler/GerarRelatorioVendasHandler.php",
            type: "POST",
            data: {
                cpf: cpf,
                tipoPagamento: tipo_pagamento,
                dataInicio: dataInicio,
                dataFim: dataFim
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

<?php
    $dataInicial = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $dataInicial->modify("-2 month");
    $dataInicialString = $dataInicial->format("Y-m-01");

    $dataFinal = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    $dataFinal->modify('last day of this month');
    $dataFinalString = $dataFinal->format("Y-m-d");
?>

<div class="container mt-3">
    <form>
        <div class="form-group">
            <label for="cpf"> CPF Cliente: </label>
            <input type="text" class="form-control" id="cpf" name="cpf">
        </div>

        <div class="form-group">
            <label for="tipo_pagamento">Tipo Pagamento</label>
            <select class="form-control" id="tipo_pagamento">
                <option value="">Selecione</option>
                <option value="credito">Cartão de crédito</option>
                <option value="debito">Cartão de débito</option>
                <option value="vista">A vista</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="datainicio"> Data Inicio: </label>
                    <input type="date" id="datainicio" value="<?php echo $dataInicialString; ?>" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="datafim"> Data Final: </label>
                    <input type="date" id="datafim"value="<?php echo $dataFinalString; ?>" class="form-control">
                </div>
            </div>
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