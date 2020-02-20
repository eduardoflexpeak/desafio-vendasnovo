<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function index(VendaDataTable $vendaDatatable)
    {
        return $vendaDatatable->render('venda.index');
    }

    public function create()
    {
        $formas_pagamento = Venda::FORMAS_PAGAMENTO;

        return view('venda.form', [
            'formas_pagamento' => $formas_pagamento
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $venda = Venda::create([
                'pessoa_id' => $request->pessoa_id,
                'observacao' => $request->observacao,
                'desconto' => 0,
                'acrescimo' => 0,
                'total' => 0,
            ]);

            $totalGeral = 0;

            foreach ( $request->produto_id as $indice => $valor ) {
                $produto = Produto::findOrFail($valor);
                $quantidade = $request->quantidade[$indice];

                $totalItem = $produto->preco_venda * $quantidade;
                $totalGeral += $totalItem;

                $venda->itensVenda()->create([
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                    'valor_unitario' => $produto->preco_venda,
                    'valor_total' => $totalItem
                ]);
            }

            $venda->update(['total' => $totalGeral]);

            DB::commit();
            flash('Venda finalizada com sucesso')->success();
            return redirect()->route('venda.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            flash('Ops! Ocorreu um erro ao salvar a venda')->error();
            return back()->withInput();
        }
    }

    public function show($id)
    {
        try {
            $venda = Venda::find($id);
            return view('venda.show', compact('venda'));
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao exibir a venda')->error();
            return back()->withInput();
        }
    }

    public function edit(Venda $venda)
    {
        //
    }

    public function update(Request $request, Venda $venda)
    {
        //
    }

    public function destroy(Venda $venda)
    {
        //
    }
}
