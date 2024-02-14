<?php
use Illuminate\Support\Facades\Mail;


function sendEmail($data , $subject,$page)
{
    Mail::send($page, $data, function ($message) use ($subject,$data) {
        $message->to($data['email'], $data['name'])->subject($subject);
        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    });
}



function addDaysSkipWeekend($timestamp, $days, $skipdays = array("Saturday", "Sunday"), $skipdates = array())
{
    // $skipdays: array (Monday-Sunday) eg. array("Saturday","Sunday")
    // $skipdates: array (YYYY-mm-dd) eg. array("2012-05-02","2015-08-01");
    //timestamp is strtotime of ur $startDate
    $i = 1;
    // dd($skipdates);
    while ($days >= $i) {
        $timestamp = strtotime("+1 day", $timestamp);
        if ((in_array(date("l", $timestamp), $skipdays)) || (in_array(date("Y-m-d", $timestamp), $skipdates))) {
            $days++;
        }
        $i++;
    }

    //return $timestamp;
    return date("Y-m-d", $timestamp);
}

