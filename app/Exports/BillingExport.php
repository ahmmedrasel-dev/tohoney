<?php

namespace App\Exports;

use App\Models\Billing;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class BillingExport implements FromCollection, WithHeadings
class BillingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;
    function __construct($startDate, $endDate)
    {
        $this->start = $startDate;
        $this->end = $endDate;
    }

    public function view(): View
    {
        return view('exports.billings', [
            'billings' => Billing::whereBetween('created_at',[$this->start,  $this->end] )->get()
        ]);
    }


    // public function collection()
    // {
    //     return Billing::whereBetween('created_at',[$this->start,  $this->end] )->get(['id', 'userId', 'fullName', 'companyName', 'phone', 'email', 'address', 'postCode', 'paymentMethod', 'created_at', 'updated_at']);
    // }

    // public function headings(): array
    // {
    //     return [
    //         'id',
    //         'userId',
    //         'fullName',
    //         'companyName',
    //         'phone',
    //         'email',
    //         'address',
    //         'postCode',
    //         'paymentMethod',
    //         'created_at',
    //         'updated_at'
    //     ];
    // }

}
