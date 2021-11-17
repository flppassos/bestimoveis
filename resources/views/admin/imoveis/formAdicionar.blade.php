@extends('admin.layouts.principal')

@section('conteudo-principal')

    <section class="section">
        <form action="{{route('admin.imoveis.store')}}" method="POST">
            @csrf

            {{-- Título --}}
            <div class="input-field">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo">
            </div>
            {{-- Cidade --}}
            <div class="input-field">
                <label for="cidade_id">Cidade</label>
                <select name="cidade_id" id="cidade_id">
                    <option value="" disabled>Selecione uma cidade</option>

                    @foreach ($cidades as $cidade)
                        <option value="{{$cidade->id}}">{{$cidade->nome}}</option>
                    @endforeach
                </select>
            </div>

        </form>
    </section>

@endsection