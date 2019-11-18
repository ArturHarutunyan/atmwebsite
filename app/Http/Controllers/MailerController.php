<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use App\CustomMetaTag;
use App\Partner;
use Illuminate\Support\Facades\Session;

class MailerController extends Controller
{
    //contact form
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $mail = new PHPMailer;
        try {
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port = 465;   // set the SMTP port for the GMAIL server
            $mail->Username = "admin@epic.study";  // username
            $mail->Password = "dir.!!2266";            // password

            $mail->setFrom($request->email, $request->email);

            $mail->Subject = "Armenia travel site contact form submited";
            $mail->IsHTML(true);
            $mail->MsgHTML('email from armenia travel contact form.
<br> name - ' . $request->name . '
<br> email - ' . $request->email . '
<br> subject - ' . $request->subject . '
<br> message - ' . $request->message);

            $address = "incoming@armeniatravel.am";
            $mail->addAddress($address, "ATM Staff");
            if(!$mail->Send()) {
                session(['success_message' => '']);
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            $s_m='Your email was successfully sent!';
            return redirect()->back()->with('success_message', $s_m);

        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function send_hotel_request(Request $request){
        $status=new \stdClass;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'hotel' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $status->errors=$validator->errors()->all();
        $status->code=0;
        $status->message='';
        if ($validator->fails()) {
            return json_encode($status);
        }
        $mail = new PHPMailer;
        try {
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port = 465;   // set the SMTP port for the GMAIL server
            $mail->Username = "admin@epic.study";  // username
            $mail->Password = "dir.!!2266";            // password

            $mail->setFrom($request->email, $request->subject);

            $mail->Subject = "Armenia travel site contact form submited";
            $mail->IsHTML(true);
            $mail->MsgHTML('email from armenia travel contact form.
<br> name - ' . $request->name . '
<br> email - ' . $request->email . '
<br> hotel - ' . $request->hotel . '
<br> adults - ' . $request->adults . '
<br> children - ' . $request->children . '
<br> start date - ' . $request->start_date . '
<br> end date - ' . $request->end_date . '
<br> subject - ' . $request->subject . '
<br> message - ' . $request->message);

            $address = "incoming@armeniatravel.am";
            $mail->addAddress($address, "ATM Staff");
            $status->errors='';
            if(!$mail->Send()) {
                $status->code=0;
                $status->message='The email failed to send!';
            }
            else{
                $status->code=1;
                $status->message='Your email was successfully sent!';
            }
            return json_encode($status);

        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function send_your_own_tour_request(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'dates' => 'required',
            'number_of_people' => 'required',
            'type' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $mail = new PHPMailer;
        try {
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port = 465;   // set the SMTP port for the GMAIL server
            $mail->Username = "admin@epic.study";  // username
            $mail->Password = "dir.!!2266"; // password

            $mail->setFrom($request->email, 'New tour proposal');

            $mail->Subject = "Armenia travel site contact form submited";
            $mail->IsHTML(true);
            $mail->MsgHTML('email from armenia travel contact form.
<br> name - ' . $request->name . '
<br> email - ' . $request->email . '
<br> dates - ' . $request->dates . '
<br> number of people - ' . $request->number_of_people . '
<br> message - ' . $request->message);

            $address = "incoming@armeniatravel.am";
            $mail->addAddress($address, "ATM Staff");
            if(!$mail->Send()) {
                session(['success_message' => '']);
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            $s_m='Your email was successfully sent!';
            return redirect()->back()->with('success_message', $s_m);

        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
