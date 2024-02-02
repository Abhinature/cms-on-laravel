<?php

namespace App\DataTables;

use App\Models\{Translation, WebsiteTranslation, Language};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TranslationsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $languages = Language::all();
        $dataTable = (new EloquentDataTable($query))->setRowId('id');
        
        foreach ($languages as $language){
            $dataTable->editColumn($language->title, function($data) use($language) {
                return isset($data->gettranslation($language->slug)->name)?$data->gettranslation($language->slug)->name:"";
            });
        };

        return $dataTable->addColumn('action', 'translation.action');
            
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WebsiteTranslation $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('translations-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $languages = Language::all();
        $arr= array(
            'action',
            'slug' => ['name'=>'slug', 'data'=>'slug'],
            'english'=>['name'=>'name','data'=>'name'],
        );
        foreach ($languages as $language){
            if($language->title!='English')
                $arr[$language->title]=['name'=>$language->title, 'searchable' => false,];
        }
        return $arr;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Translations_' . date('YmdHis');
    }
}
