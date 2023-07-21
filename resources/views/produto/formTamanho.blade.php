@extends('layouts.base')
@section('content')

<h1> Produto: {{ $produto->nome}}</h1>
<h2>
    {{
        ($produtoTamanho):
        'Editar Tamanho'?
        'Cadastrar Tamanho'
    }}
</h2>
<form action="{{
            ($ProdutoTamanho)
            route('cargo.update', ['id'=>$cargo->id_cargo])
    route('car!id produtoupdate', ['id_produto'=>$cargo->id_cargo]) route('cargo.update', ['id'=>$cargo->id_cargo])
 }}"
    method="post"
    enctype="multipart/form-data" >
    @csrf
    <label for="cargo">Cargo</label>
    <input type="text" name="cargo" id="cargo"
    value="{{
        $cargo && $cargo->cargo != '' ?
        $cargo->cargo : old(cargo)
       }}" >
       <input type="submit" value="Atualizar">
       <select class="form-select" name="id_produto" id="id_produto" ></select>
</form>

@endsection
@section('scripts')

@endsection
