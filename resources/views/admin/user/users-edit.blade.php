<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                                            <li class="breadcrumb-item active">Edit user</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit User</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/users/edit/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="user_name" class="form-label ">User name</label>
                                                    <input type="text" name="name" id="user_name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="user_phone" class="form-label">User phone</label>
                                                    <input type="text" name="phone"  value="{{$user->phone}}" id="user_phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="User phone" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">User email</label>
                                                    <input type="email" name="email"  value="{{$user->email}}" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select name="type" class="form-select " id="type" required>
                                                        <option value="Admin" @if($user->type=='Admin') selected @endif>Admin</option>
                                                        <option value="Accountant" @if($user->type=='Accountant') selected @endif>Accountant</option>
                                                        <option value="Customer" @if($user->type=='Customer') selected @endif>Customer</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea name="address"  class="form-control  @error('address') is-invalid @enderror" id="address" rows="2" placeholder="Type Address">{{$user->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="designation" class="form-label">Designation</label>
                                                    <input type="text"  value="{{$user->designation}}" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" placeholder="Desitnation">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="picture" class="form-label">Profile picture <small>(300px X 300px)</small></label>
                                                    <input type="file" name="picture" id="picture" class="form-control" placeholder="Profile picture">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password"  value="{{old('password')}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="confirm-password" class="form-label">Confirm password</label>
                                                    <input type="password" name="confirm-password"  value="{{old('confirm-password')}}" id="confirm-password" class="form-control  @error('password') is-invalid @enderror" placeholder="Confirm Password" >
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