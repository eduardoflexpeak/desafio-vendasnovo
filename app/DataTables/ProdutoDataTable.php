<?php

namespace App\DataTables;

use App\Fabricante;
use App\Produto;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ProdutoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($produto) {

                $acoes = link_to(
                    route('produto.edit', $produto),
                    'Editar',
                    ['class' => 'btn btn-sm btn-primary']
                );

                $acoes .= FormFacade::button(
                            'Excluir',
                            ['class' =>
                                'btn btn-sm btn-danger',
                                'onclick' => "excluir('" . route('produto.destroy', $produto) . "')"
                            ]
                        );

                return $acoes;

            })
            ->editColumn('fabricante_id', function ($produto) {
                return Fabricante::find($produto->fabricante_id)->nome;
            })
            ->editColumn('unidade_medida', function ($produto) {
                return Produto::UNIDADES_MEDIDAS[$produto->unidade_medida];
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Produto $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Produto $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('produto-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false),
            Column::make('descricao'),
            Column::make('estoque'),
            Column::make('preco_custo'),
            Column::make('preco_venda'),
            Column::make('fabricante_id'),
            Column::make('unidade_medida')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Produto_' . date('YmdHis');
    }
}
