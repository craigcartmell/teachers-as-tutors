<?php

namespace TeachersAsTutors\Services;

use Carbon\Carbon;
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
        $lessons = Lesson::query()->where('parent_id', $this->parentID)->whereRaw("'" . $this->invoiceDate->format('Y-m') . "' = DATE_FORMAT(started_at, '%Y-%m')")->orderBy('started_at')->get();
        $total   = collect($lessons)->sum('cost');

        return ['invoice_date' => $this->invoiceDate, 'invoice_no' => $this->getInvoiceNumber(), 'parent' => $this->parent, 'lessons' => $lessons, 'total' => $total];
    }

    public function save()
    {
        $dompdf = new \DOMPDF();
        $dompdf->load_html(view('invoice.pdf', $this->generate())->render());
        $dompdf->set_paper('a4', 'portrait');
        $dompdf->render();
        $dompdf->stream($this->getInvoiceNumber() . '.pdf');
    }
}