@extends('layouts.vertical', ['title' => 'CRM Customers'])
@section('css')
<!-- Datatables css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<style type="text/css">
    .filters{
        max-width: 132px;
        margin-right: 5px;
        border-radius: 1px;
        /*border:1px solid black;*/
    }
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: black;
      opacity: 1; /* Firefox */
  }

</style>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">SDS</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>
                <h4 style="font-family: Nunito, sans-serif;" class="page-title">Customers</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 mb-3">
                            <?php /*button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#custom-modal"><i class="mdi mdi-plus-circle mr-1"></i> Add Customers</button */?>
                            
                            <form method="post" action="" class="form-inline">
                                    @csrf
                                    <div class="col-lg-3 mt-2">
                                    <input style="width:187px;" class="form-control datepicker" type="text" name="purchase_s_date" placeholder="Purchase Start Date" value="{{isset($_POST['purchase_s_date']) ? $_POST['purchase_s_date'] : ''}}">
                                    </div>
                                    <div class="col-lg-3 mt-2 text-center">
                                    <input style="width:187px;" class="form-control datepicker" type="text" name="purchase_e_date" placeholder="Purchase End Date" value="{{isset($_POST['purchase_e_date']) ? $_POST['purchase_e_date'] : ''}}">
                                    </div>
                                    <div class="col-lg-3 mt-2 text-right">
                                    <input class="form-control" type="text" name="state" placeholder="State" value="{{isset($_POST['state']) ? $_POST['state'] : ''}}">
                                    </div>
                                    <div class="col-lg-3 mt-2 text-right">
                                    <div align="right">
                                        <a class="pull-right" href="{{url('customers/create')}}">

                                            <button type="button" class="btn btn-danger waves-effect waves-light" {{--data-toggle="modal" data-target="#custom-modal"--}}>
                                                Add Customer
                                            </button>
                                        
                                    </a></div>
                                    </div>
                                    <div class="col-lg-3 mt-2">
                                    <input class="form-control" type="text" name="zip_code" placeholder="Zip Code" value="{{isset($_POST['zip_code']) ? $_POST['zip_code'] : ''}}">
                                    </div>
                                    <div class="col-lg-3 mt-2 text-center">
                                    <input class="form-control" type="text" name="fund_no" placeholder="Fund No" value="{{isset($_POST['fund_no']) ? $_POST['fund_no'] : ''}}">
                                    </div>
                                    <div class="col-lg-3 mt-2 text-right">
                                    <input class="form-control" type="text" name="company" placeholder="Company Name" value="{{isset($_POST['company']) ? $_POST['company'] : ''}}">
                                    </div>
                                    <div class="col-lg-3 mt-2 text-right">
                                    <button class="btn btn-primary" type="submit" style="margin-right: 2px; width : 120px;">Search</button>
                                    <!-- <input type="submit" name="filters" value="Search" class="btn btn-primary" style="margin-right: 2px; width : 120px;">
                                    </div> -->
                            </form>
                        </div>
                            <?php /*div class="col-sm-8">
                                <div class="text-sm-right">
                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>
                                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div */?><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-centered table-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <?php /*th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                            </th */?>
                                            <th>Last Purchase Date</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Last Shares</th>
                                            <th>Last Position</th>
                                            <th>Rep Name</th>
                                            <th style="width: 85px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($customers) && count($customers) > 0)
                                        @foreach($customers AS $customer)
                                        <tr>
                                                <?php /*td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                                    </div>
                                                    </td */?>
                                                    <td>
                                                        {{date("m-d-Y", strtotime($customer->purchase_date))}}
                                                    </td>
                                                    <td class="table-user">
                                                        <?php /*img src="{{asset('assets/images/users/user-4.jpg')}}" alt="table-user" class="mr-2 rounded-circle" */?>
                                                        {{$customer->first_name}}
                                                    </td>
                                                    <td>
                                                        {{$customer->last_name}}
                                                    </td>
                                                    <td>
                                                        {{$customer->share_amount}}
                                                    </td>
                                                    <td>
                                                        {{$customer->name}}
                                                    </td>
                                                    <td>
                                                        {{$customer->representative}}
                                                    </td>
                                                    <td>
                                                        <a href="{{url('customers/info/'.$customer->id)}}">
                                                            <button type="button" class="btn btn-success waves-effect waves-light mb-2">
                                                                <i class="mdi mdi-information-outline"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{url('customers/edit/'.$customer->id)}}">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light mb-2" {{--data-toggle="modal" data-target="#custom-modal"--}}>
                                                                <i class="mdi mdi-square-edit-outline"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{url('customers/delete/'.$customer->id)}}">
                                                            <button type="button" class="btn btn-danger waves-effect waves-light mb-2" {{--data-toggle="modal" data-target="#custom-modal"--}}>
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <ul class="pagination pagination-rounded justify-content-end mb-0">
                                        @if(isset($customers) && count($customers) > 0)
                                        {{ $customers->links() }}
                                        @endif
                                    </ul>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
                <!-- Modal -->
                <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h4 class="modal-title" id="myCenterModalLabel">Add New Customers</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body p-4">
                                <form>
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter full name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Phone</label>
                                        <input type="text" class="form-control" id="position" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Location</label>
                                        <input type="text" class="form-control" id="category" placeholder="Enter Location">
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Continue</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @endsection
                @section('script')
                <!-- Plugins js-->
                <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
                <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

                <!-- Page js-->
                <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
                <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
                @endsection