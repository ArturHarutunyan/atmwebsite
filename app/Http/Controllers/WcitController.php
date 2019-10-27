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
            $msg = '    <table style="
        
            max-width: 800px;
            
            width: 100%;
            margin: auto;
            box-shadow: 2px 2px 7px 1px #80808080;
            
            color: #697384;
        ">

        <tbody style="width: 100%; font-family: Roboto,Helvetica,Arial,sans-serif;">


            <tr>
                <td>
                    <div style="
                        min-width: 100%;
                        min-height: 300px;
                        background: url(https://www.armeniatravel.am/uploads/Capture2.JPG);
                        
                        background-size:cover;
                        background-position: center;
                        
                        "></div>
                </td>



            </tr>

            <tr>
                <td>
                    <div style="
                        margin-left: 21%;
                        margin-top: -46.5px;
    
                    "><a href="#" style="
                    
                        background-color: #F5A65B;
                        display: inline-block;
                        text-decoration: none;
                        padding: 12px 45px;
                        color: #ffffff;

                        font-weight: bold;

    
                    ">RSVP</a></div>
                </td>
            </tr>
            <tr colspan="100%">
                <td>
                    <table style="
                        width: 100%;
                        max-width: 500px;
                        margin: auto;
                    ">
                        <tbody style="width: 100%;">
                            <tr style="width: 100%;">
                                <td colspan="100%" style="    border-bottom: 25px solid transparent;">

                                    <p style="
                                        border-bottom: 1px solid gray;
                                        padding-bottom: 30px;
                                        padding-top: 30px;
                                        text-align: center;
                                    ">LIEBE TIM & ROSA! WIR HEIRATEN</p>

                                </td>
                            </tr>
                            <tr style="
                                vertical-align: baseline;
                            ">
                                <td width="33%" style="text-align: center;">

                                    <div style="
                                    
                                        border-radius: 50%;
                                        box-shadow: 2px 2px 7px 1px #80808080;
                                        height: 100px;
                                        width: 100px;
                                        margin: auto;
                                        display: flex;
                                        zoom: .8;
                                        justify-content: center;
                                    ">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; fill: #697384;"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                                            y="0px" viewBox="0 0 302.4 302.4"
                                            style="enable-background:new 0 0 302.4 302.4;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0 {
                                                    stroke: #697384;
                                                    stroke-width: 6;
                                                    stroke-miterlimit: 10;
                                                }
                                            </style>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M204.8,97.6C191.2,84,172,75.2,151.2,75.2s-40,8.4-53.6,22.4c-13.6,13.6-22.4,32.8-22.4,53.6    s8.8,40,22.4,53.6c13.6,13.6,32.8,22.4,53.6,22.4s40-8.4,53.6-22.4c13.6-13.6,22.4-32.8,22.4-53.6S218.8,111.2,204.8,97.6z     M190.4,190.4c-10,10-24,16-39.2,16s-29.2-6-39.2-16s-16-24-16-39.2s6-29.2,16-39.2s24-16,39.2-16s29.2,6,39.2,16s16,24,16,39.2    S200.4,180.4,190.4,190.4z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M292,140.8h-30.8c-5.6,0-10.4,4.8-10.4,10.4c0,5.6,4.8,10.4,10.4,10.4H292c5.6,0,10.4-4.8,10.4-10.4    S297.6,140.8,292,140.8z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M151.2,250.8c-5.6,0-10.4,4.8-10.4,10.4V292c0,5.6,4.8,10.4,10.4,10.4c5.6,0,10.4-4.8,10.4-10.4v-30.8    C161.6,255.6,156.8,250.8,151.2,250.8z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M258,243.6l-22-22c-3.6-4-10.4-4-14.4,0s-4,10.4,0,14.4l22,22c4,4,10.4,4,14.4,0S262,247.6,258,243.6z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M151.2,0c-5.6,0-10.4,4.8-10.4,10.4v30.8c0,5.6,4.8,10.4,10.4,10.4c5.6,0,10.4-4.8,10.4-10.4V10.4    C161.6,4.8,156.8,0,151.2,0z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M258.4,44.4c-4-4-10.4-4-14.4,0l-22,22c-4,4-4,10.4,0,14.4c3.6,4,10.4,4,14.4,0l22-22    C262.4,54.8,262.4,48.4,258.4,44.4z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M41.2,140.8H10.4c-5.6,0-10.4,4.8-10.4,10.4s4.4,10.4,10.4,10.4h30.8c5.6,0,10.4-4.8,10.4-10.4    S46.8,140.8,41.2,140.8z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M80.4,221.6c-3.6-4-10.4-4-14.4,0l-22,22c-4,4-4,10.4,0,14.4s10.4,4,14.4,0l22-22    C84.4,232,84.4,225.6,80.4,221.6z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0"
                                                        d="M80.4,66.4l-22-22c-4-4-10.4-4-14.4,0s-4,10.4,0,14.4l22,22c4,4,10.4,4,14.4,0S84.4,70.4,80.4,66.4z" />
                                                </g>
                                            </g>
                                        </svg>

                                    </div>
                                    <p>ANDREAS & DARIAN</p>

                                </td>
                                <td width="33%" style="text-align: center;">

                                    <div style="
                                    
                                    border-radius: 50%;
                                    box-shadow: 2px 2px 7px 1px #80808080;
                                    height: 100px;
                                    width: 100px;
                                    zoom: .8;
                                    display: flex;
                                        justify-content: center;
                                    margin: auto;
                                ">
                                        <svg style="
                                            width: 30px;
                                            fill: #697384;
                                        " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 294 294"
                                            style="enable-background:new 0 0 294 294;" xml:space="preserve">
                                            <path
                                                d="M279,132h-18.988c-6.718-50.886-47.345-91.294-98.345-98.012V15c0-8.284-6.716-15-15-15s-15,6.716-15,15v18.988  c-51,6.718-90.961,47.126-97.679,98.012H15c-8.284,0-15,6.716-15,15s6.716,15,15,15h18.988  c6.718,50.886,46.679,91.294,97.679,98.012V279c0,8.284,6.716,15,15,15s15-6.716,15-15v-18.988  c51-6.718,91.627-47.126,98.345-98.012H279c8.284,0,15-6.716,15-15S287.284,132,279,132z M161.667,229.632V213  c0-8.284-6.716-15-15-15s-15,6.716-15,15v16.632c-34-6.214-61.085-33.321-67.299-67.632H81c8.284,0,15-6.716,15-15s-6.716-15-15-15  H64.368c6.214-34.31,33.299-61.418,67.299-67.632V81c0,8.284,6.716,15,15,15s15-6.716,15-15V64.368  c35,6.214,61.751,33.322,67.965,67.632H213c-8.284,0-15,6.716-15,15s6.716,15,15,15h16.632  C223.418,196.31,196.667,223.418,161.667,229.632z" />
                                            <g>
                                        </svg>

                                    </div>
                                    <p>TETTUCIO SPA MONTECATINI TERME ITALY</p>

                                </td>
                                <td width="33%" style="text-align: center;">

                                    <div style="
                                    
                                        border-radius: 50%;
                                        box-shadow: 2px 2px 7px 1px #80808080;
                                        height: 100px;
                                        width: 100px;
                                        display: flex;
                                        justify-content: center;
                                        zoom: .8;
                                        margin: auto;
                                    ">

                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:30px;
                                            fill:#697384;
                                        " xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                                            y="0px" width="97.16px" height="97.16px" viewBox="0 0 97.16 97.16"
                                            style="enable-background:new 0 0 97.16 97.16;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z" />
                                                    <path
                                                        d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z" />
                                                </g>
                                        </svg>
                                    </div>
                                    <p>5.SEPTEMBER 2020</p>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td style="border-top:70px solid transparent ">
                    <table style="width: 100%; 
                    background: #F5F5F5; ">
                        <tbody>
                            <tr>
                                <td style="
                                    width: 50%;
                                    vertical-align: baseline;
                                ">
                                    <div style="
                                            background: url(https://www.armeniatravel.am/uploads/Capture.JPG);
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            min-height: 310px;
                                        "></div>

                                </td>
                                <td style="
                                    padding: 30px;
                                    line-height: 35px;

                                    vertical-align: top;
                                    ">
                                    <p style="margin: 0; padding: 0;">
                                        <svg style="width: 12px; color:#C3D0E3" aria-hidden="true" focusable="false"
                                            data-prefix="fad" data-icon="quote-left" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                            class="svg-inline--fa fa-quote-left fa-w-16 fa-2x">
                                            <g class="fa-group">
                                                <path fill="currentColor"
                                                    d="M464 256h-80v-64a64.06 64.06 0 0 1 64-64h8a23.94 23.94 0 0 0 24-23.88V56a23.94 23.94 0 0 0-23.88-24H448a160 160 0 0 0-160 160v240a48 48 0 0 0 48 48h128a48 48 0 0 0 48-48V304a48 48 0 0 0-48-48z"
                                                    class="fa-secondary"></path>
                                                <path fill="currentColor"
                                                    d="M176 256H96v-64a64.06 64.06 0 0 1 64-64h8a23.94 23.94 0 0 0 24-23.88V56a23.94 23.94 0 0 0-23.88-24H160A160 160 0 0 0 0 192v240a48 48 0 0 0 48 48h128a48 48 0 0 0 48-48V304a48 48 0 0 0-48-48z"
                                                    class="fa-primary"></path>
                                            </g>
                                        </svg>
                                        <span style="font-weight: bold;">DAS EINFANGEN EINES</span></p>
                                    <span style="margin: 0; padding: 0; font-weight: bold;">BRAUTINGAMS IST IN</span>
                                    <span style="margin: 0; padding: 0; font-weight: bold;">ITALIEN EIN</span>
                                    <span style="margin: 0; padding: 0; font-weight: bold;">NATIONALSPORT , BEI
                                        DEM</span>
                                    <span style="margin: 0; padding: 0; font-weight: bold;">DIE GANZE
                                        FAMILE MITWIRKT.
                                    </span>

                                    <div style="border-top: 1px solid  #697384; width:40px; margin: 10px 0;"></div>
                                    <span style="font-size: 14px;">Marcello Mastroianni</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>';
            $mail->MsgHTML($msg);
            $mail->AddAddress("soft@armeniatravel.am");
            $mail->AddAddress("vardan9817@gmail.com");
            $mail->AddAddress("mar.armenie@gmail.com");
            //$mail->AddAddress("hakob.kpryan@armeniatravel.am");
            //$mail->AddAddress("armen@armeniatravel.am");
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
