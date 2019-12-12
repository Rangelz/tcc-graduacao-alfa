<form>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="id_produto">Cliente</label>
                <select class="form-control" id="selectCliente"></select>
            </div>
            <div class="col-md-12">
                <label for="tipo_pagamento">Tipo Pagamento</label>
                <select class="form-control" id="selectPagamento">
                    <option value="credito">Cartão de crédito</option>
                    <option value="debito">Cartão de débito</option>
                    <option value="vista">A vista</option>
                </select>
            </div>
            <div class="col-md-8">
                <label for="produto">Produto</label>
                <select class="form-control" id="selectProduto">

                </select>
            </div>
            <div class="col-md-4">
                <label for="produto">Quantidade</label>
                <input type="number" id="quantidade" class="form-control">
            </div>
            <div id="precos"></div>
        </div>
        <hr>
        <button type="button" onclick="adicionarProduto()" class="btn btn-primary">Adicionar</button>
        <button type="button" onclick="limpar()" class="btn btn-danger ml-1">Limpar</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor Unitário</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="tabelalistagem">

        </tbody>
    </table>
    <button type="button" class='btn btn-success' onclick="finalizarCompra()">Finalizar compra</button>
    <div class="float-right"> Total Compra: <b id="totalgeral"></b></div>
</form>
<script>
    function buscarClientes() {
        $.ajax({
            url: "../src/Handler/BuscarClienteHandler.php",
            type: "POST",
            data: "&acao=listarform",
            dataType: "html"
        }).done(function(resposta) {
            $('#selectCliente').html(resposta)
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function buscarProdutos(acao) {
        if (!acao) {
            acao = 'listarform';
        }

        $.ajax({
            url: "../src/Handler/BuscarProdutoHandler.php",
            type: "POST",
            data: "&acao=" + acao,
            dataType: "html"
        }).done(function(resposta) {
            if (acao == 'listarform') {
                $('#selectProduto').html(resposta)
            }

            if (acao == 'listarpreco') {
                $('#precos').html(resposta)
            }
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    function adicionarProduto() {
        let idProduto = $('#selectProduto').val();
        let nomeProduto = $('#selectProduto option:selected').text();
        let quantidade = $('#quantidade').val();
        let preco = $('#' + idProduto).val();

        var numberPattern = /\d+/g;

        quantidade.match(numberPattern)

        quantidade = parseInt(quantidade)

        if (Number.isNaN(quantidade)) {
            swal("Insira uma quantidade valida!")
            return
        }

        let produto = {
            "id": idProduto,
            "nome": nomeProduto,
            "quantidade": quantidade,
            "preco": preco
        }

        let contents = getlocalstorage();

        if (!contents) {
            contents = []
        }
        contents[idProduto] = produto
        localStorage.setItem('produtos', JSON.stringify(contents))
        listarProduto()
    }

    function removerProduto(idProduto) {
        let contents = getlocalstorage()

        contents[idProduto] = null;

        localStorage.setItem('produtos', JSON.stringify(contents))
        listarProduto()
    }

    function getlocalstorage() {
        let contents = localStorage.getItem('produtos')

        if (!contents) {
            localStorage.setItem('produtos', JSON.stringify([]))
        }
        return JSON.parse(contents)
    }

    function listarProduto() {
        let contents = localStorage.getItem('produtos')
        contents = JSON.parse(contents)

        let result = ""
        let totalgeral = 0
        if (contents) {
            contents.map((value, index) => {
                if (value) {
                    let id = "<td>" + value.id + "</td>";
                    let nome = "<td>" + value.nome + "</td>";
                    let quantidade = "<td>" + value.quantidade + "</td>";
                    let preco = "<td>" + (parseFloat(value.preco)).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) + "</td>";
                    let valortotal = (parseFloat(value.preco) * parseInt(value.quantidade))
                    let valortotaltd = valortotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
                    let removerProduto = `<td><button type='button' class='btn btn-danger' onclick='removerProduto(${value.id})'>Remover</button></td>`
                    totalgeral = totalgeral + valortotal
                    valortotal = "<td>" + valortotal + "</td>"
                    result = result + "<tr>" + id + nome + quantidade + preco + valortotal + removerProduto + "</tr>"
                }
            })
        }
        $('#totalgeral').html(totalgeral.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }))
        $('#tabelalistagem').html(result)
    }

    function limparLocalStorage()
    {
        let contents = null
        localStorage.setItem('produtos', JSON.stringify(contents))
        listarProduto()
    }

    function finalizarCompra()
    {
        let contents = getlocalstorage()
        
        $.ajax({
            url: "../src/Handler/FinalizarCompraHandler.php",
            type: "POST",
            data: "&produtos=" + JSON.stringify(contents) +
                   "&idcliente=" + $('#selectCliente').val() + 
                   "&tipopagamento=" + $('#selectPagamento').val(),
            dataType: "html"
        }).done(function(resposta) {
            swal(resposta)
            $('form :input').val(''); //LIMPAR TODOS OS CAMPOS
            limparLocalStorage()
        }).fail(function(jqXHR, textStatus) {

        }).always(function() {

        });
    }

    window.onload = function(e) {
        buscarClientes();
        buscarProdutos();
        buscarProdutos('listarpreco');
        listarProduto();
    }
</script>