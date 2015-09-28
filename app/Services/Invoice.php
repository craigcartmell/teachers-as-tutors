<?php

namespace TeachersAsTutors\Services;

use Carbon\Carbon;
use TeachersAsTutors\Lesson;

class Invoice
{

    protected $invoiceDate;
    protected $tutorID;
    protected $parentID;

    public function __construct(Carbon $invoiceDate, $tutorID = 0, $parentID = 0)
    {
        $this->invoiceDate = $invoiceDate->firstOfMonth();
        $this->tutorID     = $tutorID;
        $this->parentID    = $parentID;

        if (empty($this->tutorID) && empty($this->parentID)) {
            throw new \Exception('No parent or tutor provided.');
        }

        return $this;
    }

    public function generate()
    {
        $lessons = Lesson::query()->where('tutor_id', $this->tutorID)->orWhere('parent_id', $this->parentID)->whereRaw($this->invoiceDate->format('Y-m') . " = DATE_FORMAT(started_at, '%Y-%m')")->get();

        $total = collect($lessons)->sum('cost');

        $invoice = view('calendar.invoice', ['invoice_date' => $this->invoiceDate, 'lessons' => $lessons, 'total' => $total]);

        return $invoice;
    }

}