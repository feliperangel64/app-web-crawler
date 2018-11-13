@extends('layout/principal')

@section('conteudo')

@if(empty($arrDadosVeiculos))
<div class="alert alert-danger">Você não tem nenhum carro cadastrado.</div>

@else
<br>
<h1>Dados dos Veículos</h1>
<table class="table table-striped table-bordered table-hover">
	<thead>
      <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Ano Fab.</th>
        <th>Ano Mod.</th>
        <th>Preço</th>
        <th>Cod.</th>
        <th>Url</th>
    </tr>
</thead>
<tbody>
    @foreach ($arrDadosVeiculos as $veiculo)
    <tr>
        <td>{{$veiculo->marca}}</td>
        <td>{{$veiculo->modelo}}</td>
        <td>{{$veiculo->ano_fabricacao}}</td>
        <td>{{$veiculo->ano_modelo}}</td>
        <td>{{$veiculo->preco}}</td>
        <td>{{$veiculo->cod_carro}}</td>
        <td>{{substr($veiculo->url_carro, 0, 50).'...'}}</td>
    </tr>
    @endforeach
</tbody>
</table>
@endif
@stop