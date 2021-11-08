@extends('admin.layouts.principal')

@section('conteudo-principal')

    <section class="section">

        <form action="{{route('admin.cidades.adicionar')}}" method="POST">

            {{-- cross-site request forgery csrf --}}
            @csrf

            <div class="input-field">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" />
                @error('nome')
                    <span class="red-text text-accent-3"><small>{{$message}}</small></span>
                @enderror
            </div>
            <div class="right-align">
                <a class="btn-flat waves-effect" href="{{url()->previous()}}">Cancelar</a>
                <button class="btn waves-effect waves-light" type="submit">Salvar</button>
            </div>

        </form>
    </section>

@endsection