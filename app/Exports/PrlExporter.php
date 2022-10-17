<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Session;
use Carbon\Carbon;

class PrlExporter implements FromCollection, WithMapping, WithHeadings
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
        $query = Employee::query();
        $query->orderBy('id', 'DESC');
        $query->with(['office', 'position']);

        //if search anything add some extra query for search
        if( $name = $this->request->get('name'))
            $query->where('name','LIKE','%'.$name.'%');
        if( $phone = $this->request->get('phone'))
            $query->where('phone','LIKE','%'.$phone.'%');
        if( $officeID = $this->request->get('officeID'))
            $query->where('officeID', $officeID);
        if( $positionID = $this->request->get('positionID'))
            $query->where('positionID', $positionID);

        $session_user = $request->session()->get('user');
        if($session_user['type']=='Officer')
            $query->where('officeID', $session_user['officeID']);
        if($session_user['type']=='DivisionAdmin'){
            $current_user = User::where('id', $session_user['id'])->first();
            $query->where('divisionID', $current_user->divisionID);
        }

        $data['employees'] = $query->get();

        

        return $data['employees'];
    }


    public function map($employee) : array {

        $office_name=null;
        $position_name=null;

        if(isset($employee->office->name))
            $office_name=$employee->office->name;
        if(isset($employee->position->name))
            $position_name=$employee->position->name;

        return [

            $employee->name,
            Carbon::parse($employee->prl_date)->toFormattedDateString(),
            Carbon::parse($employee->birthday)->toFormattedDateString(),
            $employee->basic_salary,
            $office_name,
            $position_name

        ] ;


    }

 

    public function headings() : array {

        return [

           'Name',
           'PRL Date',
           'DOB',
           'Basic',
           'Current Office',
           'Current Position',
        ] ;

    }

}
