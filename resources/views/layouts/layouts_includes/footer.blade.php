</div>





<!-- Javascript -->
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset("assets/bundles/vendorscripts.bundle.js")}}"></script>

<script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
{{--<script src="{{asset('assets/bundles/chartist.bundle.js')}}"></script>--}}
<script src="{{asset('assets/vendor/toastr/toastr.js')}}"></script>


<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->

<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->


<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/index.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>


<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        var method = $(this).attr('delete');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },function (isConfirm) {
            if (isConfirm) {
                window.location.href = link;

            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });


    function confirmDelete(type,recordId, link) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },function (isConfirm) {
            if (isConfirm) {
                if (type == "link"){
                    window.location.href = link;
                }else if(type == 'method'){
                    document.getElementById('olo-'+recordId).submit();
                }

            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });

        // swal({
        //     title: 'Are you sure?',
        //     text: "You want to proceed with the following action?",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#d33',
        //     cancelButtonColor: '#3085d6',
        //     confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         document.getElementById('deleteForm-' + recordId).submit();
        //         swal({
        //             title: "Deleted!",
        //             text: "Your data has been deleted.",
        //             icon: "success"
        //         });
        //     }
        // });
    }
</script>

</body>
</html>
