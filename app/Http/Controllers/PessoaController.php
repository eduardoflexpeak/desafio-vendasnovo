<?php

namespace App\Http\Controllers;

use App\DataTables\PessoaDataTable;
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

    public function store(Request $request)
    {
        try {
            Pessoa::create($request->all());
            flash('Salvo com sucesso')->success();
            return redirect()->route('pessoa.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
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
}
