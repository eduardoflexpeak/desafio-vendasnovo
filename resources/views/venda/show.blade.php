@extends('adminlte::page')

@section('title', 'Detalhes da Venda')

@section('content_header')
    <h1>Detalhes da Venda</h1>
@stop

@section('content')
<div class="box">
    <div class="box-body">
        <div class="form-group">
            <label for="pessoa_id">Cliente</label>
            <input class="form-control" type="text" value="{{ $venda->pessoa->nome }}" readonly>
        </div>

        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" rows="3" readonly>{{ $venda->observacao }}</textarea>
        </div>

        <div class="row">
            <div class="form-group col-sm-4">
                <label for="pessoa_id">Desconto</label>
                <input class="form-control" type="text" value="{{ $venda->desconto }}" readonly>
            </div>
            <div class="form-group col-sm-4">
                <label for="pessoa_id">Acréscimo</label>
                <input class="form-control" type="text" value="{{ $venda->acrescimo }}" readonly>
            </div>
            <div class="form-group col-sm-4">
                <label for="pessoa_id">Total</label>
                <input class="form-control" type="text" value="{{ $venda->total }}" readonly>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
            </thead>
            <tbody>
                @foreach ($venda->itensVenda as $item)
                    <tr>
                        <th>{{ $item->produto->descricao }}</th>
                        <th>{{ $item->quantidade }}</th>
                        <th>{{ $item->valor_unitario }}</th>
                        <th>{{ $item->valor_total }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <a class="btn btn-primary" href="{{ route('venda.index') }}">Voltar</a>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
