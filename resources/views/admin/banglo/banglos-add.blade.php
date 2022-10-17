<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/banglos')}}">Banglos</a></li>
                                            <li class="breadcrumb-item active">Add banglo</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add banglo</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/banglos/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label ">banglo title</label>
                                                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" placeholder="banglo title" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="sub_title" class="form-label">Sub Title</label>
                                                    <input type="text" name="sub_title"  value="{{old('sub_title')}}" id="sub_title" class="form-control  @error('sub_title') is-invalid @enderror" placeholder="Sub title">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="total_room" class="form-label">Total Room</label>
                                                    <input type="number" min="0" step="1" name="total_room"  value="{{old('total_room')}}" id="banglo_fee" class="form-control  @error('total_room') is-invalid @enderror" placeholder="Total  Room" require>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" name="address"  value="{{old('address')}}" id="address" class="form-control  @error('address') is-invalid @enderror" placeholder="Address">
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" name="phone"  value="{{old('phone')}}" id="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="Phone">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email"  value="{{old('email')}}" id="phone" class="form-control  @error('email') is-invalid @enderror" placeholder="Email">
                                                </div>
                                            </div>
                                            
        <link href="{{ asset('my-assets/admin/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
      
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">banglo Description</label>
                                                    <textarea name="description"  class="form-control  @error('description') is-invalid @enderror" id="editor1" rows="2" placeholder="banglo Description">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">banglo Image<small>(630px X 630px)</small></label>
                                                    <input type="file" name="image" id="image" class="form-control" placeholder="banglo Image" required>
                                                </div>
                                            </div>
                             
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                        <!-- end row -->

                     <x-admin-footer/>