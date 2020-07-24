<?php


namespace App\Http\Controllers\Middle\Admin\QRCode;


use App\Http\Controllers\Controller;
use App\Services\QRCode\QRcode;

class QRCodeController extends Controller
{
    public function show()
    {
        $qr = new QRcode();
        $qr->frame = $qr::LVL_FRAME_HUGE;
        $qr->target = "http://www.google.com";
        $qr->logo = "https://ressources.blogdumoderateur.com/2013/10/google-logo.png";
        $qr->output();

//        return view('admin.middle.account.qrcode.admin_middle_qrcode_show', [
//
//        ]);
    }
}
