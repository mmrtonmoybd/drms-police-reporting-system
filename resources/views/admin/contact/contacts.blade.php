<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/contacts')}}">Contacts</a></li>
                                            <li class="breadcrumb-item active">All contacts</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="uil-comments-alt"></i> Contacts</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th >Full name</th>
                                                    <th >Phone</th>
                                                    <th >Email</th>
                                                    <th >Message</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($contacts)
                                            @foreach ($contacts as $contact)
                                                <tr>
                                                    <td > {{$contact->full_name}}</td>
                                                    <td > {{$contact->phone}}</td>
                                                    <td > {{$contact->email}}</td>
                                                    <td > {{$contact->message}}</td>
                                                       
                                                    <td class="table-action">
                                                       
                                                        <a href="{{url('admin/contacts/delete/'.$contact->id)}}"  onclick="return confirm('Do you want to delete this contact?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($contacts){{$contacts->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>