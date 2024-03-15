<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Models\Role;

class RoleDataTable extends DataTable
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
            ->addColumn('action', function($row) {
                return '<a href="'.route('roles.edit', base64_encode($row->id)).'"> <button class="btn btn-primary" style="background: #0b2e13; border: none"><i class="fa fa-pencil primary"></i></button></a> &nbsp;
                    <form class="inlineblock"  id="olo-'.$row->id.'" action="'. route('roles.destroy', [$row->id]) .'" method="POST">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                           <button type="button" class="btn btn-danger  btn btn-sm" onclick= "confirmDelete(\'method\', \''.$row->id . '\' , \'null\')"  title="Delete">
                                <i class="fa fa-times"></i>
                          </button>
                    </form>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RoleDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
                    ->setTableId('roledatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Role_' . date('YmdHis');
    }
}
