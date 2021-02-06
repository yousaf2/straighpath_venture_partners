<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class Customer extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cc_id', 'first_name', 'last_name', 'email', 'dob', 'age', 'fund', 'ssn', 'account_type', 'amount_per_person', 'representative', 'file', 'notes', 'status', 'requirement_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The attributes that should be soft delete the record.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    static function getCustomers()
    {
        $customers = DB::table('customers AS c')
            ->leftJoin('companies AS cp', 'c.cc_id', '=', 'cp.id')
            ->select('c.id', 'c.first_name', 'c.last_name', 'cp.name', 'cp.purchase_date', 'cp.share_amount')
            ->get()->paginae(10);
        return $customers;
    }
    public function addresses()
    {
        return $this->hasMany(Addresse::class, 'customer_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
