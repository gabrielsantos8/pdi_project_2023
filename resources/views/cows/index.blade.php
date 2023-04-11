@extends('app')
@section('title', 'Vacas')
@section('manClass', '')
@section('relClass', 'active')


@section('content')
    <h1>Vacas - Relatório</h1>
    <table class="table table-striped">
        <thead>
            <tr class="header-table-default">
                <th class="header-table-col-default" scope="col">ID</th>
                <th class="header-table-col-default" scope="col">Nome</th>
                <th class="header-table-col-default" scope="col">Nascimento</th>
                <th class="header-table-col-default" scope="col">Prim. Cria</th>
                <th class="header-table-col-default" scope="col">Últ. Cria</th>
                <th class="header-table-col-default" scope="col">Prev. Próx. Desmama</th>
                <th class="header-table-col-default" scope="col">Prev. Próx. Cria</th>
                <th class="header-table-col-default" scope="col">Litros Leite</th>
                <th class="header-table-col-default" scope="col">Situação</th>
                <th class="header-table-col-default" scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cows as $cow)
                <tr>
                    <th scope="row">{{ $cow->id }}</th>
                    <th scope="row">{{ $cow->nome }}</th>
                    <th scope="row">{{ $cow->nascimento }}</th>
                    <th scope="row">{{ $cow->dataprimeiracria }}</th>
                    <th scope="row">{{ $cow->ultimacria }}</th>
                    <th scope="row">{{ $cow->previsaodesmama }}</th>
                    <th scope="row">{{ $cow->previsaocria }}</th>
                    <th scope="row">{{ $cow->litrosleite }}</th>
                    <th scope="row">{{ $cow->situacao }}</th>
                    <th scope="row">
                        <div class="btn-group" role="group" aria-label="Botões">
                            <a class="botao-default" href="{{ route('cows.edit', $cow->id) }}"><i
                                    class='bx bx-show-alt'></i></a>
                            <form action="{{ route('cows.destroy', $cow) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="botao-risco-default" type="submit"
                                    onclick="return confirm('Tem certeza que deseja apagar?')">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </div>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
