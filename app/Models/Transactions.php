<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory;
    use SoftDeletes;
   	public $fillable = [  'id','txn_number',   'customer_id','txn_type','booking_purpose_id','fund_source_id','pancard_no','customer_name',
						'customer_mobile','agent_code','agent_name','is_otp','remit_fees','is_active','document_upload_status','kyc_status',
        'payment_status','tcs','amount_for_tcs','swift_charges','nostro_charge','gst','net_amount','gross_payable','transaction_status','created_by',
        'pancard_relation','pancard_name','expired_date','document_upload_status','kyc_status','kyc_comment','payment_upload_document','payment_comment','customer_reference','dd_number',
        'forward_booking_ref','remitter_address','remitter_city','remitter_country','remitter_email','remitter_mobile','beneficiary_name','beneficiary_address','beneficiary_city','beneficiary_country','beneficiary_ac_number',
        'beneficiary_bank_name','beneficiary_bank_address','beneficiary_bank_sort','beneficiary_swift_code','sub_purpose_code','additional_detail','fb_charges','interm_bank_name','interm_address',
        'interm_bic_code','interm_bank_sort','individual_entity_corporate','razorpay_paymentid','razorpay_orderid','razorpay_signature','p_status',
        'created_at', 'updated_at', 'deleted_at'];
	
	protected $txn = [
        'kyc_status' => 'boolean'
    ];
	
	public function customerData(){
        return $this->hasOne(Customers::class,'id','customer_id');
    }

    public function purposeData(){
        return $this->hasOne(ManagePurposes::class,'id','booking_purpose_id');
    }
	
	public function sourceData(){
        return $this->hasOne(ManageSources::class,'id','fund_source_id');
    }

    public function txnCurrency(){
        return $this->hasMany(TransactionCurrency::class,'txn_id','txn_number');
    }
	
	
}
