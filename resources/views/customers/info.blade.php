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
  .fi{
      font-family: Nunito, sans-serif;
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
        <h4 class="page-title fi">Customer Information</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="col-lg-12">
            <div>
              <h5 class="fi"><b>Customer Name</b></h5>  
            </div>
            <div>
              <p><?php echo $customer->first_name.' '.$customer->last_name;?></p>
            </div>
          </div>
          <div style="margin-left: -13px;" class="col-lg-12 d-flex">
            <div class="col-lg-3">
              <h5 class="fi"><b>Address</b></h5>
              @if(isset($addresses) && count($addresses) > 0)
                @foreach($addresses AS $address)
                  <div><?php echo $address->address." ".$address->city." ".$address->state." ".$address->zip; ?></div>
                @endforeach
              @endif
            </div>
            <div class="col-lg-3 text-center">
              <h5 class="fi"><b>Fund</b></h5>
              <p><?php echo $customer->fund;?></p>
            </div>
            <div class="col-lg-3 text-center">
              <h5 class="fi"><b>SSN</b></h5>
              <p><?php echo $customer->ssn;?></p>
            </div>
            <div class="col-lg-3 text-center">
              <h5 class="fi"><b>Account Type</b></h5>
              <p><?php echo $customer->account_type;?></p>
            </div>
          </div>
          <div style="margin-left: -13px;" class="col-lg-12">
            <div class="col-lg-6">
              <h5 class="fi"><b>Phone Number</b></h5>
              @foreach($phones AS $phone)
                  <div>{{ $phone->phone ?? old('phone')}}</div>
              @endforeach
            </div>
          </div>
          <!--<div class="col-lg-12 mt-3">
            <div class="text-center">
              <h5 class="text-danger"><b>PUT ALL OF THE FIELDS IN DOCUMENT AS VIEW ONLY DATA</b></h5>  
            </div>
          </div>-->
          <div style="margin-left: -13px;" class="col-lg-12 d-flex">
            <div class="col-lg-6">
              <h5 class="fi"><b>Positions</b></h5>
            </div>
            <div class="col-lg-6" style="padding: 0px;">
              <div class="text-right">
                  <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#custom-modal">
                    Add Position
                  </button>
              </div>
            </div>
          </div>
          <div class="table-responsive col-lg-12 mt-3">
            <table id="basic-datatable" class="table table-centered table-nowrap table-striped">
              <thead>
                <tr>
                  <th>Name of Company</th>
                  <th>Number of Shares</th>
                  <th>Price per Share</th>
                  <th>Dollar Amount</th>
                  <th>Date of Purchase</th>
                  <th style="width: 85px;">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($company_ids))
                @foreach($companies AS $company)
                @if(in_array($company->id, $company_ids))
                <tr>
                  <td>
                      {{$company->name}}
                  </td>
                  <td class="table-user">
                    {{$company->share_amount}}
                  </td>
                  <td>
                    {{$company->price_per_share}}
                  </td>
                  <td>
                    {{$company->all_share_amount}}
                  </td>
                  <td>
                    {{date("m-d-Y", strtotime($company->purchase_date))}}
                  </td>
                  <td>
                      <button type="button" class="btn btn-primary waves-effect waves-light mb-2" data-toggle="modal" data-target="#update_company_moadel" onclick="set_edit_values_for_company('<?php echo $company->id;?>','<?php echo $company->name; ?>','<?php echo $company->share_amount; ?>','<?php echo $company->price_per_share; ?>','<?php echo $company->purchase_date; ?>','<?php echo $company->paid_date; ?>','<?php echo $company->company_note; ?>','<?php echo $company->is_paid; ?>','<?php echo $company->all_share_amount; ?>')">
                        <i class="mdi mdi-square-edit-outline"></i>
                      </button>
                      <button type="button" id="dc" onclick ="delete_company('<?php echo $company->id?>')" class="btn btn-danger waves-effect waves-light mb-2">
                        <i class="mdi mdi-delete"></i>
                      </button>
                  </td>
                </tr>
                @endif
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div style="margin-left: -13px;" class="col-lg-12 d-flex">
            <div class="col-lg-6">
              <h5 class="fi"><b>Notes</b></h5>
            </div>
            <div class="col-lg-6" style="padding: 0px;">
              <div class="text-right">
                  <button id="cun" type="button" class="btn btn-danger waves-effect waves-light">
                    Save Note
                  </button>
              </div>
            </div>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" cols="9" rows="5" name="company_note" id="comapany_notes" placeholder="Enter your Note">{{$customer->notes}}</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Create Company Modal -->
<div class="modal fade" id="update_company_moadel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h4 class="modal-title" id="myCenterModalLabel">Edit Company</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body p-4">
        <form action="javascript:void(0);" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" class="form-control" name="cn" id="cn" placeholder="Enter Company Name" required>
          </div>
          <input type="hidden" name="cid" id="cid">
          <div class="form-group">
            <label for="share_amount">Share Amount of Company</label>
            <input type="text" class="form-control amount_comma" name="sa" id="sa" placeholder="Enter Share Amount of Company" required>
          </div>
          <div class="form-group">
            <label for="purchase_date">Date of Purchase</label>
            <input type="text" class="form-control" name="dp" id="dp" placeholder="Enter Date of Purchase" data-provide="datepicker" required>
          </div>
          <div class="form-group">
            <label for="price_per_share">Price Per Share</label>
            <input type="text" class="form-control amount_comma" name="pps" id="pps" placeholder="Enter Price Per Share" required>
          </div>
          <div class="form-group">
            <label for="notes">Note</label>
            <textarea class="form-control" cols="10" rows="3" name="c_note" id="c_note" placeholder="Enter your Note"></textarea>
          </div>
          <div class="form-group">
            <label class="switch">
              <input type="checkbox" name="ipc" id="edit_is_paid">
              <span class="slider round"></span>
            </label>
          </div>
          <div class="form-group" id="edit_paid_date">
            <label for="dob">Paid Date</label>
            <input class="form-control" name="pd" id="pd" type="text" placeholder="Pick Date of paid" data-provide="datepicker"/>
          </div>
          <input type="hidden" name="flag" id="flag">
          <div class="form-group">
            <label for="price_per_share">Dollar Amount:</label>
            <span id="tm"></span>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-success waves-effect waves-light" id="edit_comp_info">Save</button>
            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
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
            <input type="text" class="form-control amount_comma" name="share_amount" id="share_amount" placeholder="Enter Share Amount of Company" required>
          </div>
          <div class="form-group">
            <label for="purchase_date">Date of Purchase</label>
            <input type="text" class="form-control" name="purchase_date" id="purchase_date" placeholder="Enter Date of Purchase" data-provide="datepicker" required>
          </div>
          <div class="form-group">
            <label for="price_per_share">Price Per Share</label>
            <input type="text" class="form-control amount_comma" name="price_per_share" id="price_per_share" placeholder="Enter Price Per Share" required>
          </div>
          <div class="form-group">
            <label for="notes">Note</label>
            <textarea class="form-control" cols="10" rows="3" name="company_note" id="comapany_notes" placeholder="Enter your Note"></textarea>
          </div>
          <div class="form-group">
            <label class="switch">
              <input type="checkbox" name="is_paid" id="create_is_paid">
              <span class="slider round"></span>
            </label>
          </div>
          <div class="form-group" id="create_paid_date">
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
</div>
<!-- /.modal -->
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
    var customer_id = "<?php echo $customer->id;?>"
    $('#position :selected').each(function(){
      selected.push(parseInt($(this).val()));
    });
    if(cname !== "" && share_amount !== "" && price_per_share !== "" && purchase_date !== ""){
      formData[0].reset();
      $('.modal').modal('hide');
      $.ajax({
        url: '<?php echo url('companies/save-company')  ?>',
        data: {"_token": "{{ csrf_token() }}", "cname" : cname, "share_amount" : share_amount, "price_per_share" : price_per_share, "all_share_amount" : all_share_amount, "purchase_date" : purchase_date, "company_note" : company_note, "paid_date" : paid_date, "info" : 1,"customer_id" : customer_id},
        type: 'POST',
        success: function (data) {
          if(data){
            location.reload();
          }
        }
      });
    }
  });
  $(document).ready(function(){
    $('#create_paid_date').hide();
    $('#edit_paid_date').hide();
    $('#create_is_paid').on('click',function(){
      if(bit=='on'){
        $('#create_paid_date').show();
        bit = 'off';
      }else{
        $('#create_paid_date').hide();
        bit = 'on'
      }
    });
    $('#edit_is_paid').on('click',function(){
      var v = $('#flag').val();
      if(v=='on'){
          $('#flag').val('off');
          $('#edit_paid_date').hide();
      }if(v=='off'){
          $('#flag').val('on');
          $('#edit_paid_date').show();
      }
      /*var v = $('#pd').val();
      if(v!=''){
          $('#pd').val('');
          $('#edit_paid_date').hide();
      }elseif(v==''){
          $('#edit_paid_date').hide();
      }
      else{
          $('#edit_paid_date').show();
      }*/
      /*if(bit=='on'){
        $('#edit_paid_date').show();
        bit = 'off';
      }else{
        $('#edit_paid_date').hide();
        bit = 'on'
      }*/
    });
    $('#cun').on('click',function(){
      var cn = $('#comapany_notes').val();
      console.log(cn);
      $.ajax({
          url : '<?php echo url('cun') ?>',
          method : 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data : {
            "customer_id" : <?php echo $customer->id; ?> ,
            "customer-note" : cn
          },
          success:function(ajax_responce){
              if(ajax_responce){
                location.reload();
              }    
          }
      });
    })
    $('#edit_comp_info').on('click',function(){
     $('.modal').modal('hide');
      var ci = $('#cid').val();
      var cn = $('#cn').val();
      var sa = $('#sa').val();
      var pd =$('#dp').val();
      var pps =$('#pps').val();
      var cnote = $('#c_note').val();
      var ipd = $('#pd').val();
      var esa = sa.split(",").join("");
      var epps = pps.split(",").join("");
      var easa = esa*epps;
      var eall_share_amount = numberWithCommas(easa);

      $.ajax({
        url: '<?php echo url('uci')  ?>',
        data: {
            "ci" : ci ,
            "cn" : cn ,
            "sa" : sa ,
            "pd" : pd ,
            "pps" : pps ,
            "cnote" : cnote ,
            "ipd" : ipd,
            "asa" : eall_share_amount  
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function (data) {
          if(data){
            location.reload();
          }
        }
      });   
    });
  });
  function delete_company(c_id){
      $.ajax({
          url : '<?php echo url('dc') ?>',
          method : 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data : {
            "company_id" : c_id 
          },
          success:function(ajax_responce){
              if(ajax_responce){
                location.reload();
              }    
          }
      });
  }
  function set_edit_values_for_company(c_id,cn,sa,pps,pd,ipd,cnote,bip,asa){
      
      $('#cid').val(c_id);
      $('#cn').val(cn);
      $('#sa').val(sa);
      $('#dp').val(pd);
      $('#pps').val(pps);
      $('#c_note').val(cnote);
      $('#tm').html(asa);
      if(bip==1){
        $('#flag').val('on'); 
        $('#edit_is_paid').prop('checked', true);
        $('#edit_paid_date').show();
        $('#pd').val(ipd);
      }else{
        $('#flag').val('off');
        $('#edit_is_paid').prop('checked', false);
        $('#edit_paid_date').hide();
        $('#pd').val('');
      }
  }
  $('.amount_comma').keyup(function(event) {
    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;
    // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
  });
  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
  $(document).on('keyup', '#sa', function () {
    var share_amount = $(this).val().split(",").join("");
    var price_per_share = $(this).parents('form').find('#pps').val().split(",").join("");
      //var total_amount = share_amount;
      if(share_amount !== "" && price_per_share !== ""){
        var total_amount = (share_amount * price_per_share);
        $('#tm').html(numberWithCommas(total_amount));
      }
  });
  $(document).on('keyup', '#pps', function () {
    var share_amount = $(this).val().split(",").join("");
    var price_per_share = $(this).parents('form').find('#sa').val().split(",").join("");
      //var total_amount = price_per_share;
      if(share_amount !== "" && price_per_share !== ""){
        var total_amount = (share_amount * price_per_share);
        $('#tm').html(numberWithCommas(total_amount));
      }
  });
</script>
@endsection