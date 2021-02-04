@extends('layouts.vertical', ['title' => 'Companies'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                            <li class="breadcrumb-item active">Companies</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Companies</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 


        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="inputPassword2" class="sr-only">Search</label>
                                    <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                </div>
                                <div class="form-group mx-sm-3">
                                    <label for="status-select" class="mr-2">Sort By</label>
                                    <select class="custom-select" id="status-select">
                                        <option>Select</option>
                                        <option>Date</option>
                                        <option selected>Name</option>
                                        <option>Revenue</option>
                                        <option>Employees</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-3 mt-lg-0">
                                <button type="button" class="btn btn-success waves-effect waves-light mr-1"><i class="mdi mdi-cog"></i></button>
                                <a href="{{url('companies/create')}}">
                                    <button type="button" class="btn btn-danger waves-effect waves-light mr-1">
                                        Add Company
                                    </button>
                                </a>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-box -->
            </div><!-- end col-->
        </div>
        <!-- end row -->        

        <div class="row">
            @if(isset($companies) && count($companies) > 0)
                @foreach($companies AS $company)
                    <div class="col-lg-4">
                        <div class="card-box bg-pattern">
                            <div class="text-center">
                                @if(empty($company->image) === false)
                                    <img src="{{url('storage/companies/'. $company->image)}}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                @endif
                                <h4 class="mb-1 font-20">{{$company->name}}</h4>
                                <p class="text-muted  font-14">{{$company->location}}</p>
                            </div>

                            <p class="font-14 text-center text-muted">
                                {{$company->description}}
                            </p>

                            <?php /*div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-sm btn-light">View more info</a>
                            </div */?>

                            <div class="row mt-4 text-center">
                                <div class="col-4">
                                    <h5 class="font-weight-normal text-muted">Revenue (USD)</h5>
                                    <h4>17,786 cr</h4>
                                </div>
                                <div class="col-4">
                                    <h5 class="font-weight-normal text-muted">Number of employees</h5>
                                    <h4>566k</h4>
                                </div>
                                <div class="col-4">
                                    <h5 class="font-weight-normal text-muted">&nbsp;</h5>
                                    <a href="{{url('companies/edit/'.$company->id)}}">
                                        <button type="button" class="btn btn-primary waves-effect waves-light ">
                                            Edit
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                @endforeach
            @endif
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <ul class="pagination pagination-rounded justify-content-end">
                        {{ $companies->links() }}
                    </ul>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection