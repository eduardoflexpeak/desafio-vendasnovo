@extends('adminlte::page')

@section('title', 'Formulário de Pessoa')

@section('content_header')
    <h1>Formulário de Pessoa</h1>
@stop

@section('content')
    @if (isset($pessoa))
        {!! Form::model($pessoa, ['url' => route('pessoa.update', $pessoa), 'method' => 'put']) !!}
    @else
        {!! Form::open(['url' => route('pessoa.store')]) !!}
    @endif
        <div class="form-group">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('telefone', 'Telefone') !!}
            {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cep', 'Cep') !!}
            {!! Form::text('cep', null, ['class' => 'form-control', 'onfocusout' => 'buscaCep()']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('logradouro', 'Logradouro') !!}
            {!! Form::text('logradouro', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bairro', 'Bairro') !!}
            {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('localidade', 'Localidade') !!}
            {!! Form::text('localidade', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('grupo', 'Grupo') !!}
            {!! Form::select('grupo', $grupos, null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
@stop

@section('css')
@stop

@section('js')
<script>
    function buscaCep() {
        let cep = document.getElementById('cep').value;
        let url = 'https://viacep.com.br/ws/' + cep + '/json/';

        axios.get(url)
        .then(function (response) {
            document.getElementById('logradouro').value = response.data.logradouro
            document.getElementById('bairro').value = response.data.bairro
            document.getElementById('localidade').value = response.data.localidade
        })
        .catch(function (error) {
            alert('Ops! CEP não encontrado');
        })
    }
</script>
@stop
