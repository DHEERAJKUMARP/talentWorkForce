@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    .table td, .table th {
        font-size: 12px;
        line-height: 2.42857 !important;
    }	

    .table-scrollable .dataTable td .btn-group, .table-scrollable .dataTable th .btn-group {
    position: relative !important;
    margin-top: -2px;
}
</style>
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Users</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Users <small>Users</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Users</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.user') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New User</a>
                            <a href="{{ route('excel.export') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Export To Excel</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="user-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="user_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">                  
                                            <td><input type="text" class="form-control" name="id" id="id" autocomplete="off"></td>                    
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="email" id="email" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="phone" id="phone" autocomplete="off"></td>
                                            <td>
                                                <input type="text" class="form-control" name="degree_level_id" id="degree_level_id" autocomplete="off">
                                                <!-- {!! Form::select('degree_level_id', [''=>'Select Degree Level']+$degreeLevels, null, array('class'=>'form-control', 'id'=>'degree_level_id')) !!} --></td> 
                                            <td> {!! Form::select('job_experience_id', [''=>'Select Experience']+$jobExperiences, null, array('class'=>'form-control', 'id'=>'job_experience_id')) !!}</td>
                                            <td>{!! Form::select('functional_area_id', [''=>'Select Functional Area']+$functionalAreas, null, array('class'=>'form-control', 'id'=>'functional_area_id')) !!}</td>
                                            
                                            <td><input type="text" class="form-control" name="passed_out_year" id="passed_out_year" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="current_salary" id="current_salary" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="expected_salary" id="expected_salary" autocomplete="off"></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading"> 
                                            <th>Id</th>                                        
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                             <th>Qualification</th> 
                                            <th>Experience</th>
                                            <th>Job Role</th>
                                           <th>Passed Out Year</th>
                                            <th>Current Salary</th>
                                            <th>Expected Salary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>
@endsection
@push('scripts') 
<script>
    $(function () {
        var oTable = $('#user_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            "order": [[0, "desc"]],
            /*		
             paging: true,
             info: true,
             */
            ajax: {
                url: '{!! route('fetch.data.users') !!}',
                data: function (d) {
                    d.id = $('input[name=id]').val();
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                    d.phone = $('input[name=phone]').val();
                    d.degree_level = $('#degree_level_id').val();
                    d.job_experience_id = $('#job_experience_id').val();
                    d.functional_area_id = $('#functional_area_id').val();
                     d.passed_out_year = $('input[name=passed_out_year]').val();
                    d.current_salary = $('input[name=current_salary]').val();
                    d.expected_salary = $('input[name=expected_salary]').val();
                }
            }, columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'degree_level', name: 'degree_level'},
                {data: 'job_experience_id', name: 'job_experience_id'},
                {data: 'functional_area', name: 'functional_area'},
                 {data: 'passed_out_year', name: 'passed_out_year'},
                {data: 'current_salary', name: 'current_salary'},
                {data: 'expected_salary', name: 'expected_salary'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#user-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#id').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#email').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#phone').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#job_experience_id').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#degree_level_id').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        }); 
        $('#functional_area_id').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#current_salary').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#expected_salary').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function delete_user(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.user') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#user_datatable_ajax').DataTable();
                            table.row('user_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    function make_active(id) {
        $.post("{{ route('make.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Make InActive");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function make_not_active(id) {
        $.post("{{ route('make.not.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Make Active");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function make_verified(id) {
        $.post("{{ route('make.verified.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_not_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Verified");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function make_not_verified(id) {
        $.post("{{ route('make.not.verified.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Not Verified");
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
</script> 
@endpush