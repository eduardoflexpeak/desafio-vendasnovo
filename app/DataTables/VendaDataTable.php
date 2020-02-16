<?php

namespace App\DataTables;

use App\Pessoa;
use App\Venda;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class VendaDataTable extends DataTable
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
            ->addColumn('action', function ($venda) {
                return link_to( route('venda.show', $venda), 'Ver', ['class' => 'btn btn-sm btn-primary']);
            })
            ->editColumn('pessoa_id', function ($venda) {
                return $venda->pessoa->nome;
            })
            ->editColumn('created_at', function ($venda) {
                return $venda->created_at->format('d/m/Y');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Venda $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Venda $model)
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
                    ->setTableId('venda-table')
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
            Column::make('pessoa_id')->title('Cliente'),
            Column::make('desconto')->title('Desconto'),
            Column::make('acrescimo')->title('Acréscimo'),
            Column::make('total')->title('Total'),
            Column::make('created_at')->title('Data da Venda')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Venda_' . date('YmdHis');
    }
}
