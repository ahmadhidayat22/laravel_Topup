<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\transaction;
use App\Traits\CodeGenerate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MidtransController extends Controller
{
    use CodeGenerate;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // return Auth::user();
        $id_user = Auth::user()->id;

        $jumlah = $request->ammount;
        $ammount = str_replace('.', '', $jumlah);
        $username = env('MIDTRANS_SERVER_KEY');
        $midtrans_auth = $username . ':';
        $code = $this->getCode();
        $header = array(
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($midtrans_auth)
        );
        $bank = $request->bank;
        $type = "";

        if ($bank == 'bca' || $bank == 'bni' || $bank == 'bri' || $bank == 'cimb') {
            $type = 'bank_transfer';
        }


        $transaction = array(
            'order_id' => $code,
            'gross_amount' => $ammount,

        );
        $payment_type = $type;
        $bank_transfer = array(
            'bank' => $bank
        );

        $transaction_data = array(
            'payment_type' => $payment_type,
            'transaction_details' => $transaction,
            'bank_transfer' => $bank_transfer,

        );
        $additional_data = array(
            'user_id' => $id_user,
            'payment_type' => $request->type,
            'transaction_sku' => '-',
            'transaction_number' => '-',
        );



        $response = Http::withHeaders($header)->post('https://api.sandbox.midtrans.com/v2/charge', $transaction_data);

        $data = json_decode($response->getBody(), true);
        // dd($data);
        $this->store($data, $additional_data);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request, $additional_data)
    {
        // dd($request);

        if (isset($request['va_numbers'])) {
            $bank = $request['va_numbers'][0]['bank'];
        } else {
            $bank = $request['payment_type'];
        }

        if (isset($request['va_numbers'])) {
            $va_number = $request['va_numbers'][0]['va_number'];
            $qrcode = '-';
            $deeplink = '-';
        } else if (isset($request["actions"])) {
            $va_number = '-';
            $qrcode = $request["actions"][0]['url'];
            $deeplink = $request["actions"][1]['url'];
        } else if (isset($request['permata_va_number'])) {
            $va_number = $request["permata_va_number"];
            $qrcode = '-';
            $deeplink = '-';
        } else if (isset($request['payment_type']) == 'echannel') {
            $va_number = $request['biller_code'] . $request['bill_key'];
            $qrcode = '-';
            $deeplink = '-';
        }

        $data = [
            'transaction_date'    => Carbon::now(),
            'transaction_time'    => $request['transaction_time'],
            'transaction_code'    => $request['order_id'],
            'transaction_total'   => $request['gross_amount'],
            'transaction_status'  => $request['transaction_status'],
            'transaction_method'  => $request['payment_type'],
            'bank'                => $bank,
            'va_number'           => $va_number,
            'qr_code'             => $qrcode,
            'deeplink_redirect'   => $deeplink,
            'transaction_type'    => $additional_data['payment_type'],
            'transaction_user_id' => $additional_data['user_id'],
            'transaction_expired' => $request['expiry_time'],
            'transaction_sku'     => $additional_data['transaction_sku'],
            'transaction_number'  => $additional_data['transaction_number'],

        ];


        transaction::create($data, [], [
            'transaction_code',
            'transaction_total',
            'transaction_status',
            'transaction_method',
            'transaction_date',
            'transaction_time',
            'transaction_user_id',
            'transaction_type',
            'bank',
            'va_number',
            'transaction_expired'
        ]);
    }

    public function midtrans_hook(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $status = '';
            if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                $status = 'success';

                if (!$request->custom_field1 == 'Top up') {

                    $id = transaction::where('transaction_code', $request->order_id)->select('transaction_user_id')->first();
                    $saldo = User::where('id', $id->transaction_user_id)->select('saldo')->first();
                    $saldo = $saldo->saldo + (int)$request->gross_amount;

                    User::where('id', $id->transaction_user_id)->update([
                        'saldo' => $saldo
                    ]);
                }
            } else {
                $status = $request->transaction_status;
            }
            transaction::where('transaction_code', $request->order_id)->update([
                'transaction_status' => $status
            ]);
        }
        return response()->json([
            'message' => 'sukses'
        ]);

        // $result = file_get_contents('php://input');
        // $data = json_decode($result , true);

        // return response()->json($data);
        // $this->update_payment($data);

    }

    public function update_payment($data)
    {
        // dd($data);
        $status = "";
        if ($data['transaction_status'] == "settlement" || $data['transaction_status'] == "capture") {
            $status = 'success';
        } else {
            $status = $data['transaction_status'];
        }

        transaction::where('transaction_code', $data['order_id'])->update([
            'transaction_status' => $status

        ]);

        return response()->json([
            'message' => 'sukses'
        ]);
        // dd($data);
    }

    public function topUp(Request $request)
    {
        // return $request;
        $username = env('MIDTRANS_SERVER_KEY');
        $midtrans_auth = $username . ':';
        $code = $this->getCode();
        $header = array(
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($midtrans_auth)
        );


        $id = $request->id;
        $server = $request->zone_id ? $request->zone_id : null;

        $id_user = Auth::user() ? Auth::user()->id : null;
        $SN = $request->serialNumber;
        $sku = $request->denom;
        $productName = $request->produk;
        $productDetail = $request->productDetail;


        $ammount = $request->harga;

        $bank = $request->payment;
        $type = "";

        if ($bank == 'bca' || $bank == 'bni' || $bank == 'bri' || $bank == 'cimb') {
            $type = 'bank_transfer';
        } else if ($bank == 'mandiri') {
            $type = 'echannel';
        } else if ($bank == 'permata') {
            $type = 'permata';
        } else if ($bank == 'dana' || $bank == 'ovo' || $bank == 'gopay' || $bank == 'shoopepay') {
            $type = 'gopay';
        }


        $transaction = array(
            'order_id' => $code,
            'gross_amount' => $ammount,

        );
        $payment_type = $type;
        $bank_transfer = array(
            'bank' => $bank
        );
        

        $transaction_data = array(
            'payment_type' => $payment_type,
            'transaction_details' => $transaction,
            'custom_field1' => "Top up"

        );

        if ($type == 'bank_transfer') {

            $transaction_data = array(
                'payment_type' => $payment_type,
                'transaction_details' => $transaction,
                'bank_transfer' => $bank_transfer,
                'custom_field1' => "Top up"
            );
        } else if ($type == 'echannel') {
            $bank_transfer = array(
                'bill_info1' => $productName,
                'bill_info2' => $productDetail
            );

            $transaction_data = array(
                'payment_type' => $payment_type,
                'transaction_details' => $transaction,
                'echannel' => $bank_transfer,
                'custom_field1' => "Top up"
            );
        }



        $additional_data = array(
            'user_id' => $id_user,
            'transaction_sku' => $sku,
            'transaction_number' => $SN,
            'payment_type' => 'top up'
        );
        // dd($transaction_data); 
        // // return $transaction_data;

        $response = Http::withHeaders($header)->post('https://api.sandbox.midtrans.com/v2/charge', $transaction_data);
        $test = [
            "status_code" => "201",
            "status_message" => "GoPay transaction is created",
            "transaction_id" => "ab6fa285-4983-49b9-94e6-2f8abf0e64e9",
            "order_id" => "PS-240113000000126",
            "merchant_id" => "G179890270",
            "gross_amount" => "5000.00",
            "currency" => "IDR",
            "payment_type" => "gopay",
            "transaction_time" => "2024-01-13 17:51:40",
            "transaction_status" => "pending",
            "fraud_status" => "accept",
            "actions" => [
                [
                    "name" => "generate-qr-code",
                    "method" => "GET",
                    "url" => "https://api.sandbox.midtrans.com/v2/gopay/ab6fa285-4983-49b9-94e6-2f8abf0e64e9/qr-code"
                ],
                [
                    "name" => "deeplink-redirect",
                    "method" => "GET",
                    "url" => "https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=f87fd121-8b00-47dc-ac5a-22801064f216"
                ],
                [
                    "name" => "get-status",
                    "method" => "GET",
                    "url" => "https://api.sandbox.midtrans.com/v2/ab6fa285-4983-49b9-94e6-2f8abf0e64e9/status"
                ],
                [
                    "name" => "cancel",
                    "method" => "POST",
                    "url" => "https://api.sandbox.midtrans.com/v2/ab6fa285-4983-49b9-94e6-2f8abf0e64e9/cancel"
                ],
            ],
            "expiry_time" => "2024-01-13 18:06:40"
        ];

        $data = json_decode($response->getBody(), true);
        // dd($test["actions"][0]['url']);
        // dd($data);
        if ($data['status_code'] == 200 || $data['status_code'] == 201) {

            $this->store($data, $additional_data);
        }
        return response()->json($data);
    }
}
