@extends('admin.layouts.principal')

@section('conteudo-principal')

    <section>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large waves-effect waves-light" href="{{route('admin.imoveis.create')}}">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </section>

@endsection