<?php

namespace TeachersAsTutors\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;
use TeachersAsTutors\User;

class Invoice extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:email {date? : Invoice date e.g. 201510}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the monthly invoice emails.';

    protected $mailer;

    /**
     * Create a new command instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        parent::__construct();

        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now()->addMonths(-1);

        if ($this->argument('date')) {
            $date = Carbon::createFromFormat('Ym', $this->argument('date'));
        }

        $parents = User::query()->where('permission_id', 3)->get();

        foreach ($parents as $parent) {
            $invoice = new \TeachersAsTutors\Services\Invoice($date, $parent->getKey());

            $data = $invoice->generate();

            if ($data['total']) {
                $invoice->save();

                $this->mailer->send('emails.invoice', ['parent' => $parent], function ($message) use ($invoice, $parent, $date) {
                    $message->to($parent->email)->subject('Invoice for ' . $date->format('F Y'))->attach(storage_path('app/invoices/' . $invoice->getInvoiceFilename()));
                });
            }
        }
    }
}
