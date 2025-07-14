<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('last_login_at', function ($row) {
                return Carbon::parse($row->last_login_at)->translatedFormat('d F Y H:i:s');
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat('d F Y H:i:s');
            })
            ->editColumn('email_verified_at', function ($row) {
                if ($row->email_verified_at) {
                    return Carbon::parse($row->email_verified_at)->translatedFormat('d F Y H:i:s');
                } else {
                    return 'Unverified';
                }
            })
            ->editColumn('updated_at', function ($row) {
                if ($row->updated_at == $row->created_at) {
                    return '';
                }

                return Carbon::parse($row->updated_at)->translatedFormat('d F Y H:i:s');
            })
            ->addColumn('roles', function ($row) {
                $roles = $row->getRoleNames();
                $role = '';

                foreach ($roles as $role) {
                }

                return $role;
            })
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('users update')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-jenis="edit" class="btn btn-warning btn-sm me-1 action"><i class="bi bi-pencil text-white"></i></button>';
                }
                if (Gate::allows('users delete')) {
                    $action .= '<button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="bi bi-trash"></i></button>';
                }

                return $action;
            })
            ->rawColumns(['status', 'roles', 'action'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('roles')->orderBy('name', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->addTableClass('table table-bordered table-striped mb-0')
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->responsive(true)
            ->minifiedAjax()
            ->language([
                'search' => '_INPUT_',
                'searchPlaceholder' => 'Cari...',
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
            Column::make('username')->addClass('text-center align-middle'),
            Column::make('email')->addClass('text-center align-middle'),
            Column::computed('roles')->orderable(false)->addClass('text-center align-middle text-capitalize'),
            Column::make('last_login_at')->addClass('text-center align-middle'),
            Column::make('created_at')->title('Registered')->addClass('text-center align-middle'),
            Column::make('updated_at')->addClass('text-center align-middle'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(90)
                ->addClass('text-center align-middle'),
        ];
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
