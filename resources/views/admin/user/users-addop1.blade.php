<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                                            <li class="breadcrumb-item active">Add SP-Operator 1 user</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add SP-Operator 1 User</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/users/add/sp/op1')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="user_name" class="form-label ">User name</label>
                                                    <input type="text" name="name" id="user_name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" required >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">User email</label>
                                                    <input type="email" name="email"  value="{{old('email')}}" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" required>
                                                </div>
                                            </div>
                                            

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select"  v-model="district_id" @change="getUpozillasAndThana()"  required>
                                                        <option value="">Select</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password"  value="{{old('password')}}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="confirm-password" class="form-label">Confirm password</label>
                                                    <input type="password" name="confirm-password"  value="{{old('confirm-password')}}" id="confirm-password" class="form-control  @error('password') is-invalid @enderror" placeholder="Confirm Password" required>
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