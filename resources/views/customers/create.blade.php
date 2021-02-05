@extends('layouts.vertical', ['title' => 'CRM Customers'])
@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/libs/clockpicker/clockpicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
  }

  /* Hide default HTML checkbox */
  .switch input {
      opacity: 0;
      width: 0;
      height: 0;
  }

  /* The slider */
  .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
  }

  .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
  }

  input:checked + .slider {
      background-color: #2196F3;
  }

  input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
      border-radius: 34px;
  }

  .slider.round:before {
      border-radius: 50%;
  }
</style>
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
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Customer</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('customers/save')}}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="acount" id="ac" value="0">
                        <input type="hidden" name="pcount" id="pc" value="0">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input class="form-control @if($errors->has('first_name')) is-invalid @endif"
                            name="first_name" type="text"
                            id="first_name" placeholder="Enter your first name" required
                            value="{{ old('first_name')}}"/>
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
                            id="last_name" placeholder="Enter your last name" required
                            value="{{ old('last_name')}}"/>
                            @if($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <a href="javascript:void(0);" data-type="address" data-toggle="modal" data-target="#custom-modal-address" class="float-right">Add More</a>
                            <select class="form-control select2" name="address[]" id="address" data-toggle="select2" multiple></select>
                            <?php /*input class="form-control" name="address" type="text" id="address" placeholder="Enter your address" required value="{{ old('address')}}" */?>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <a href="javascript:void(0);" id="add-more" data-type="phone" class="float-right">Add More</a>
                            <input class="form-control" name="phone" type="text" id="phone" placeholder="Enter your phone" required value="{{ old('phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="dob">DOB</label>
                            <input class="form-control  @if($errors->has('dob')) is-invalid @endif"
                            name="dob" type="text"
                            id="dob" placeholder="Pick Date of Birth" required
                            value="{{ old('dob')}}" data-provide="datepicker"/>
                            @if($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="ssn">SSN</label>
                            <input class="form-control @if($errors->has('ssn')) is-invalid @endif" name="ssn" type="text" required
                            id="ssn" placeholder="Enter SSN"/>
                            @if($errors->has('ssn'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ssn') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Email</label>
                            <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email" type="email"
                            id="emailaddress" required placeholder="Enter your email"
                            value="{{ old('email')}}"/>

                            @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="position">Positions</label><a href="javascript:void(0);" data-toggle="modal" data-target="#custom-modal" class="float-right">Add New Position</a>
                            @if($companies)
                            <select class="form-control select2" name="position[]" id="position" data-toggle="select2" multiple>
                                @foreach($companies AS $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fund">Fund</label>
                            <input class="form-control @if($errors->has('fund')) is-invalid @endif"
                            name="fund" type="text" required id="fund" placeholder="Enter Fund Number"/>

                            @if($errors->has('fund'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fund') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="account_type">Type of Account</label>
                            @if($accout_types)
                            <select class="form-control" name="account_type" id="account_type">
                                <option value="">Type of Account</option>
                                @foreach($accout_types AS $accout_type)
                                <option value="{{$accout_type}}">{{$accout_type}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="amount_per_person">Total Dollar Amount Per Person</label>
                            <input class="form-control auc @if($errors->has('amount_per_person')) is-invalid @endif"
                            name="amount_per_person" type="text" required id="amount_per_person" placeholder="Enter Amount Per Person"/>

                            @if($errors->has('amount_per_person'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount_per_person') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="notes">Note</label>
                            <textarea class="form-control" cols="10" rows="3" name="notes" id="notes" placeholder="Enter your Note"></textarea>
                        </div>
                            <!-- <div class="form-group">
                                <label for="requirement_date">Requirement Date</label>
                                <input class="form-control" name="requirement_date" type="text" id="requirement_date"
                                       placeholder="Pick Requirement Date" value="{{ old('requirement_date')}}" data-provide="datepicker"/>
                                   </div> -->
                                   <div class="form-group">
                                    <label for="representative">Representative Name</label>
                                    <input class="form-control @if($errors->has('representative')) is-invalid @endif"
                                    name="representative" type="text" required id="representative" placeholder="Enter Representative Name"/>

                                    @if($errors->has('representative'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('representative') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="file">Upload (PDF)</label>
                                    <input class="form-control @if($errors->has('file')) is-invalid @endif" name="file" type="file" id="file"/>
                                    @if($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-success btn-block" type="submit"> Add Customer</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Company Modal -->
        <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Add New Company</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="javascript:void(0);" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Company Name" required>
                            </div>
                            <div class="form-group">
                                <label for="share_amount">Share Amount of Company</label>
                                <input type="text" class="form-control auc" name="share_amount" id="share_amount" placeholder="Enter Share Amount of Company" required>
                            </div>
                            <div class="form-group">
                                <label for="purchase_date">Date of Purchase</label>
                                <input type="text" class="form-control" name="purchase_date" id="purchase_date" placeholder="Enter Date of Purchase" data-provide="datepicker" required>
                            </div>
                            <div class="form-group">
                                <label for="price_per_share">Price Per Share</label>
                                <input type="text" class="form-control auc" name="price_per_share" id="price_per_share" placeholder="Enter Price Per Share" required>
                            </div>
                            <div class="form-group">
                                <label for="notes">Note</label>
                                <textarea class="form-control" cols="10" rows="3" name="company_note" id="comapany_notes" placeholder="Enter your Note"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="switch">
                                  <input type="checkbox" name="is_paid" id="is_paid">
                                  <span class="slider round"></span>
                              </label>
                          </div>
                          <div class="form-group" id="paid_date">
                            <label for="dob">Paid Date</label>
                            <input class="form-control" name="paid_date" type="text" placeholder="Pick Date of paid" data-provide="datepicker"/>
                        </div>
                        <div class="form-group">
                            <label for="price_per_share">Dollar Amount:</label>
                            <span id="calcaulate-share"></span>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success waves-effect waves-light save-company">Save</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Create Address Modal -->
    <div class="modal fade" id="custom-modal-address" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <form action="javascript:void(0);" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name">House No#</label>
                            <input  pattern="[A-Za-z0-9]+" type="text" class="form-control" name="house_no" id="house_no" placeholder="Enter House No" required>
                        </div>
                        <div class="form-group">
                            <label for="share_amount">City</label>
                            <input  pattern="[A-Za-z0-9]+" type="text" class="form-control" name="city" id="city" placeholder="Enter City" required>
                        </div>
                        <div class="form-group">
                            <label for="purchase_date">State</label>
                            <input  pattern="[A-Za-z0-9]+" type="text" class="form-control" name="state" id="state" placeholder="Enter State" required>
                        </div>
                        <div class="form-group">
                            <label for="price_per_share">Zip</label>
                            <input  pattern="[A-Za-z0-9]+" type="text" class="form-control" name="zip" id="zip" placeholder="Enter Zip" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success waves-effect waves-light save-address">Save</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endsection
    @section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/clockpicker/clockpicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-summernote.init.js')}}"></script>
    <script>
        var bit = 'on';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('keyup', '#share_amount', function () {
            var share_amount = $(this).val().split(",").join("");
            var price_per_share = $(this).parents('form').find('#price_per_share').val().split(",").join("");
            //var total_amount = share_amount;
            if(share_amount !== "" && price_per_share !== ""){
                var total_amount = (share_amount * price_per_share);
                $('#calcaulate-share').html(numberWithCommas(total_amount));
            }
        });
        $(document).on('keyup', '#price_per_share', function () {
            var share_amount = $(this).val().split(",").join("");
            var price_per_share = $(this).parents('form').find('#share_amount').val().split(",").join("");
            //var total_amount = price_per_share;
            if(share_amount !== "" && price_per_share !== ""){
                var total_amount = (share_amount * price_per_share);
                $('#calcaulate-share').html(numberWithCommas(total_amount));
            }
        });
        $('.select2').select2();
        $(document).on('click','.save-company',function () {
            var this_elem = $(this), formData = this_elem.parents('form');
            var cname = formData.find('input[name="name"]').val();
            var share_amount = formData.find('input[name="share_amount"]').val();
            var price_per_share = formData.find('input[name="price_per_share"]').val();
            var purchase_date = formData.find('input[name="purchase_date"]').val();
            var company_note = formData.find('textarea[name="company_note"]').val();
            var paid_date = formData.find('input[name="paid_date"]').val();
            var sa = share_amount.split(",").join("");
            var pps = price_per_share.split(",").join("");
            var asa = sa*pps;
            var all_share_amount = numberWithCommas(asa);
            var selected=[];
            $('#position :selected').each(function(){
                selected.push(parseInt($(this).val()));
            });
            if(cname !== "" && share_amount !== "" && price_per_share !== "" && purchase_date !== ""){
                formData[0].reset();
                $('.modal').modal('hide');
                $.ajax({
                    url: '<?php echo url('companies/save-company')  ?>',
                    data: {"_token": "{{ csrf_token() }}", "cname" : cname, "share_amount" : share_amount, "price_per_share" : price_per_share , "all_share_amount" : all_share_amount , "purchase_date" : purchase_date, "company_note" : company_note, "paid_date" : paid_date},
                    type: 'POST',
                    success: function (data) {
                        var companies = data.companies;
                        var company_id = data.company;
                        if(company_id > 0){
                            selected.push(company_id);
                        }
                        if(companies.length > 0){
                            var postitions_html = '';
                            $.each(companies, function (key, val) {
                                var selectOption = '';
                                if($.inArray(val.id,selected)  !== -1){
                                    selectOption = 'selected="selected"';
                                }
                                postitions_html +='<option value="'+val.id+'" '+selectOption+'>'+val.name+'</option>';
                            });
                            $('select#position').html(postitions_html);
                        }
                    }
                });
            }
        });
        $(document).on('click','.save-address',function () {
            var this_elem = $(this), formData = this_elem.parents('form');
            var house_no = formData.find('input[name="house_no"]').val();
            house_no = house_no.replace(',', '-');
            var city = formData.find('input[name="city"]').val();
            city = city.replace(',', '-');
            var state = formData.find('input[name="state"]').val();
            state = state.replace(',', '-');
            var zip = formData.find('input[name="zip"]').val();
            zip = zip.replace(',', '-');
            var hasHtml = $('select#address').html();
            if(house_no !== "" && city !== "" && state !== "" && zip !== ""){
                formData[0].reset();
                $('.modal').modal('hide');
                var address = house_no+', '+city+', '+state+', '+zip;
                var address_html ='<option value="'+address+'" selected="selected">'+address+'</option>';
                if(hasHtml){
                    $('select#address').append(address_html);
                }
                else{
                    $('select#address').html(address_html);
                }
            }
        });
        $(document).ready(function(){
            $('#paid_date').hide();
            $('#is_paid').on('click',function(){
                if(bit=='on'){
                    $('#paid_date').show();
                    bit = 'off';
                }else{
                    $('#paid_date').hide();
                    bit = 'on'
                }
            });
            $('.auc').keyup(function(event) {

              $(this).val(amountWithCommas($(this).val().split(",").join("")));
            });
        });
        function numberWithCommas(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        function amountWithCommas(number) {
          var parts = number.toString().split(".");
          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          return parts.join(".");
        }
    </script>
    @endsection