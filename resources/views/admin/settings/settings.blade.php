<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/renters')}}">Settings</a></li>
                                            <li class="breadcrumb-item active">Edit Settings</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="dripicons-gear noti-icon"></i> Settings</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/settings')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                                <h3><i class="mdi mdi-account-edit me-1"></i> Header Settings</h3>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="header_phone" class="form-label ">Header Phone</label>
                                                    <input type="text" name="header_phone" id="header_phone" value="@if(isset($settings['header_phone'])){{$settings['header_phone']}}@endif" class="form-control @error('header_phone') is-invalid @enderror" placeholder="Header Phone" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="header_email" class="form-label">Header Email</label>
                                                    <input type="email" name="header_email"  value="@if(isset($settings['header_email'])){{$settings['header_email']}}@endif" id="header_email" class="form-control  @error('header_email') is-invalid @enderror" placeholder="Header Email" required>
                                                </div>
                                            </div>
                                           

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    @if(isset($settings['header_logo']))
                                                    <img src="{{ asset('storage/settings/'.$settings['header_logo']) }}" style="max-height:80px" alt="" class="img-fluid">
                                                    @endif
                                                    <label for="header_logo" class="form-label">Header Logo <small>(450px X 85px)</small></label>
                                                    <input type="file" name="header_logo" id="header_logo" class="form-control" placeholder="Header Logo">
                                                </div>
                                            </div>
                             
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                



                                    
                                    <div class="card card-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                                <h3><i class="mdi mdi-account-edit me-1"></i> Footer Settings</h3>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="footer_phone" class="form-label ">Footer Phone</label>
                                                    <input type="text" name="footer_phone" id="footer_phone" value="@if(isset($settings['footer_phone'])){{$settings['footer_phone']}}@endif" class="form-control @error('footer_phone') is-invalid @enderror" placeholder="Footer Phone" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="footer_email" class="form-label">Footer Email</label>
                                                    <input type="email" name="footer_email"  value="@if(isset($settings['footer_email'])){{$settings['footer_email']}}@endif" id="footer_email" class="form-control  @error('footer_email') is-invalid @enderror" placeholder="Footer Email" required>
                                                </div>
                                            </div>
                                           

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    @if(isset($settings['footer_logo']))
                                                    <img src="{{ asset('storage/settings/'.$settings['footer_logo']) }}" style="max-height:80px" alt="" class="img-fluid">
                                                    @endif
                                                    <label for="footer_logo" class="form-label">Footer Logo <small>(450px X 85px)</small></label>
                                                    <input type="file" name="footer_logo" id="footer_logo" class="form-control" placeholder="Footer Logo">
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-12 ">
                                                <div class="mb-3">
                                                    <label for="footer_address" class="form-label ">Footer Address</label>
                                                    <textarea type="text" name="footer_address" id="footer_address" class="form-control @error('footer_address') is-invalid @enderror" placeholder="Footer Address" required >@if(isset($settings['footer_address'])){{$settings['footer_address']}}@endif</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 ">
                                                <div class="mb-3">
                                                    <label for="footer_copyright" class="form-label ">Footer Copyright</label>
                                                    <textarea type="text" name="footer_copyright" id="footer_copyright" class="form-control @error('footer_copyright') is-invalid @enderror" placeholder="Footer Copyright" required >@if(isset($settings['footer_copyright'])){{$settings['footer_copyright']}}@endif</textarea>
                                                </div>
                                            </div>
                             
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                


                                    
                                    <div class="card card-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                                <h3><i class="mdi mdi-account-edit me-1"></i> Contact page Settings</h3>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="contact_phone" class="form-label ">Contact Phone</label>
                                                    <input type="text" name="contact_phone" id="contact_phone" value="@if(isset($settings['contact_phone'])){{$settings['contact_phone']}}@endif" class="form-control @error('contact_phone') is-invalid @enderror" placeholder="Contact Phone" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="contact_email" class="form-label">Contact Email</label>
                                                    <input type="email" name="contact_email"  value="@if(isset($settings['contact_email'])){{$settings['contact_email']}}@endif" id="footer_email" class="form-control  @error('contact_email') is-invalid @enderror" placeholder="Contact Email" required>
                                                </div>
                                            </div>
                                           
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="contact_short_text" class="form-label">Contact short text</label>
                                                    <input type="text" name="contact_short_text"  value="@if(isset($settings['contact_short_text'])){{$settings['contact_short_text']}}@endif" id="contact_short_text" class="form-control  @error('contact_short_text') is-invalid @enderror" placeholder="Contact short text" required>
                                                </div>
                                            </div>
                                           


                                            
                                            <div class="col-sm-12 ">
                                                <div class="mb-3">
                                                    <label for="contact_map" class="form-label ">Contact MAP</label>
                                                    <textarea  rows="5" type="text" name="contact_map" id="contact_map" class="form-control @error('contact_map') is-invalid @enderror" placeholder="Contact MAP" required >@if(isset($settings['contact_map'])){{$settings['contact_map']}}@endif</textarea>
                                                </div>
                                            </div>
                             
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                



                                    

                                    
                                    <div class="card card-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                                <h3><i class="mdi mdi-account-edit me-1"></i> About Settings</h3>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="about_title" class="form-label ">About Title</label>
                                                    <input type="text" name="about_title" id="about_title" value="@if(isset($settings['about_title'])){{$settings['about_title']}}@endif" class="form-control @error('about_title') is-invalid @enderror" placeholder="About Title" required >
                                                </div>
                                            </div>
                                          
                                           
                                            <div class="col-sm-12 ">
                                                <div class="mb-3">
                                                    <label for="about_description" class="form-label ">About Description</label>
                                                    <textarea rows="5" type="text" name="about_description" id="about_description" class="form-control @error('about_description') is-invalid @enderror" placeholder="About Description" required >@if(isset($settings['about_description'])){{$settings['about_description']}}@endif</textarea>
                                                </div>
                                            </div>
                             

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    @if(isset($settings['about_image']))
                                                    <img src="{{ asset('storage/settings/'.$settings['about_image']) }}" style="max-height:80px" alt="" class="img-fluid">
                                                    <br />
                                                    @endif
                                                    <label for="about_image" class="form-label">About Image<small>(16/9 ratio)</small></label>
                                                    <input type="file" name="about_image" id="about_image" class="form-control" placeholder="About Image">
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                


                                    
                                    <div class="card card-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                                <h3><i class="mdi mdi-account-edit me-1"></i> Opening Times</h3>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="saturday_open" class="form-label ">Saturday</label>
                                                    <input type="text" name="saturday_open" id="saturday_open" value="@if(isset($settings['saturday_open'])){{$settings['saturday_open']}}@endif" class="form-control @error('saturday_open') is-invalid @enderror" placeholder="Saturday Open" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="sunday_open" class="form-label ">Sunday</label>
                                                    <input type="text" name="sunday_open" id="sunday_open" value="@if(isset($settings['sunday_open'])){{$settings['sunday_open']}}@endif" class="form-control @error('sunday_open') is-invalid @enderror" placeholder="Sunday Open" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="monday_open" class="form-label ">Monday</label>
                                                    <input type="text" name="monday_open" id="monday_open" value="@if(isset($settings['monday_open'])){{$settings['monday_open']}}@endif" class="form-control @error('monday_open') is-invalid @enderror" placeholder="Monday Open" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="tudesday_open" class="form-label ">Tuesday</label>
                                                    <input type="text" name="tudesday_open" id="tudesday_open" value="@if(isset($settings['tudesday_open'])){{$settings['tudesday_open']}}@endif" class="form-control @error('tudesday_open') is-invalid @enderror" placeholder="Tudesday Open" required >
                                                </div>
                                            </div>
                                          
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="wednesday_open" class="form-label ">Wednesday</label>
                                                    <input type="text" name="wednesday_open" id="wednesday_open" value="@if(isset($settings['wednesday_open'])){{$settings['wednesday_open']}}@endif" class="form-control @error('wednesday_open') is-invalid @enderror" placeholder="Wednesday Open" required >
                                                </div>
                                            </div>
                                          
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="thursday_open" class="form-label ">Thursday</label>
                                                    <input type="text" name="thursday_open" id="thursday_open" value="@if(isset($settings['thursday_open'])){{$settings['thursday_open']}}@endif" class="form-control @error('thursday_open') is-invalid @enderror" placeholder="Thursday Open" required >
                                                </div>
                                            </div>
                                          
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="friday_open" class="form-label ">Friday </label>
                                                    <input type="text" name="friday_open" id="friday_open" value="@if(isset($settings['friday_open'])){{$settings['friday_open']}}@endif" class="form-control @error('friday_open') is-invalid @enderror" placeholder="Friday  Open" required >
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