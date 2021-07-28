<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Mail;

class MailController extends Controller
{
    public static function notifyOrder()
    {
        $userEmail = Auth::user()->email;
        $details = [
            'title' => 'Thông báo đơn hàng từ BAP',
            'body' => 'Đơn hàng của bạn đang được kiểm duyệt, chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.',
            'userEmail' => $userEmail
        ];

        Mail::send('emails.notifyOrder', $details, function($message) use ($userEmail) {
            $message->to($userEmail)
            ->subject('BAP SHOP thông báo đơn hàng');
            $message->from('testfaifoo@gmail.com','BAP SHOP');
        });
    }
}
