<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TradeRequest;
use App\Models\TranReq;
class StatusChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To change the request status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $requests = TradeRequest::where('request_status', 'Requested')->get();
        foreach($requests as $request)
        {
            $request->request_status = "Pre-Approval";
            $request->save();
        }
        $tran_requests = TranReq::where('request_status', 'Requested')->get();
        foreach($tran_requests as $tran_request)
        {
            $tran_request->request_status = "Pre-Approval";
            $tran_request->save();
        }
    }
}
