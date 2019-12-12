<script>
    function onSelectChange(idRelatorio) {
        if (idRelatorio > 0) {
            const mapeamentoRelatorioParaArquivo = {
                1: 'relatorios/relatorioVenda.php',
                2: 'relatorios/relatorioCliente.php',
                3: 'relatorios/relatorioProduto.php',
            };

            $('#relatorio').load(mapeamentoRelatorioParaArquivo[idRelatorio]);        

            return;
        }

        alert('Favor selecione um relatório.');
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center"> Relatórios </h2>
        </div>
        <div class="col-md-12">
            <label for="idRelatorio"> Relatório: </label>
            <select class="form-control" id="idRelatorio" onchange="onSelectChange(this.value)">
                <option value=""> Selecione... </option>
                <option value="1"> Relatório de Venda </option> <!--Data Inicio fim/ Cpf/ Produto/ Categoria/ Tipo de Pagamento -->
                <option value="2"> Relatório de Cliente </option><!--Cpf/Nome  -->
                <option value="3"> Relatório de Produto </option><!--Codigo/ Descricao/ Sem Estoque -->
            </select>
        </div>
    </div>
</div>

<div id="relatorio"> </div>