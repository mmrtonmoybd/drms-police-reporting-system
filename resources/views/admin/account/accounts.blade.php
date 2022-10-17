<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/accounts')}}">Accounts</a></li>
                                            <li class="breadcrumb-item active">All Accounts</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="mdi mdi-calculator-variant-outline"></i> Accounts</h4>
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
                                        
                                @if(!isset($account))
                                <form action="{{url('admin/accounts')}}" method="POST">
                                @csrf
                                    <div class="mb-2">
                                        <input type="text" name="created_at" value="{{date('d/m/Y', time())}}" id="created_at"  data-date-format="dd/mm/yyyy" class="form-control datepicker" placeholder="Date" required>
                                    </div>
                                        
                                    <div class="mb-2">
                                        <select name="cat_id" id="cat_id"  class="form-select " required>
                                            <option value="">Select category</option>
                                            @if($categories)@foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                    
                                        
                                    <div class="mb-2">
                                        <select name="payment_method" id="payment_method"  class="form-select " required>
                                            <option value="">Select payment methods</option>
                                            @if($payment_methods)@foreach($payment_methods as $methods)
                                            <option value="{{$methods->method_name}}">{{$methods->method_name}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                        
                                    <div class="mb-2">
                                        <select name="type" id="type"  class="form-select " required>
                                            <option value="">Select Type</option>
                                           <option value="credit">Income</option>
                                           <option value="debit">Expense</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="mb-2">
                                        <input type="text" name="voucher" value="{{old('voucher')}}" id="voucher" class="form-control" placeholder="Voucher">
                                    </div>
                                    
                                    <div class="mb-2">
                                        <textarea type="text" name="comment" id="comment" class="form-control" placeholder="Comment">{{old('comment')}}</textarea>
                                    </div>

                                    <div class="input-group flex-nowrap mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-calculator-variant-outline"></i></span>
                                        <input name="amount" type="number" min="0" step="0.01" class="form-control" placeholder="Amount" aria-label="Amount" aria-describedby="basic-addon1" required>
                                    </div>

                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                    </div>
                                    
                                </form>

                                @else 

                                <form action="{{url('admin/accounts/update/'.$account->id)}}" method="post">
                                @csrf
                                    <div class="mb-2">
                                        <input type="text" name="created_at" value="{{date('d/m/Y', strtotime($account->created_at))}}" id="created_at"  data-date-format="dd/mm/yyyy" class="form-control datepicker" placeholder="Date" required>
                                    </div>
                                        
                                    <div class="mb-2">
                                        <select name="cat_id" id="cat_id"  class="form-select " required>
                                            <option value="">Select category</option>
                                            @if($categories)@foreach($categories as $category)
                                            <option value="{{$category->id}}"  @if($account->cat_id==$category->id) selected @endif   >{{$category->name}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                    
                                        
                                    <div class="mb-2">
                                        <select name="payment_method" id="payment_method"  class="form-select " required>
                                            <option value="">Select payment methods</option>
                                            @if($payment_methods)@foreach($payment_methods as $method)
                                            <option value="{{$method->method_name}}" @if($account->payment_method==$method->method_name) selected @endif >{{$method->method_name}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                        
                                    <div class="mb-2">
                                        <select name="type" id="type"  class="form-select " required>
                                            <option value="">Select Type</option>
                                           <option value="credit" @if($account->type=='credit') selected @endif >Income</option>
                                           <option value="debit" @if($account->type=='debit') selected @endif >Expense</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="mb-2">
                                        <input type="text" name="voucher"  value="{{$account->voucher}}" id="voucher" class="form-control" placeholder="Voucher">
                                    </div>
                                    
                                    <div class="mb-2">
                                        <textarea type="text" name="comment" id="comment" class="form-control" placeholder="Comment">{{$account->comment}}</textarea>
                                    </div>

                                    <div class="input-group flex-nowrap mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-calculator-variant-outline"></i></span>
                                        <input name="amount" value="{{$account->amount}}" type="number" min="0" step="0.01" class="form-control" placeholder="Amount" aria-label="Amount" aria-describedby="basic-addon1" required>
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
                                            <form action="{{url('admin/accounts')}}" method="get">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="mb-2">
                                                                <input type="text" name="from_date" value="{{$request->get('from_date')}}" id="from_date"  data-date-format="dd/mm/yyyy" class="form-control datepicker" placeholder="From Date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="mb-2">
                                                                <input type="text" name="to_date" value="{{$request->get('to_date')}}" id="to_date"  data-date-format="dd/mm/yyyy" class="form-control datepicker" placeholder="To Date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="mb-2">
                                                                <select name="cat_id" id="cat_id"  class="form-select ">
                                                                    <option value="">Select category</option>
                                                                    @if($categories)@foreach($categories as $category)
                                                                    <option value="{{$category->id}}"  @if($request->get('cat_id')==$category->id) selected @endif   >{{$category->name}}</option>
                                                                    @endforeach @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="mb-2">
                                                                <select name="payment_method" id="payment_method"  class="form-select ">
                                                                    <option value="">Select payment methods</option>
                                                                    @if($payment_methods)@foreach($payment_methods as $method)
                                                                    <option value="{{$method->method_name}}" @if($request->get('payment_method')==$method->method_name) selected @endif >{{$method->method_name}}</option>
                                                                    @endforeach @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    

                                                        <div class="col-sm-2">
                                                            <div class="mb-3">
                                                                <div class="d-grid">
                                                                    <button class="btn btn-primary  btn-sm btn-block" name="submit" value="submit"> 
                                                                        <i class="uil uil-search-alt"></i> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th> Date </th>
                                                    <th> Category </th>
                                                    <th> Method</th>
                                                    <th> Voucher NO.</th>
                                                    <th> Type </th>
                                                    <th> Amount</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($accounts)
                                            
                                            @foreach ($accounts as $account)
                                                <tr>
                                                    <td > {{date('d/m/Y',strtotime($account->created_at))}}</td>
                                                    <td > @if(isset($account->category)) {{$account->category->name}} @endif</td>
                                                    <td > {{$account->payment_method}}</td>
                                                    <td > {{$account->voucher}}</td>
                                                    <td > <span class="badge @if($account->type=='debit') bg-danger @else bg-success @endif">@if($account->type=='debit') Expense @else Income @endif</span> </td>
                                                    
                                                    <td style="color: @if($account->type=='debit') red @else green @endif" >   @if($account->type=='debit') -@else +@endif{{$account->amount}}TK</td>
                                                   
                                                    

                                                    <td class="table-action">
                                                            <a href="{{url('admin/accounts/edit/'.$account->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="{{url('admin/accounts/delete/'.$account->id)}}"  onclick="return confirm('Do you want to delete this account?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                </tr>

                                            @endforeach
                                            @endif
                                        
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="padding:2px;" colspan="7"></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="color:green">Total Income is:- ( +{{$credit}} )</th>
                                                    <th colspan="2" style="color:red">Total Expance is:- ( -{{$debit}} )</th>
                                                    <th colspan="3" style="color:orange">Total Balance is:- ( {{ $credit - $debit}} ) </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        
                                        <nav class="mt-3">
                                            @if($accounts){{$accounts->appends(request()->input())->links()}} @endif
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     <x-admin-footer/>