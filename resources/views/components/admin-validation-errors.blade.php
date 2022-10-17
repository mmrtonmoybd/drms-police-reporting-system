@if(Session::has('error_msg'))
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Error - </strong> {{ Session::get('error_msg') }}
        </div>
    </div>
</div>
@endif

@if(Session::has('success_msg'))
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success - </strong> {{ Session::get('success_msg') }}
        </div>
    </div>
</div>
@endif

@if($errors->all())

<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h5>Validation Errors</h5> 
            <div class="card  text-dark bg-white">
                <div class="card-body">
                    <ol style="margin:0;padding:0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            
            </div>
        </div>
    </div>
</div>

@endif


<div class="row">
    <div class="col-sm-12" id="message_section">
        
    </div>
</div>
