<?php

namespace App\Http\Controllers;

use App\DataTables\ProdutoDataTable;
use App\Fabricante;
use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(ProdutoDataTable $produtoDatatable)
    {
        return $produtoDatatable->render('produto.index');
    }

    public function create()
    {
        $fabricantes = Fabricante::all()->pluck('nome', 'id');
        $unidades_medidas = Produto::UNIDADES_MEDIDAS;

        return view('produto.form', [
            'fabricantes' => $fabricantes,
            'unidades_medidas' => $unidades_medidas
        ]);
    }

    public function store(Request $request)
    {
        try {
            Produto::create($request->all());
            flash('Salvo com sucesso')->success();
            return redirect()->route('produto.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return back()->withInput();
        }
    }

    public function show($id)
    {
        try {
            return Produto::findOrFail($id);
        } catch (\Throwable $th) {
            abort(403, 'Erro ao selecionar o produto');
        }
    }

    public function edit($id)
    {
        try {
            $fabricantes = Fabricante::all()->pluck('nome', 'id');
            $unidades_medidas = Produto::UNIDADES_MEDIDAS;

            return view('produto.form', [
                'produto' => Produto::findOrFail($id),
                'fabricantes' => $fabricantes,
                'unidades_medidas' => $unidades_medidas
            ]);
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return redirect()->route('produto.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            Produto::find($id)->update($request->all());
            flash('Atualizado com sucesso')->success();
            return redirect()->route('produto.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao atualizar')->error();
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Produto::find($id)->delete();
        } catch (\Throwable $th) {
            abort(403, 'Erro ao excluir');
        }
    }

    public function listaProdutos(Request $request)
    {
        $termoPesquisa = trim($request->searchTerm);

        if (empty($termoPesquisa)) {
            return Produto::select('id', 'descricao as text')
                            ->limit(10)
                            ->get();
        }

        return Produto::select('id', 'descricao as text')
                        ->where('descricao', 'like', '%' . $termoPesquisa . '%')
                        ->limit(10)
                        ->get();
    }
}
