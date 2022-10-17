<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/rooms')}}">Rooms</a></li>
                                            <li class="breadcrumb-item active">Add room</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add room</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/rooms/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label ">Room title</label>
                                                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" placeholder="Room title" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="rent" class="form-label">Rent</label>
                                                    <input type="number" min="0" name="rent"  value="{{old('rent')}}" id="rent" class="form-control  @error('rent') is-invalid @enderror" placeholder="Rent" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="max_adult" class="form-label">Max Adult</label>
                                                    <input type="number" min="1" name="max_adult"  value="{{old('max_adult')}}" id="max_adult" class="form-control  @error('max_adult') is-invalid @enderror" placeholder="Max Adult" required>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="max_children" class="form-label">Max Children</label>
                                                    <input type="number" min="0" value="0" name="max_children"  value="{{old('max_children')}}" id="max_children" class="form-control  @error('max_children') is-invalid @enderror" placeholder="Max Children" required>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="bed_count" class="form-label">Total Bed</label>
                                                    <input type="number" min="1" name="bed_count"  value="{{old('bed_count')}}" id="bed_count" class="form-control  @error('bed_count') is-invalid @enderror" placeholder="Total Bed" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Category</label>
                                                    <select name="category" id="category" class="form-select" required>
                                                        <option value="">Select Category </option>
                                                        @if($categories)
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}" @if(old("category") == $category->id)selected @endif >{{$category->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="banglo_id" class="form-label">Banglo</label>
                                                    <select name="banglo_id" id="banglo_id" class="form-select" required>
                                                        <option value="">Select Banglo </option>
                                                        @if($banglos)
                                                            @foreach($banglos as $banglo)
                                                                <option value="{{$banglo->id}}" @if(old("banglo_id") == $banglo->id)selected @endif >{{$banglo->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            
      
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Room Description</label>
                                                    <textarea name="description"  class="form-control  @error('description') is-invalid @enderror" id="address" rows="2" placeholder="Room Description">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="big_picture" class="form-label">Room Image</label>
                                                    <input type="file" name="big_picture" id="big_picture" class="form-control" placeholder="Room Image" required>
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