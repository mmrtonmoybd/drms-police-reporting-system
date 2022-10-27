<x-admin-header />
@php
use App\Models\Warrant;

function dayend($id, $dis) {
    $get = Warrant::selectRaw("((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS day_endp")
    ->where('districtID', $dis)
    ->where('id', '<=', $id)->first();
    return intval($get->day_endp);
}
@endphp
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users/role')}}">Roles</a></li>
                                            <li class="breadcrumb-item active">View role</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="mdi mdi-eye"></i> View role #{{$role->id}}</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td> <b>রেফারেন্স নং : </b> {{$role->id}}</td>
                                                        <td> <b>Role name : </b> {{$role->name}}</td>
                                                        <td> <b>Total permissions : </b> {{$totalper}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> Total users in role : </b> {{$totalu}}</td>
                                                        <td> <b>All permissions : </b> 
                                                    @foreach ($per as $p)
                                                    <button type="button" class="btn btn-primary">{{$p->name}}</button>
                                                    @endforeach
                                                    </td>
                                                    </tr>
                                                </table>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- end row -->

                        

                     <x-admin-footer/>