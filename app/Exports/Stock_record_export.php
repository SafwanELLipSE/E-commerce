<?php

namespace App\Exports;

use App\Models\Stock_record;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class Stock_record_export implements ShouldAutoSize, FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return Stock_record::where('stock_id', $this->id)->select(['stock_id', 'current_stock', 'stock_in', 'stock_out', 'restock', 'status', 'created_by', 'created_at', 'updated_at'])->get();
    }
    public function headings(): array
    {
        return [
            'Product Name',
            'Current Stock',
            'Stock In',
            'Stock Out',
            'Re-Stock',
            'Status',
            'Created By',
            'Created At',
            'Updated At'
        ];
    }
    public function map($stock_record): array
    {
        return [
            $stock_record->stock->product->name,
            $stock_record->current_stock,
            $stock_record->stock_in,
            $stock_record->stock_out,
            $stock_record->restock,
            $stock_record->status,
            Auth::user($stock_record->created_by)->name,
            Date::dateTimeToExcel($stock_record->created_at),
            Date::dateTimeToExcel($stock_record->updated_at),
        ];
    }
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
