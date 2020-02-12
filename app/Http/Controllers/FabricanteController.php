<?php

namespace App\Http\Controllers;

use App\DataTables\FabricanteDatatable;
use App\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    public function index(FabricanteDatatable $fabricanteDatatable)
    {
        return $fabricanteDatatable->render('fabricante.index');
    }

    public function create()
    {
        return view('fabricante.form');
    }

    public function store(Request $request)
    {
        try {
            Fabricante::create($request->all());
            flash('Salvo com sucesso')->success();
            return redirect()->route('fabricante.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            return view('fabricante.form', [
                'fabricante' => Fabricante::findOrFail($id)
            ]);
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return redirect()->route('fabricante.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            Fabricante::find($id)->update($request->all());
            flash('Atualizado com sucesso')->success();
            return redirect()->route('fabricante.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao atualizar')->error();
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Fabricante::find($id)->delete();
        } catch (\Throwable $th) {
            abort(403, 'Erro ao excluir');
        }
    }
}
