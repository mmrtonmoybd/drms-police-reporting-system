<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/gallerys')}}">Galleries</a></li>
                                            <li class="breadcrumb-item active">Add gallery</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add gallery</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/gallerys/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label ">Gallery title</label>
                                                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" placeholder="Gallery title" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="sub_title" class="form-label">Sub Title</label>
                                                    <input type="text" name="sub_title"  value="{{old('sub_title')}}" id="sub_title" class="form-control  @error('sub_title') is-invalid @enderror" placeholder="Sub title" required>
                                                </div>
                                            </div>
                                            
      
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">gallery Description</label>
                                                    <textarea name="description"  class="form-control  @error('description') is-invalid @enderror" id="address" rows="2" placeholder="gallery Description">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Gallery Image</label>
                                                    <input type="file" name="image" id="image" class="form-control" placeholder="gallery Image" required>
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