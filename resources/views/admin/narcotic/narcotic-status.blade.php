<x-admin-header />

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

  <link rel='stylesheet' href='https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/css/materialize.clockpicker.css'>



<style>

body {
	overflow:auto!important;
}


</style>        

<br>
  <div id="errmsg"></div>
<div id="errdate"></div>

 <!-- start page title -->
 
 
 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/narcotic/review/update/'.$nar->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">

                                        <h1>Narcotic id: {{$nar->id}}</h1>
      
                                            

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">   Review status     </label>
                                                    <select name="statusg" id="statusg" class="form-select form-control" required>
                                                        
                                                        <option value="active"  {{$nar->status=='active' ? 'selected' : ''}}> Approve </option>
                                                        <option value="inactive" {{$nar->status=='inactive' ? 'selected' : ''}}>Pending</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" id="sbbtn" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                        <!-- end row -->
  
                     <x-admin-footer/>


