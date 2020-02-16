<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index(VendaDataTable $vendaDatatable)
    {
        return $vendaDatatable->render('venda.index');
    }

    public function create()
    {
        return view('venda.form');
    }

    public function store(Request $request)
    {
        dd($request->all());
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
