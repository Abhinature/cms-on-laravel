<?php

namespace App\DataTables;

use App\Models\UnitUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'unit-user.action')
            ->editColumn('status', function($data){
                return ($data->status =='1')?'Active':'In-Active';
            })
            ->editColumn('user_type', function($data){
                return ($data->user_type =='9')?'Super Admin':'Admin';
            })
            ->editColumn('en_unit_name', function($data){
                return ($data->en_unit_name =='')?'Yantra India Limited':$data->en_unit_name;
            })
            ->setRowId('id')
            ->filterColumn('en_unit_name', function($query, $keyword){
                $keywords = trim($keyword);
                $query->whereRaw('units.en_unit_name like ?', ["%{$keywords}%"]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(UnitUser $model): QueryBuilder
    {
            if(Auth::user()->unit_id =='0'){
        return $model->newQuery()->select('unit_users.*', 'units.en_unit_name','units.hi_unit_name')->leftjoin('units', 'unit_users.unit_id', '=', 'units.id');
            }else{
                return $model->newQuery()->select('unit_users.*', 'units.en_unit_name','units.hi_unit_name')->leftjoin('units', 'unit_users.unit_id', '=', 'units.id')->where('unit_users.unit_id',Auth::user()->unit_id);      
            }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('unit-users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('en_unit_name'),
            Column::make('hi_unit_name'),
            Column::make('email'),
            Column::make('user_type'),
            Column::make('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
