<?php

namespace App\DataTables;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('type', function ($row) {
                return $row->type == 1 ? 'Main Menu' : 'Sub Menu';
            })
            ->editColumn('status', function ($row) {
                return $row->status == 1 ? 'Active' : 'Inactive';
            })
            ->editColumn('parent', function ($row) {
                return $row->MainMenus ? $row->MainMenus->name : '-';
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat('d F Y H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->translatedFormat('d F Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('menus update')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-jenis="edit" class="btn btn-warning btn-sm me-1 action"><i class="bi bi-pencil text-white"></i></button>';
                }
                if (Gate::allows('menus update')) {
                    $action .= '<button type="button" data-id="' . $row->id . '" data-jenis="move-up" class="btn btn-sm btn-dark me-1 action" title="Move Up"><i class="bi bi-arrow-up"></i></button>';
                }
                if (Gate::allows('menus update')) {
                    $action .= '<button type="button" data-id="' . $row->id . '" data-jenis="move-down" class="btn btn-sm btn-secondary me-1 action" title="Move Down"><i class="bi bi-arrow-down"></i></button>';
                }
                if (Gate::allows('menus status')) {
                    if ($row->status === 0) {
                        $action .= '<button type="button" data-id=' . $row->id . ' data-jenis="status" class="btn btn-secondary btn-sm me-1 action"><i class="bi bi-toggle-off text-white"></i></button>';
                    } elseif ($row->status === 1) {
                        $action .= '<button type="button" data-id=' . $row->id . ' data-jenis="status" class="btn btn-info btn-sm me-1 action"><i class="bi bi-toggle-on text-white"></i></button>';
                    }
                }
                if (Gate::allows('menus delete')) {
                    $action .= '<button type="button" data-id=' . $row->id . ' data-jenis="delete"  class="btn btn-danger btn-sm action"><i class="bi bi-trash"></i></button>';
                }

                return $action;
            })
            ->setRowId('id');
    }

    public function query(Menu $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('SubMenus')
            ->orderBy('parent')
            ->orderBy('type')
            ->orderBy('sort', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->addTableClass('table table-bordered table-striped mb-0')
            ->setTableId('menu-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->language([
                'search' => '_INPUT_',
                'searchPlaceholder' => 'Cari menu...',
                'lengthMenu' => '_MENU_ Data Per Halaman',
                'info' => 'Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Data',
                'infoEmpty' => 'Menampilkan 0 Sampai 0 Dari 0 Data',
                'infoFiltered' => '(Disaring Dari _MAX_ total Data)',
                'emptyTable' => 'Tidak Ada Data Yang Tersedia',
            ])
            ->orderBy(1)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->addClass('text-center align-middle')->width(1),
            Column::make('name')->addClass('align-middle'),
            Column::make('url')->addClass('align-middle'),
            Column::make('type')->addClass('text-center align-middle'),
            Column::make('parent')->addClass('text-center align-middle'),
            Column::make('status')->addClass('text-center align-middle'),
            Column::make('created_at')->addClass('text-center align-middle'),
            Column::make('updated_at')->addClass('text-center align-middle'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(220)
                ->addClass('text-center align-middle'),
        ];
    }

    protected function filename(): string
    {
        return 'Menu_' . date('YmdHis');
    }
}
