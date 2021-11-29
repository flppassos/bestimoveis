@extends('site.layouts.principal')

@section('conteudo-principal')

<section class="section lighten-4 center">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-around">
        @foreach ($cidades as $cidade)
            <a href="#">
                <div class="card-panel" style="width: 280px; height: 100%;">
                    <i class="material-icons medium green-text text-lighten-3">room</i>
                    <h4 class="black-text">{{$cidade->nome}}</h4>
                </div>
            </a>
        @endforeach
    </div>
</section>

@endsection