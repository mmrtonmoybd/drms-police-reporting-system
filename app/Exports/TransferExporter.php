<?php

namespace App\Exports;

use App\Models\Transfer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Session;
use Carbon\Carbon;

class TransferExporter implements FromCollection, WithMapping, WithHeadings
{
    protected $request;
    public function __construct($request){
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $session_user = $this->request->session()->get('user');
        if($session_user['type']=='Admin'){
            return $data['transfers'] = Transfer::orderBy('id', 'DESC')->with(['employee', 'from', 'to', 'creator', 'accept', 'admin'])->paginate(10);
        }else{
            return $data['transfers'] = Transfer::orderBy('id', 'DESC')->where('creatorID', $session_user['id'])->orWhere('fromID', $session_user['officeID'])->orWhere('toID', $session_user['officeID'])->with(['employee', 'from', 'to', 'creator', 'accept', 'admin'])->paginate(10);
        }
        
    }


    public function map($transfer) : array {

        $name=null;
        $date=Carbon::parse($transfer->created_at)->toFormattedDateString();
        $from=null;
        $to=null;
        $accept_by=null;
        $central_auth=null;
        if(isset($transfer->employee->name)){$name = $transfer->employee->name;}
        if(isset($transfer->from->name)) {$from = $transfer->from->name;}
        if(isset($transfer->to->name)) {$to = $transfer->to->name;}
        if(isset($transfer->accept->name)) {$accept_by = $transfer->accept->name;}
        if(isset($transfer->admin->name)) {$central_auth = $transfer->admin->name;}

        return [

            $name,
            $date,
            $from,
            $to,
            $accept_by,
            $central_auth,
            

        ] ;

 

 

    }

 

    public function headings() : array {

        return [

           'Name',
           'Date',
           'From',
           'To',
           'Accepted By',
           'Central Auth',
           

        ] ;

    }
}
