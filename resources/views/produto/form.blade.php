@extends('adminlte::page')

@section('title', 'Formulário de Produto')

@section('content_header')
    <h1>Formulário de Produto</h1>
@stop

@section('content')
    @if (isset($produto))
        {!! Form::model($produto, ['url' => route('produto.update', $produto), 'method' => 'put']) !!}
    @else
        {!! Form::open(['url' => route('produto.store')]) !!}
    @endif
        <div class="form-group">
            {!! Form::label('descricao', 'Descrição') !!}
            {!! Form::text('descricao', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('estoque', 'Estoque') !!}
            {!! Form::text('estoque', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('preco_custo', 'Preço de Custo') !!}
            {!! Form::text('preco_custo', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('preco_venda', 'Preço de Venda') !!}
            {!! Form::text('preco_venda', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('unidade_medida', 'Unidade de Medida') !!}
            {!! Form::select('unidade_medida', $unidades_medidas, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fabricante_id', 'Fabricante') !!}
            {!! Form::select('fabricante_id', $fabricantes, null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

@section('css')
@stop

@section('js')
@stop
