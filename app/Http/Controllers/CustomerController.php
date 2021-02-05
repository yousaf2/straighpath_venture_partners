<?php

namespace App\Http\Controllers;

use App\Company;
use App\Phone;
use Faker\Provider\Address;
use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\CustomerCompany;
use App\Addresse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;
use App\Services\FileUploadService;

class CustomerController extends Controller
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
    protected $redirectTo = 'crm/customers';

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'representative' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function validatorFile(array $data)
    {
        return Validator::make($data, [
            'file' => ['required', 'mimes:pdf', 'max:2048']
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
        $appa = explode(',',$data['amount_per_person']);
        $amount_per_person = '';
        foreach ($appa as $k => $v) {
            $amount_per_person .= $v;
        }
        $this->validator($data)->validate();
        if ($this->validator($data)) {
            $dob = Carbon::parse($data['dob'])->format('Y-m-d');
            $age = Carbon::parse($data['dob'])->diff(Carbon::now())->format('%Y-%m-%d');
            /*$rdate = Carbon::parse($data['requirement_date'])->format('Y-m-d');*/
            $file = '';
            if (empty($request->file('file')) === false) {
                $this->validatorFile($data)->validate();
                if ($this->validatorFile($data)) {
                    $file = FileUploadService::upload($request->file('file'), 'customers')->uploaded_name;
                }
            }
            $customer = Customer::create([
                'user_id' => Auth::user()->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'dob' => $dob,
                'age' => $age,
                'fund' => $data['fund'],
                'ssn' => $data['ssn'],
                'account_type' => $data['account_type'],
                'amount_per_person' => $amount_per_person,
                'representative' => $data['representative'],
                'notes' => $data['notes'],
                /*'requirement_date' => $rdate,*/
                'file' => $file,
                'status' => 'Active'
            ]);

            /*$addreses = array();
            if(isset($data['address']) && empty($data['address']) === false){
                $addreses[] = $data['address'];
            }
            if(isset($data['acount']) && empty($data['acount']) === false){
                for($i=1;$i<=$data['acount'];$i++){
                    $addreses[] = $data['address_'.$i];
                }
            }
            if(isset($addreses) && count($addreses) > 0){
                for($a=0;$a<count($addreses);$a++){
                    Addresse::create([
                        'customer_id' => $customer->id,
                        'address' => $addreses[$a]
                    ]);
                }
            }*/

            if (isset($data['address']) && count($data['address']) > 0) {
                $addresses = $data['address'];
                foreach ($addresses AS $address) {
                    $add_arr = explode(",", $address);
                    if(is_array($add_arr)){
                    Addresse::create([
                        'customer_id' => $customer->id,
                        'address' => $add_arr[0],
                        'city' => $add_arr[1],
                        'state' => $add_arr[2],
                        'zip' => $add_arr[3],
                    ]);
                    }
                }
            }
            
            $phones = array();
            if (isset($data['phone']) && empty($data['phone']) === false) {
                $phones[] = $data['phone'];
            }
            if (isset($data['pcount']) && empty($data['pcount']) === false) {
                for ($i = 1; $i <= $data['pcount']; $i++) {
                    $phones[] = $data['phone_' . $i];
                }
            }
            if (isset($phones) && count($phones) > 0) {
                for ($p = 0; $p < count($phones); $p++) {
                    Phone::create([
                        'customer_id' => $customer->id,
                        'phone' => $phones[$p]
                    ]);
                }
            }

            if (isset($data['position']) && count($data['position']) > 0) {
                $positions = $data['position'];
                foreach ($positions AS $position) {
                    CustomerCompany::create([
                        'customer_id' => $customer->id,
                        'company_id' => $position
                    ]);
                }
                $cc_id = Company::whereIn('id', $positions)->orderBy('purchase_date','DESC')->skip(0)->take(1)->first()->id;
                Customer::where('id',$customer->id)->update(['cc_id' => $cc_id]);
            }
        }
        return redirect($this->redirectTo);
    }

    protected function update(Request $request)
    {
        $data = $request->all();
        /*echo '<pre>';print_r($data);die();*/
        $appa = explode(',',$data['amount_per_person']);
        $amount_per_person = '';
        foreach ($appa as $k => $v) {
            $amount_per_person .= $v;
        }
        $this->validator($data)->validate();
        if ($this->validator($data)) {
            $id = $data['id'];
            $dob = Carbon::parse($data['dob'])->format('Y-m-d');
            $age = Carbon::parse($data['dob'])->diff(Carbon::now())->format('%Y-%m-%d');
            /*$rdate = Carbon::parse($data['requirement_date'])->format('Y-m-d');*/
            $file = '';
            if ($request->hasFile('file') && empty($request->file('file')) === false) {
                $this->validatorFile($data)->validate();
                if ($this->validatorFile($data)) {
                    $file = FileUploadService::upload($request->file('file'), 'customers')->uploaded_name;
                }
            }
            $update = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'dob' => $dob,
                'age' => $age,
                'fund' => $data['fund'],
                'ssn' => $data['ssn'],
                'account_type' => $data['account_type'],
                'amount_per_person' => $amount_per_person,
                'representative' => $data['representative'],
                'notes' => $data['notes'],
                /*'requirement_date' => $rdate*/
            );
            if (empty($file) === false) {
                $update['file'] = $file;
            }
            Customer::where('id', $id)->update($update);

            /*$addreses = array();
            if(isset($data['address']) && empty($data['address']) === false){
                $addreses[] = $data['address'];
            }
            if(isset($data['acount']) && empty($data['acount']) === false){
                for($i=1;$i<=$data['acount'];$i++){
                    $addreses[] = $data['address_'.$i];
                }
            }
            if(isset($addreses) && count($addreses) > 0){
                DB::table('addresses')->where('customer_id', $id)->delete();
                for($a=0;$a<count($addreses);$a++){
                    Addresse::create([
                        'customer_id' => $id,
                        'address' => $addreses[$a]
                    ]);
                }
            }*/
            if (isset($data['address']) && count($data['address']) > 0) {
                $addresses = $data['address'];
                DB::table('addresses')->where('customer_id', $id)->delete();
                foreach ($addresses AS $address) {
                    $add_arr = explode(",", $address);
                    if(is_array($add_arr)){
                        Addresse::create([
                        'customer_id' => $id,
                        'address' => $add_arr[0],
                        'city' => $add_arr[1],
                        'state' => $add_arr[2],
                        'zip' => $add_arr[3],
                    ]);
                    }
                }
            }
            
            /*if (isset($data['address']) && count($data['address']) > 0) {
                $addresses = $data['address'];
                DB::table('addresses')->where('customer_id', $id)->delete();
                $a = array();
                foreach($addresses as $key => $val){
                    $a = explode(",", $val);
                };
                foreach ($addresses AS $key => $address) {
                        Addresse::create([
                        'customer_id' => $id,
                        'address' => $a[$key][0],
                        'city' => $a[$key][1],
                        'state' => $a[$key][2],
                        'zip' => $a[$key][3],
                    ]);
                }
            }*/

            $phones = array();
            if (isset($data['phone']) && empty($data['phone']) === false) {
                $phones[] = $data['phone'];
            }
            if (isset($data['pcount']) && empty($data['pcount']) === false) {
                for ($i = 1; $i <= $data['pcount']; $i++) {
                    $phones[] = $data['phone_' . $i];
                }
            }
            if (isset($phones) && count($phones) > 0) {
                DB::table('phones')->where('customer_id', $id)->delete();
                for ($p = 0; $p < count($phones); $p++) {
                    Phone::create([
                        'customer_id' => $id,
                        'phone' => $phones[$p]
                    ]);
                }
            }

            DB::table('customer_companies')->where('customer_id', $id)->delete();
            if (isset($data['position']) && count($data['position']) > 0) {
                $positions = $data['position'];
                foreach ($positions AS $position) {
                    CustomerCompany::create([
                        'customer_id' => $id,
                        'company_id' => $position
                    ]);
                }
                $cc_id = Company::whereIn('id', $positions)->orderBy('created_at','DESC')->skip(0)->take(1)->first()->id;
                Customer::where('id',$id)->update(['cc_id' => $cc_id]);
            }
            else{
                Customer::where('id',$id)->update(['cc_id' => NULL]);
            }
        }
        return redirect($this->redirectTo);
    }

    public function cun(Request $request){

        $data = $request->all();
        $responce = Customer::where('id',$data['customer_id'])->update([
            
            'notes' => $data['customer-note'] 
        ]);
        
        return $responce;        
    }
}
