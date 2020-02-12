<?php

namespace App\DataTables;

use App\Fabricante;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class FabricanteDatatable extends DataTable
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
            ->addColumn('action', function ($fabricante) {

                $acoes = link_to(
                            route('fabricante.edit', $fabricante),
                            'Editar',
                            ['class' => 'btn btn-sm btn-primary']
                        );

                $acoes .= FormFacade::button(
                            'Excluir',
                            ['class' =>
                                'btn btn-sm btn-danger',
                                'onclick' => "excluir('" . route('fabricante.destroy', $fabricante) . "')"
                            ]
                        );

                return $acoes;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\FabricanteDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Fabricante $model)
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
                    ->setTableId('fabricantedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
                    ->title('Ações')
                    ->exportable(false)
                    ->printable(false),
            Column::make('id'),
            Column::make('nome'),
            Column::make('site'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fabricante_' . date('YmdHis');
    }
}
