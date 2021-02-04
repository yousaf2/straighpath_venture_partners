@extends('layouts.vertical', ['title' => 'CRM Users'])

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
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('users/update')}}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="id" id="user_id" value="{{$user->id}}">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input class="form-control @if($errors->has('first_name')) is-invalid @endif"
                                name="first_name" type="text"
                                id="first_name" placeholder="Enter your name" required
                                value="{{ $user->first_name ?? old('first_name')}}"/>
                                @if($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('first_name') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="form-control @if($errors->has('last_name')) is-invalid @endif"
                                name="last_name" type="text"
                                id="last_name" placeholder="Enter your name" required
                                value="{{ $user->last_name ?? old('last_name')}}"/>
                                @if($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('last_name') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email" type="email"
                                       id="emailaddress" placeholder="Enter your email"
                                       value="{{ $user->email ?? old('email')}}" disabled/>

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password"
                                       type="password" id="password" value="********" placeholder="Enter your password" disabled/>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm password</label>
                                <input class="form-control @if($errors->has('confirm_password')) is-invalid @endif" name="confirm_password"
                                       type="password" id="confirm_password" value="********" placeholder="Enter your password" disabled/>

                                @if($errors->has('confirm_password'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                                            </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block" type="submit"> Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
