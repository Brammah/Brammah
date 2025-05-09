<?php
namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestController extends Controller
{
    public function __invoke()
    {
        $dataToEncode = "https://bramanjo.com/services";

        $qrCode = QrCode::format('png')
            ->merge('assets/media/logos/favicon-white.png', .3, true)
            ->generate($dataToEncode);

        // Convert the binary QR code to base64
        $qrCodeBase64 = base64_encode($qrCode);

        return view('welcome', [
            'qrCodeBase64' => $qrCodeBase64,
        ]);
    }
}
