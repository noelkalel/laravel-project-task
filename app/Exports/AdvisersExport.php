<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Adviser;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdvisersExport implements FromCollection, WithMapping, WithHeadings, WithEvents, ShouldAutoSize, WithTitle
{
    use Exportable;

    public $count = 1;

    public function collection()
    {
        $cashLoanProducts = auth()->user()->cashLoans;
        $homeLoanProducts = auth()->user()->homeLoans;

        $products = $cashLoanProducts->merge($homeLoanProducts);

        return $products->sortByDesc('created_at');
    }

    public function map($user): array
    {
        return [
            $this->count++,
            $user->loan_amount ? 'home loan' : 'cash loan',
            $user->loan_amount ? $user->loan_amount : $user->property_value . '-' . $user->down_payment_amount,
            Carbon::parse($user->created_at)->format('d-m-Y H:i:s')
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Product Type',
            'Product Value',
            'Creation date',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }

    public function title(): string
    {
        return env('APP_NAME') . ' - Products';
    }
}
