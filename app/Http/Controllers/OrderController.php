<?php

namespace App\Http\Controllers;

use App\Models\Gem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $gems = Gem::get();
        return view('top-up', compact('gems'));
    }

    public function topUp(Request $request)
    {
        DB::transaction(function () use ($request) {
            $gems = Gem::findOrFail($request->gems);
            $order = Auth::user()->orders()->create([
                'gems_id' => $gems->id,
                'invoice' => 'GEMS-' . rand(10000, 99999) . time(),
                'total' => $gems->price_gems,
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id' => $order->invoice,
                    'gross_amount' => $order->total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'item_details' => [
                    [
                        'id' => $gems->id,
                        'price' => $gems->price_gems,
                        'quantity' => 1,
                        'name' => $gems->title,
                    ]
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $order->snap_token = $snapToken;
            $order->save();

            $this->response['invoice'] = $order->invoice;
        });

        return redirect(route('invoice', $this->response['invoice']))->with('success',
            'Thanks! Your Order has been placed. Please Continue to Pay!');
    }

    public function notification()
    {
        $notif = new \Midtrans\Notification();
        DB::transaction(function () use ($notif) {
            $transaction = $notif->transaction_status;
            $paymentType = $notif->payment_type;
            $invoice = $notif->order_id;
            $fraudStatus = $notif->fraud_status;

            $orderPayment = Order::where('invoice', $invoice)->first();
            $gemsAmount = $orderPayment->gem->amount_gems;
            $user = $orderPayment->user;

            if ($transaction == 'capture') {
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $orderPayment->setStatusPending();
                    } else {
                        $user->chargeUserGems($gemsAmount);
                        $orderPayment->setStatusSuccess();
                    }
                }
            } else if ($transaction == 'settlement') {
                $user->chargeUserGems($gemsAmount);
                $orderPayment->setStatusSuccess();
            } else if ($transaction == 'pending') {
                $orderPayment->setStatusPending();
            } else if ($transaction == 'deny') {
                $orderPayment->setStatusFailed();
            } else if ($transaction == 'expire') {
                $orderPayment->setStatusExpired();
            } else if ($transaction == 'cancel') {
                $orderPayment->setStatusFailed();
            }
        });
    }
}
