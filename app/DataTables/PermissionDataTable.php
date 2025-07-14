<?php

namespace App\DataTables;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('permission update')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-jenis="edit" class="btn btn-warning btn-sm me-1 action"><i class="bi bi-pencil text-white"></i></button>';
                }
                if (Gate::allows('permission delete')) {
                    $action .= '<button type="button" data-id=' . $row->id . ' data-jenis="delete"  class="btn btn-danger btn-sm action"><i class="bi bi-trash"></i></button>';
                }

                return $action;
            })
            ->setRowId('id');
    }

    public function query(Permission $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('name', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->addTableClass('table table-bordered table-striped mb-0')
            ->setTableId('permission-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->language([
                'search' => '_INPUT_',
                'searchPlaceholder' => 'Cari permission...',
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->addClass('text-center')->width(1),
            Column::make('name'),
            Column::make('guard_name')->title('Guard')->width(80)->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Permission_' . date('YmdHis');
    }
}
