
@extends('layouts.vertical', ['title' => 'CRM Users'])
@section('css')
    <!-- Datatables css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
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
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                    <h4 style="font-family: Nunito, sans-serif;" class="page-title">Users</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 


        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <?php /*div class="col-sm-4">
                                <div class="form-group mb-2">
                                    <label for="inputPassword2" class="sr-only">Search</label>
                                    <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                </div>
                            </div */?>
                            <div class="col-sm-12">
                                <div class="text-sm-right">
                                    <?php /*button type="button" class="btn btn-success waves-effect waves-light mb-2 mr-1"><i class="mdi mdi-cog"></i></button */?>
                                    <a href="{{url('users/create')}}">
                                        <button type="button" class="btn btn-danger waves-effect waves-light mb-2" {{--data-toggle="modal" data-target="#custom-modal"--}}>
                                            Add User
                                        </button>
                                    </a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-centered table-nowrap table-hover ">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Created Date</th>
                                        <th style="width: 82px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($users) && empty($users) === false)
                                        @foreach($users AS $user)
                                            <tr>
                                                <td class="table-user">
                                                    <?php /*img src="{{asset('assets/images/users/user-4.jpg')}}" alt="table-user" class="mr-2 rounded-circle" */?>
                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$user->first_name}}</a>
                                                </td>
                                                <td>
                                                    {{$user->last_name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>

                                                    {{$user->created_at}}
                                                </td>
                                                <td>
                                                    <a href="{{url('users/edit/'.$user->id)}}">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-2" {{--data-toggle="modal" data-target="#custom-modal"--}}>
                                                            <i class="mdi mdi-square-edit-outline"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{url('users/delete/'.$user->id)}}">
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

                        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
                            {{ $users->links() }}
                            {{--<li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>--}}
                        </ul>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->

            <?php /*div class="col-lg-4">
                <div class="card-box">
                    <div class="media mb-3">
                        <img class="d-flex mr-3 rounded-circle avatar-lg" src="{{asset('assets/images/users/user-8.jpg')}}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h4 class="mt-0 mb-1">Jade M. Walker</h4>
                            <p class="text-muted">Branch manager</p>
                            <p class="text-muted"><i class="mdi mdi-office-building"></i> Vine Corporation</p>

                            <a href="javascript: void(0);" class="btn- btn-xs btn-info">Send Email</a>
                            <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Call</a>
                            <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Edit</a>
                        </div>
                    </div>

                    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Information</h5>
                    <div class="">
                        <h4 class="font-13 text-muted text-uppercase">About Me :</h4>
                        <p class="mb-3">
                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type.
                        </p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">Date of Birth :</h4>
                        <p class="mb-3"> March 23, 1984 (34 Years)</p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">Company :</h4>
                        <p class="mb-3">Vine Corporation</p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">Added :</h4>
                        <p class="mb-3"> April 22, 2016</p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">Updated :</h4>
                        <p class="mb-0"> Dec 13, 2017</p>

                    </div>

                </div> <!-- end card-box-->
            </div */?>
        </div>
        <!-- end row -->
        
    </div> <!-- container -->

    
    <!-- Modal -->
    <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Add Contacts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <form  action="{{route('register')}}" method="POST" novalidate>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="position">Phone</label>
                            <input type="text" class="form-control" id="position" placeholder="Enter phone number">
                        </div>
                        <div class="form-group">
                            <label for="company">Location</label>
                            <input type="text" class="form-control" id="company" placeholder="Enter location">
                        </div>
    
                        <div class="text-right">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light m-l-10" >Cancel</button>
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
@endsection