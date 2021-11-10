@extends('admin.layouts.principal')

@section('conteudo-principal')

    <section class="section">

        <form action="{{route('admin.cidades.update', $cidade->id)}}" method="POST">

            {{-- cross-site request forgery csrf --}}
            @csrf
            @method('PUT')

            <div class="input-field">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="{{$cidade->nome}}"/>
                @error('nome')
                    <span class="red-text text-accent-3"><small>{{$message}}</small></span>
                @enderror
            </div>
            <div class="right-align">
                <a class="btn-flat waves-effect" href="{{route('admin.cidades.index')}}">Cancelar</a>
                <button class="btn waves-effect waves-light" type="submit">Salvar</button>
            </div>

        </form>
    </section>

@endsection