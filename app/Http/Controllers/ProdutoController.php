<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;

use App\Models\{
    Produto,
    ProdutoTamanho,
    Tamanho,
    TipoProduto
};

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('nome');

        return view('produto.index')
            ->with(compact('produtos'));
    }


    public function create()
    {
        $produto = null;
        $tiposProduto = TipoProduto::class;
        return view('produto.form')
            ->with(compact(
                'produto',
                'tiposProduto'
            ));
    }


    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
        return redirect()
            ->route(
                'produto.show',
                ['id' => $produto->id_produto]
            )
            ->with('success', 'Cadastrado com sucesso.');
    }

    public function show(int $id)
    {
        $produto = Produto::find($id);
        $tamanhos = Tamanho::class;

        return view('produto.show')
            ->with(compact('produto', 'tamanhos'));
    }

    public function edit(int $id)
    {
        $produto = Produto::find($id);
        $tiposProduto = TipoProduto::class;
        return view('produto.form')
            ->with(compact(
                'produto',
                'tiposProduto'
            ));
    }

    public function update(Request $request, int $id)
    {
        $produto = Produto::find($id);
        $produto->update($request->all());
        return redirect()
            ->route(
                'produto.show',
                ['id' => $produto->id_produto]
            )
            ->with('success', 'Atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        Produto::find($id)->delete();
        return redirect()
            ->back()
            ->with('danger', 'Removido com sucesso!');
    }

    /*
    *|--------------------------------------------
    *| Tamanhos de Produtos
    *|--------------------------------------------
    */

    public function createTamanho(int $id_produto)
    {
        $produtoTamanho = null;
        $produto = Produto::find($id_produto);
        $tamanhos = ProdutoTamanho::class;

        return view('produto.formTamanho')
            ->with(compact(
                'produto',
                'tamanhos',
                'produtoTamanho'
            ));
    }

    public function storeTamanho(Request $request, int $id_produto)
    {
        $produtoTamanho = ProdutoTamanho::create([
            'id_produto' => $id_produto,
            'id_tamanho' => $request->id_tamanho,
            'preco'      => $request->preco,
            'observacoes' => $request->observacoes
        ]);

        return redirect()
            ->route('produto.show', ['id' => $id_produto])
            ->with('success', 'Tamanho cadastrado com sucesso.');
    }

    public function editTamanho(int $id)
    {
        $produtoTamanho = ProdutoTamanho::find($id);
        // $produto  = Produto::find($produtoTamanho->id_produto);
        $produto  = $produtoTamanho->produto();
        $tamanhos = ProdutoTamanho::class;

        return view('produto.formTamanho')
            ->with(compact(
                'produto',
                'tamanhos',
                'produtoTamanho'
            ));
    }

    public function updateTamanho(Request $request, int $id)
    {
        $produtoTamanho = ProdutoTamanho::find($id);
        $produtoTamanho->update($request->all());

        return redirect()
            ->route(
                'produto.show',
                ['id' => $produtoTamanho->id_produto]
            )
            ->with('success', 'Atualizado com sucesso');
    }

    public function destroyTamanho(int $id)
    {
        ProdutoTamanho::find($id)->delete();
        return redirect()
            ->back()
            ->with('danger', 'Removido com sucesso!');
    }
}
