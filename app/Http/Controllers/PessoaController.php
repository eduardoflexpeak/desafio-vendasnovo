<?php

namespace App\Http\Controllers;

use App\DataTables\PessoaDataTable;
use App\Http\Requests\PessoaRequest;
use App\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index(PessoaDataTable $pessoaDatatable)
    {
        return $pessoaDatatable->render('pessoa.index');
    }

    public function create()
    {
        $grupos = Pessoa::GRUPOS;

        return view('pessoa.form', compact('grupos'));
    }

    public function store(PessoaRequest $request)
    {
        try {
            Pessoa::create($request->all());
            flash('Salvo com sucesso')->success();
            return redirect()->route('pessoa.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao salvar')->error();
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            return view('pessoa.form', [
                'pessoa' => Pessoa::findOrFail($id),
                'grupos' => Pessoa::GRUPOS
            ]);
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return redirect()->route('pessoa.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            Pessoa::find($id)->update($request->all());
            flash('Atualizado com sucesso')->success();
            return redirect()->route('pessoa.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao atualizar')->error();
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Pessoa::find($id)->delete();
        } catch (\Throwable $th) {
            abort(403, 'Erro ao excluir');
        }
    }

    public function listaClientes(Request $request)
    {
        $termoPesquisa = trim($request->searchTerm);

        if (empty($termoPesquisa)) {
            return Pessoa::select('id', 'nome as text')
                            ->where('grupo', Pessoa::CLIENTE)
                            ->limit(10)
                            ->get();
        }

        return Pessoa::select('id', 'nome as text')
                        ->where('grupo', Pessoa::CLIENTE)
                        ->where('nome', 'like', '%' . $termoPesquisa . '%')
                        ->limit(10)
                        ->get();
    }
}
