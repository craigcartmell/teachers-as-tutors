<?php

namespace TeachersAsTutors\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use TeachersAsTutors\Lesson;
use TeachersAsTutors\User;

class Invoice
{

    protected $invoiceDate;
    protected $parentID;
    protected $parent;

    protected function getInvoiceNumber()
    {
        return $this->invoiceDate->format('Ym') . $this->parentID;
    }

    public function __construct(Carbon $invoiceDate, $parentID)
    {
        $this->invoiceDate = $invoiceDate->firstOfMonth();
        $this->parentID    = $parentID;
        $this->parent      = User::query()->find($this->parentID);

        if (empty($this->parent) || ! $this->parent->is_parent) {
            throw new \Exception('Please select a valid parent to invoice.');
        }

        return $this;
    }

    public function generate()
    {
        $lessons        = Lesson::query()->where('parent_id', $this->parentID)->whereRaw("'" . $this->invoiceDate->format('Y-m') . "' = DATE_FORMAT(started_at, '%Y-%m')")->orderBy('started_at')->get();
        $sub_total      = collect($lessons)->sum('cost');
        $is_vat_charged = env('INVOICE_VAT_CHARGED', false);
        $vat_perc       = env('INVOICE_VAT_PERCENTAGE', 20);

        $total = $sub_total;
        $vat   = 0;
        if ($is_vat_charged) {
            $vat   = $sub_total * ($vat_perc / 100);
            $total = $sub_total + $vat;
        }

        return [
            'invoice_date'   => $this->invoiceDate,
            'invoice_no'     => $this->getInvoiceNumber(),
            'parent'         => $this->parent,
            'lessons'        => $lessons,
            'sub_total'      => $sub_total,
            'total'          => $total,
            'company_no'     => env('INVOICE_COMPANY_NO'),
            'vat_no'         => env('INVOICE_VAT_NO'),
            'is_vat_charged' => $is_vat_charged,
            'vat_perc'       => $vat_perc,
            'vat'            => $vat,
        ];
    }

    public function save()
    {
        $dompdf = new \DOMPDF();
        $dompdf->load_html(view('invoice.pdf', $this->generate())->render());
        $dompdf->set_paper('a4', 'portrait');
        $dompdf->render();

        Storage::makeDirectory('invoices');

        return Storage::put($this->getInvoiceFilepath(), $dompdf->output());
    }

    public function getInvoiceFilepath()
    {
        return 'invoices/' . $this->getInvoiceFilename();
    }

    public function getInvoiceFilename()
    {
        return 'teachers_as_tutors_invoice_' . $this->getInvoiceNumber() . '.pdf';
    }

}