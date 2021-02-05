<?php

namespace App\Http\Controllers;

use App\Phone;
use Faker\Provider\Address;
use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\CustomerCompany;
use App\Addresse;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Response;

class CompanyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'apps/companies';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255']
        ]);
    }

    protected function validatorFile(array $data)
    {
        return Validator::make($data, [
            'file' => ['required', 'mimes:jpeg,png,bmp,tiff', 'max:1024']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create()
    {
        return view('customers.create');
    }

    protected function save(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        if ($this->validator($data)) {
            $file = '';
            if (empty($request->file('file')) === false) {
                $this->validatorFile($data)->validate();
                if ($this->validatorFile($data)) {
                    $file = FileUploadService::upload($request->file('file'), 'companies')->uploaded_name;
                }
            }
            Company::create([
                'user_id' => Auth::user()->id,
                'name' => $data['name'],
                'location' => $data['location'],
                'description' => $data['description'],
                'revenue' => $data['revenue'],
                'image' => $file,
                'status' => 'Active'
            ]);
        }
        return redirect($this->redirectTo);
    }

    protected function saveAjax(Request $request)
    {
        $data = $request->all();
        $saa = explode(',',$data['share_amount']);
        $share_amount = '';
        foreach ($saa as $k => $v) {
            $share_amount .= $v;
        }
        $ppsa = explode(',',$data['price_per_share']);
        $price_per_share = '';
        foreach ($ppsa as $ke => $va) {
            $price_per_share .= $va;
        }
        $asaa = explode(',',$data['all_share_amount']);
        $all_share_amount = '';
        foreach ($asaa as $key => $val) {
            $all_share_amount .= $val;
        }
        $companies = array();
        $company_id = 0;
        if (count($data) > 0) {
            if($data['paid_date']!=''){
                $is_paid = '1';
            }else{
                $is_paid = '0';
            }
            $company = Company::create([
                'user_id' => Auth::user()->id,
                'name' => $data['cname'],
                'share_amount' => $share_amount,
                'price_per_share' => $price_per_share,
                'all_share_amount' => $all_share_amount,
                'paid_date' => Carbon::parse($data['paid_date'])->format('Y-m-d'),
                'company_note' => $data['company_note'],
                'is_paid' => $is_paid,
                'purchase_date' => Carbon::parse($data['purchase_date'])->format('Y-m-d'),
                'status' => 'Active'
            ]);
            if(isset($data['info']) && $data['info']==1){
                $response = CustomerCompany::create([
                    'customer_id' => $data['customer_id'],
                    'company_id' => $company->id
                ]);
                if($response){
                    return $response;
                    exit();
                }
            }
            $companies = Company::where('id', '<>', 0)->get();
            $company_id = $company->id;
        }
        return Response::json(['companies' => $companies, 'company' => $company_id], 200);
    }

    protected function update(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        if ($this->validator($data)) {
            $id = $data['id'];
            $file = '';
            if ($request->hasFile('file') && empty($request->file('file')) === false) {
                $this->validatorFile($data)->validate();
                if ($this->validatorFile($data)) {
                    $file = FileUploadService::upload($request->file('file'), 'companies')->uploaded_name;
                }
            }
            $update = array(
                'name' => $data['name'],
                'location' => $data['location'],
                'description' => $data['description'],
                'revenue' => $data['revenue']
            );
            if (empty($file) === false) {
                $update['image'] = $file;
            }
            Company::where('id', $id)->update($update);
        }
        return redirect($this->redirectTo);
    }
    public function dc(Request $request){

        $data = $request->all();
        $response = Company::where('id',$data['company_id'])->delete();
        return $response;
    }
    public function uci(Request $request){

        $data = $request->all();
        $saa = explode(',',$data['sa']);
        $share_amount = '';
        foreach ($saa as $k => $v) {
            $share_amount .= $v;
        }
        $ppsa = explode(',',$data['pps']);
        $price_per_share = '';
        foreach ($ppsa as $ke => $va) {
            $price_per_share .= $va;
        }
        $asaa = explode(',',$data['asa']);
        $all_share_amount = '';
        foreach ($asaa as $key => $val) {
            $all_share_amount .= $val;
        }
            if($data['ipd']!=''){
                $is_paid = '1';
            }else{
                $is_paid = '0';
            }
            $response = Company::where('id',$data['ci'])->update([
                'name' => $data['cn'] ,
                'share_amount' => $share_amount ,
                'price_per_share' => $price_per_share ,
                'all_share_amount' => $all_share_amount,
                'purchase_date' => Carbon::parse($data['pd'])->format('Y-m-d') ,
                'paid_date' => Carbon::parse($data['ipd'])->format('Y-m-d') ,
                'company_note' => $data['cnote'] ,
                'is_paid' => $is_paid 
            ]);
            return $response; 
    }
}
