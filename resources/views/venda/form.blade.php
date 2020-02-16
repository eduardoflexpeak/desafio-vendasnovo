@extends('adminlte::page')

@section('title', 'Formulário de Venda')

@section('content_header')
    <h1>Formulário de Venda</h1>
@stop

@section('content')
    <form action="{{ route('venda.store') }}" method="post" id="form-venda">
        @csrf
        <div class="form-group">
            <label for="pessoa_id">Cliente</label>
            <select class="form-control" name="pessoa_id" id="select-clientes"></select>
        </div>

        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" name="observacao" id="observacao" rows="3"></textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Finalizar Venda</button>
            <span id="total-geral" style="font-size: 25px; margin-left: 25px;">Total: 0.0</span>
        </div>

        <div style="height: 15px;"></div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Produtos da Venda</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="pessoa_id">Produtos</label>
                        <select class="form-control" id="select-produtos"></select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="pessoa_id">Quantidade</label>
                        <input class="form-control" type="number" id="quantidade_add">
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="pessoa_id">Ação</label>
                        <button type="button" class="btn btn-primary" onclick="adicionarProduto()">Adicionar</button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="itens-venda">
                    </tbody>
                </table>

            </div>
        </div>
    </form>
@stop

@section('css')
@stop

@section('js')
<script>
    var totalGeral = 0;

    $('#form-venda').submit(function(){
        if (totalGeral == 0) {
            bootbox.alert('Ops! A venda precisa ter pelo menos um produto');
            return false;
        }

        return true;
    });

    $('#select-clientes').select2({
        ajax: {
            url: '{{ route('lista.clientes') }}',
            dataType: 'json',
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        }
    });
    $('#select-produtos').select2({
        ajax: {
            url: '{{ route('lista.produtos') }}',
            dataType: 'json',
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        }
    });

    function adicionarProduto() {
        let produto = $('#select-produtos').val();
        let quantidade = $('#quantidade_add').val();

        if (produto && quantidade) {
            axios.get('{{ route('produto.index') }}/' + produto)
                .then((response) => {
                    exibirItem(response.data, quantidade);
                })
                .catch((error) => {
                    bootbox.alert('Ops! Erro ao selecionar o produto');
                });
        } else {
            bootbox.alert('Escolha o produto e informe a quantidade');
        }
    }

    function exibirItem(produto, quantidade) {

        let total = parseFloat(produto.preco_venda) * quantidade;
        totalGeral += total;

        let item =  "<tr>";
            item += "<th><input class='form-control' value='" + produto.descricao + "' disabled>";
            item += "<input style='display:none' name='produto_id[]' value='" + produto.id + "' readonly></th>";
            item += "<th><input class='form-control' name='quantidade[]' value='" + quantidade + "' readonly></th>";
            item += "<th><input class='form-control' value='" + produto.preco_venda + "' disabled></th>";
            item += "<th><input class='form-control' value='" + total.toFixed(2) + "' disabled></th>";
            item += "</tr>";

        $('#total-geral').html('Total: ' + totalGeral.toFixed(2));
        $('#itens-venda').append(item);
    }
</script>
@stop
