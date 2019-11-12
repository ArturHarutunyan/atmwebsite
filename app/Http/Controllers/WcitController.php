<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WcitCustomer;
use App\WcitOrder;
use App\WcitDay;
use App\WcitExcursions;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class WcitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordersByDays=array();
        $days=WcitDay::all();
        foreach ($days as $day){
            $dayOrders=new \stdClass();
            $dayOrders->date=$day->date;
            $dayOrders->orders=WcitOrder::where('wcit_day_id',$day->id)->get();
            array_push($ordersByDays,$dayOrders);
        }
        return view('admin.wcit.index')->with('days',$ordersByDays);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(false) {
            $customer_data = $request->json('contacts');
            $orders = $request->json('readyOrders');
            $participation = $request->json('participation');
            $participation_type = null;
            $msg = '';
            switch ($participation) {
                case '1':
                    $participation_type = 'Delegation';
                    break;
                case '2':
                    $participation_type = 'Attendee';
                    break;
                case '3':
                    $participation_type = 'Speaker';
                    break;
                default:
                    $participation_type = null;

            }
            $customer = WcitCustomer::create([
                'name' => $customer_data["name"],
                'surname' => $customer_data["Surname"],
                'phone' => $customer_data["Phone"],
                'email' => $customer_data["Email"],
                'organization' => $customer_data["Organization"],
                'notes' => $customer_data["Notes"],
                'participation_type' => $participation_type
            ]);

            $msg .= ('Customer: ' . $customer_data["name"] . ' ' . $customer_data["Surname"] . "</br>");
            $msg .= ('Email: ' . $customer_data["Email"] . "</br>");
            $msg .= ('Phone: ' . $customer_data["Phone"] . "</br>");
            $msg .= ('Organization: ' . $customer_data["Organization"] . "</br>");
            $msg .= ('Notes: ' . $customer_data["Notes"] . "</br>");

            foreach ($orders as $order) {
                $day_date = $order["date"] / 1000;
                $day = WcitDay::where('date', $day_date)->first();
                $price = 0;
                $excursion = WcitExcursions::find($order["tourId"]);

                if ($order["type"] == '1') {
                    //Individual
                    $price = $order["persons"] * $excursion->private_price_amd;
                    $msg .= ("Type: Individual </br>");
                } elseif ($order["type"] == '2') {
                    //Group Type
                    $price = $order["persons"] * $excursion->group_price_amd;
                    $msg .= ("Type: Group </br>");
                }
                WcitOrder::create([
                    'wcit_customer_id' => $customer->id,
                    'wcit_excursion_id' => $order["tourId"],
                    'wcit_day_id' => $day->id,
                    'excursion_type_id' => $order["type"],
                    'tour_language_id' => $order["language"],
                    'people_count' => $order["persons"],
                    'price' => $price
                ]);
                $t_language = ($order['language'] == 1 ? 'English' : 'Russian');
                $msg .= ('Day: October' . ($day->id + 4) . "th </br>");
                $msg .= ('Excursion: ' . $excursion->name . "</br>");
                $msg .= ('Tour Language: ' . $t_language . "</br>");
                $msg .= ('People quantity: ' . $order["persons"] . "</br>");
                $msg .= ('Price: AMD' . $price . "</br>");
            }
        }
        $mail = new PHPMailer(true);
        try {
            $mail->IsSMTP();
            $mail->CharSet = "utf-8";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 465;   // set the SMTP port for the GMAIL server
            $mail->Username   = "admin@epic.study";  // username
            $mail->Password   = "dir.!!2266";            // password
            //$mail->setFrom($customer_data["Email"], "Client");
            $mail->setFrom('vardan9811@mail.ru', "Client");
            $mail->Subject = "WCIT Excursion";
            $mail->IsHTML(true);
            //$mail->MsgHTML($msg);
            
            $mail->MsgHTML($msg);
            $mail->AddAddress("soft@armeniatravel.am");
            //$mail->AddAddress("vardan9817@gmail.com");
            //$mail->AddAddress("mar.armenie@gmail.com");
            $mail->AddAddress("hakob.kpryan@armeniatravel.am");
            $mail->AddAddress("armen@armeniatravel.am");
            $mail->Send();
        } catch (Exception $e) {
            dd($e);
        }

        return response()->json('1');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
