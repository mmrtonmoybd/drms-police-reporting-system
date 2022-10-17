<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/accounts')}}">Accounts Category</a></li>
                                            <li class="breadcrumb-item active">All Accounts Category</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="mdi mdi-calculator-variant-outline"></i> Accounts Category</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        
                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-4">
                            <a href="{{url('admin/accounts')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add account</a>
                            <a href="{{url('admin/accounts/category')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add category</a>
                            <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                @if(!isset($category))
                                <form action="{{url('admin/accounts/category')}}" method="POST">
                                @csrf
                                  
                                    <div class="mb-2">
                                        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" placeholder="Category name">
                                    </div>
                                  
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                    </div>
                                    
                                </form>

                                @else 

                                <form action="{{url('admin/accounts/category/update/'.$category->id)}}" method="post">
                                @csrf
                                    <div class="mb-2">
                                        <input type="text" name="name" value="{{$category->name}}" id="name" class="form-control" placeholder="Category name">
                                    </div>
                                    

                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                    </div>
                                    
                                </form>

                                @endif
                                    </div>
                                </div>
                            </div>





                            <div class="col-sm-8 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                            
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th> Name </th>
                                                    
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($categories)
                                            
                                            @foreach ($categories as $category)
                                                <tr>
                                                   
                                                    <td > {{$category->name}}</td>
                                                    

                                                    <td class="table-action">
                                                            <a href="{{url('admin/accounts/category/edit/'.$category->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="{{url('admin/accounts/category/delete/'.$category->id)}}"  onclick="return confirm('Do you want to delete this account?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                </tr>

                                            @endforeach
                                            @endif
                                        
                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">
                                            @if($categories){{$categories->appends(request()->input())->links()}} @endif
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     <x-admin-footer/>