@extends('layouts.vertical', ['title' => 'CRM Companies'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/clockpicker/clockpicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">SDS</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                            <li class="breadcrumb-item active">Companies</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Company</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('companies/save')}}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="acount" id="ac" value="0">
                            <input type="hidden" name="pcount" id="pc" value="0">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control @if($errors->has('name')) is-invalid @endif"
                                       name="name" type="text"
                                       id="name" placeholder="Enter company name" required
                                       value="{{ old('name')}}"/>
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input class="form-control @if($errors->has('location')) is-invalid @endif"
                                       name="location" type="text"
                                       id="last_name" placeholder="Enter company location" required
                                       value="{{ old('location')}}"/>
                                @if($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('location') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="revenue">Revenue</label>
                                <input class="form-control @if($errors->has('revenue')) is-invalid @endif"
                                       name="revenue" type="text" required id="revenue" placeholder="Enter company revenue"/>

                                @if($errors->has('revenue'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('revenue') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="notes">Description</label>
                                <textarea class="form-control" cols="10" rows="5" name="description" id="description" placeholder="Enter description"></textarea>
                            </div>
                            <?php /*div class="form-group">
                                <label for="requirement_date">Requirement Date</label>
                                <input class="form-control" name="requirement_date" type="text" id="requirement_date"
                                       placeholder="Pick Requirement Date" value="{{ old('requirement_date')}}" data-provide="datepicker"/>
                            </div */?>
                            <div class="form-group">
                                <label for="file">Upload Company Logo</label>
                                <input class="form-control @if($errors->has('file')) is-invalid @endif" name="file" type="file" id="file"/>
                                @if($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block" type="submit"> Add Company</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/clockpicker/clockpicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
@endsection