@extends('admin.layouts.principal')

@section('conteudo-principal')

    <section class="section">
        <table class="highlight">
            <thead>
                <tr>
                    <th>Cidade</th>
                    <th class="right-align">Opções</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cidades as $cidade)
                    <tr>
                        <td>{{$cidade}}</td>
                        <td class="right-align">Editar - Remover</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Não existem cidades cadastradas!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

@endsection
@section('secundario')
    <section>
        <p>Texto Secundário</p>
    </section>
@endsection