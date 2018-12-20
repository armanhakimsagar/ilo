<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Complain Management System</title>
    <!-- Bootstrap Core CSS -->
    <link href="{!! asset('theme/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/bootstrap-select.min.css') !!}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{!! asset('theme/vendor/metisMenu/metisMenu.min.css') !!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!! asset('theme/dist/css/sb-admin-2.css') !!}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{!! asset('theme/vendor/morrisjs/morris.css') !!}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{!! asset('theme/vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="{!! asset('images/favicon.ico') !!}" type="image/x-icon">

    <!-- ================= DataTables CSS Start =============================== 

    <script src="{!! asset('datatables/css/dataTables.bootstrap.min.css') !!}"></script>
    <script src="{!! asset('datatables/css/fixedHeader.bootstrap.min.css') !!}"></script>
    <script src="{!! asset('datatables/css/responsive.bootstrap.min.css') !!}"></script>

    -->

    <!-- ================= DataTables CSS End =============================== -->
    
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap-datepicker.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/animate.css') !!}">
    {!! Charts::styles() !!}
    {!! Charts::scripts() !!}
    
    <style type="text/css">
        .btn-primary{
            background-color: #00097c!important;
            border: none;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('theme.header')
            @include('theme.sidebar')
        </nav>
        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap-select.min.js') !!}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{!! asset('theme/vendor/metisMenu/metisMenu.min.js') !!}"></script>
    <!-- Morris Charts JavaScript 
    <script src="{!! asset('theme/vendor/raphael/raphael.min.js') !!}"></script>
    <script src="{!! asset('theme/vendor/morrisjs/morris.min.js') !!}"></script>
    <script src="{!! asset('theme/data/morris-data.js') !!}"></script>
    -->
    <!-- Custom Theme JavaScript -->
    <script src="{!! asset('theme/dist/js/sb-admin-2.js') !!}"></script>
    <!-- ========================== Date Picker ============================= -->
    

    <!-- ================= DataTables Js Start =============================== -->

    <script src="{!! asset('datatables/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('datatables/js/dataTables.bootstrap.min.js') !!}"></script>
    <script src="{!! asset('datatables/js/dataTables.fixedHeader.min.js') !!}"></script>
    <script src="{!! asset('datatables/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('datatables/js/responsive.bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap-datepicker.min.js') !!}"></script>
    <script>
        $('#last_renewal').datepicker({
            dateFormat: 'yy-mm-dd',
            todayHighlight:'TRUE',
            startDate: '-0d',
            autoclose: true,
        });
    </script>

    <!-- ================= Ckeditor Js Start =============================== 
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor');
    </script>
    -->
    <!-- ================= Ckeditor Js Start =============================== -->
    <script type="text/javascript">

        $(document).ready(function() {
            $('table.display').DataTable({
                "order": [[ 0, 'desc' ]]
            });
            $('table.display_user').DataTable({
                "order": [[ 1, 'asc' ]]
            });
            $('table.group').DataTable({
                "order": [[ 0, 'asc' ]]
            });
        });

    </script>

    <!-- ================= DataTables Js End =============================== -->

    <!-- ================= Re-type Password Validation start =============== -->
    <script>
        $(document).ready(function(){
            $("#ConfirmPassword").keyup(function(){
                 if ($("#password").val() != $("#ConfirmPassword").val()) {
                     $("#msg").html("Password do not match").css("color","red");
                 }else{
                     $("#msg").html("Password matched").css("color","green");
                }
          });
    });
    </script>
    <!-- ================= Re-type Password Validation end =============== -->
    <!-- ================= Upload image view start ======================= -->
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function(){
            readURL(this);
        });
    </script>
    <!-- ================= Upload image view End ======================= -->
    <!-- ================= To do List create ======================= -->
    <script>
    function todoSubmit(modalID){
        $.ajax({
            type: "POST",
            url: "todoCreate",
            data: {'title' : $('#title').val(), 'taskdate': $('#taskdate').val(), 'priority': $('#priority').val()}
        });
    }
    </script>

    <script type="text/javascript">
        function show_public()
        {
          document.getElementById('person_show').style.display ='none';
        }
        function show_person()
        {
          document.getElementById('person_show').style.display ='block';
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            toggleFields();
            $("#complaint_against_name").change(function () {
                toggleFields();
            });
        });
        function toggleFields() {
            if ($("#complaint_against_name").val() == "Others")
                $("#complaint_against_name_others").show();
            else
                $("#complaint_against_name_others").hide();
        }
    </script>

    

    <!-- ================ Multiple select option value store ====================== -->
    <script>
        $('document').ready(function(){
            $('#assign').click(function(){
            var ag = $('#selectpicker').val();
                $('[name="my_data"]').val(ag);
            });
        });
    </script>
    <!-- ================ Limited text show ====================== -->
    <script>
        $(document).ready(function ()
           { $(".class-span").each(function(i){
                var len=$(this).text().trim().length;
                if(len>50)
                {
                    $(this).text($(this).text().substr(0,100)+'...');
                }
            });
         });
    </script>

</body>
</html>