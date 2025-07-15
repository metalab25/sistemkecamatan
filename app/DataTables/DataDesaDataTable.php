<?php

namespace App\DataTables;

use App\Models\DataDesa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataDesaDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('kode_desa', function ($row) {
                return $row->kode_provinsi . '.' . $row->kode_kabupaten . '.' . $row->kode_kecamatan . '.' . $row->kode_desa;
            })
            ->addColumn('total_wilayah', function ($row) {
                return $row->count_data_desa ? number_format($row->count_data_desa->total_wilayah, 0, ',', '.') : '0';
            })
            ->addColumn('total_keluarga', function ($row) {
                return $row->count_data_desa ? number_format($row->count_data_desa->total_keluarga, 0, ',', '.') : '0';
            })
            ->addColumn('total_penduduk', function ($row) {
                return $row->count_data_desa ? number_format($row->count_data_desa->total_penduduk, 0, ',', '.') : '0';
            })
            ->addColumn('total_penduduk_lk', function ($row) {
                return $row->count_data_desa ? number_format($row->count_data_desa->total_penduduk_lk, 0, ',', '.') : '0';
            })
            ->addColumn('total_penduduk_pr', function ($row) {
                return $row->count_data_desa ? number_format($row->count_data_desa->total_penduduk_pr, 0, ',', '.') : '0';
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->translatedFormat('d F Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('desa.show', $row->id) . '" class="btn btn-info btn-sm me-1 action"><i class="bi bi-list text-white"></i></a>';
            })
            ->setRowId('id');
    }

    public function query(DataDesa $model): QueryBuilder
    {
        return $model->newQuery()->with('count_data_desa')->orderBy('nama_desa');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->addTableClass('table table-bordered table-striped mb-0')
            ->setTableId('datadesa-table')
            ->columns($this->getColumns())
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
            ->orderBy(2)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->addClass('text-center align-middle')->width(1),
            Column::computed('action')->title('Aksi')->exportable(true)->printable(true)->width(60)->addClass('text-center align-middle'),
            Column::make('nama_desa')->title('Desa')->addClass('align-middle'),
            Column::make('kode_desa')->title('Kode Desa')->addClass('text-center align-middle'),
            Column::computed('total_wilayah')->title('Dusun')->addClass('text-center align-middle'),
            Column::computed('total_keluarga')->title('Keluarga')->addClass('text-center align-middle'),
            Column::computed('total_penduduk')->title('Penduduk')->addClass('text-center align-middle'),
            Column::computed('total_penduduk_lk')->title('Laki-Laki')->addClass('text-center align-middle'),
            Column::computed('total_penduduk_pr')->title('Perempuan')->addClass('text-center align-middle'),
            Column::make('updated_at')->title('Diperbaharui')->addClass('text-center align-middle'),
        ];
    }

    protected function filename(): string
    {
        return 'DataDesa_' . date('YmdHis');
    }
}
