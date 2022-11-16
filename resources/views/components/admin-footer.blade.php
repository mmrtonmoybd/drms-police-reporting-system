@if (auth()->check())
                     
                    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
<footer class="footer" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>document.write(new Date().getFullYear())</script> © DRMS Management
            </div>
            <div class="col-md-6 text-end" style="font-size: .9rem;">
                Developed By <a style="color:black;" href="https://engineerbd.net/">Engineer BD Network</a>
            </div>
      
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->





<script src="{{ asset('my-assets/admin/js/vendor.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('my-assets/admin/js/app.min.js') }}"></script>
<script src="{{ asset('my-assets/admin/js/vendor/apexcharts.min.js') }}"></script>
<script src="{{ asset('my-assets/admin/js/ui/component.todo.js') }}"></script>



<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $( function() {
    $( "#sortable" ).sortable({ axis: "y" });
    $( "#sortable" ).disableSelection();

    } );
    
</script>

<script>
   $(document).ready(function(){
        var sortlist = $('tbody#sortable');
        var shortable_url = $('#shortable_url').val();
       sortlist.sortable({
           update: function(event, ui){
               $.ajax({
                   url: shortable_url,
                   type: 'POST',
                   data: {
                       orders: sortlist.sortable( 'toArray' ),
                       "_token": "{{ csrf_token() }}",
                   },
                   success: function(data){
                       $('#message_section').html('<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><strong>Success - </strong> Data updated successfully</div>');
                   },
                   errors: function(errors){
                    $('#message_section').html('<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><strong>Error - </strong> Something wrong. Please try again </div>');
                    }
               });
           }
       });
    });
</script>

<script src="{{ asset('my-assets/admin/js/sms_counter.js') }}"></script>
<script>

    $('#message').countSms('#sms-counter');
</script>




<script>
    $(document).ready(function(){
        $('.datepicker').datepicker();

        $('.timepicker').timepicker();
    });

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.basic-select').select2();
    });
</script>

          
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

 @stack('scripts')
 
 
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
 
</body>

</html>
@else 

<!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- <footer class="footer footer-alt">
            2018 - 2021 © Hyper - Coderthemes.com
        </footer> -->

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="{{ asset('my-assets/admin/js/vendor.min.js') }}"></script>
        <script src="{{ asset('my-assets/admin/js/app.min.js') }}"></script>
        
    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 06:52:31 GMT -->
</html>

@endif
