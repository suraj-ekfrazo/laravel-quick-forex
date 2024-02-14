<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionKyc extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [  'id','txn_link_no', 'passport','passport_status','passport_comment','visa','visa_status','visa_comment','ticket','ticket_status','ticket_comment','pan_card','pan_card_status','pan_card_comment','university_letter',
        'university_letter_status','university_letter_comment','employment_letter','emp_letter_status','emp_letter_comment','offer_letter','offer_letter_status',
        'offer_letter_comment','medical_letter','medical_letter_status','medical_letter_comment','other','other_status','other_comment','a2form','a2form_status','a2form_comment','fema_declaration','fema_declaration_status','fema_declaration_comment',
        'valid_gic_letter', 'valid_gic_letter_status', 'valid_gic_letter_comment',
        'gst_of_remitter', 'gst_of_remitter_status', 'gst_of_remitter_comment',
        'participant_list_of_passengers','participant_list_of_passengers_status','participant_list_of_passengers_comment',
        'passenger_pan','passenger_pan_status','passenger_pan_comment',
        'passenger_passport','passenger_passport_status','passenger_passport_comment',
        'beneficiary_invoice','beneficiary_invoice_status','beneficiary_invoice_comment',
        'tcs_declaration','tcs_declaration_status','tcs_declaration_comment',
        'ticket_copy','ticket_copy_status','ticket_copy_comment',
        'certificate_of_registration_of_haj_group','certificate_of_registration_of_haj_group_status','certificate_of_registration_of_haj_group_comment',
        'employemnt_letter_or_visa_confirmation_letter','employemnt_letter_or_visa_confirmation_letter_status','employemnt_letter_or_visa_confirmation_letter_comment',
        'sponsor_letter_from_corporate','sponsor_letter_from_corporate_status','sponsor_letter_from_corporate_comment',
        'Sponsorship_company_gst','Sponsorship_company_gst_status','Sponsorship_company_gst_comment',
        'sponsorship_company_pan','sponsorship_company_pan_status','sponsorship_company_pan_comment',
        'letter_from_overseas_hospital','Letter_from_overseas_hospital_status','Letter_from_overseas_hospital_comment',
        'agreement_of_overseas_parties','agreement_of_overseas_parties_status','agreement_of_overseas_parties_comment',
        'invoices_relating_expenses','invoices_relating_expenses_status','invoices_relating_expenses_comment',
        'form_15ca','form_15ca_status','form_15ca_comment',
        'form_15cb','form_15cb_status','form_15cb_comment',
        'producer_pan','producer_pan_status','producer_pan_comment',
        'producer_passport_aadhar','producer_passport_aadhar_status','producer_passport_aadhar_comment',
        'itr','itr_status','itr_comment',
        'beneficiary_passport','beneficiary_passport_status','beneficiary_passport_comment',
        'invoice','invoice_status','invoice_comment',
        'corporate_kyc','corporate_kyc_status','corporate_kyc_comment',
        'created_at', 'updated_at', 'deleted_at'];
}
