<!doctype html>
<html lang="en">

@use('\App\Models\SystemParameter')

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 5px;
        font-size: 11.5px;
    }

    system-info {
        font-size: 11.5px;
        margin-bottom: 7px;
    }

    h4 {
        margin: 0;
    }

    table {
        width: 100%;
        border-spacing: 0;
        border-collapse: collapse;
    }

    table.products {
        font-size: 11.5px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #ddd;
        border-collapse: collapse;
        /* Ensures tighter row spacing */
    }

    table.products th,
    table.products td {
        padding: 3px 4px;
        text-align: right;
    }

    table.products th {
        background-color: #f4f4f4;
        font-weight: bold;
        border-bottom: 2px solid #ddd;
    }

    table.products tbody tr.items {
        background-color: transparent;
        border-bottom: 1px solid #ddd;
        line-height: 1.2;
        /* Reduces row height */
    }

    table.products tfoot tr.items {
        background-color: transparent;
        font-size: 11.5px;
        line-height: 1.2;
        border-bottom: 1px solid #ddd;
        /* Matches tbody */
    }

    table.products tfoot tr.items td {
        padding: 3px 4px;
        border-bottom: 1px solid #ddd;
        /* Ensures consistency with tbody */
    }

    .total {
        text-align: right;
        margin-top: 12px;
        margin-bottom: 12px;
        font-size: 12px;
    }

    .footer {
        width: 100%;
        max-width: 100%;
        background-color: transparent;
        border-radius: 8px;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        font-size: 10px;
        position: fixed;
        bottom: 0;
        left: 0;
        text-align: center;
        box-sizing: border-box;
    }

    .verify-text {
        margin-left: 10px;
        font-size: 10px;
    }

    .notice {
        font-size: 11.5px;
        padding: 1rem;
        text-align: left;
        position: fixed;
        bottom: 100px;
        border-radius: 4px;
    }

    .watermark-text {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        opacity: 0.1;
        font-size: 100px;
        color: #000;
        z-index: -1;
        text-align: center;
        white-space: nowrap;
    }

    .watermark-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.1;
        z-index: -1;
        pointer-events: none;
        object-fit: cover;
    }
</style>

<body>
    <img src="{{ public_path('assets/media/logos/favicon-white.png') }}" class="watermark-image" alt="Watermark">
    <table class="w-full">
        <tr>
            <td class="w-half" style="text-align: left;">
                <img src="{{ public_path('assets/media/logos/favicon-white.png') }}" alt="{{ config('app.name') }}"
                    width="50" />
            </td>

            <td class="w-half" style="text-align: right;">
                <h1>PURCHASE ORDER</h1>
            </td>
        </tr>
    </table>

    <table class="w-full">
        <tr>
            <td class="w-half">
                <div class="system-info" style="text-align: left;">
                    <b>To:</b>
                </div>
                <div class="system-info" style="text-align: left;">
                    TEST INFORMATION
                </div>
                <div class="system-info" style="text-align: left;">
                    TEST INFORMATION
                </div>
                <div class="system-info" style="text-align: left;">
                    TEST INFORMATION
                </div>
                <div class="system-info" style="text-align: left;">
                    TEST INFORMATION
                </div>
                <div class="system-info" style="text-align: left;">
                    TEST INFORMATION
                </div>
            </td>
            <td class="w-half">
                <div>
                    <table>
                        <td class="w-half">
                            <div class="system-info" style="text-align: right;">
                                <b>PO Number:</b>
                            </div>
                            <div class="system-info" style="text-align: right;">
                                <b>PO Date:</b>
                            </div>
                            <div class="system-info" style="text-align: right;">
                                <b>PO Due Date:</b>
                            </div>
                        </td>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <hr />
    <table class="w-full" style="margin-bottom: 8px;margin-top: 8px;">
        <tr>
            <td class="w-half">
                <div class="system-info" style="text-align: left;">
                    Please supply us with the following:
                </div>
            </td>
            <td class="w-half"></td>
        </tr>
    </table>

    <div class="content-wrapper">
        <div class="margin-top">
            <table class="products">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PRODUCT</th>
                        <th>QUANTITY</th>
                        <th>RATE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="items">
                        <td>1</td>
                        <td>Test</td>
                        <td>1</td>
                        <td>2500</td>
                        <td>2500</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="items">
                        <td colspan="3"></td>
                        <td><b>VAT Amount (16%):</b></td>
                        <td><b>12345</b></td>
                    </tr>
                    <tr class="items">
                        <td colspan="3"></td>
                        <td><b>Total:</b></td>
                        <td><b>1234567</b></td>
                    </tr>
                    <tr class="items">
                        <td colspan="5" style="text-align: right;">
                            <b><em>(Total in Words)</em></b>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="total">
            <div style="margin-top: 10px; margin-bottom: 10px; font-size:10.5px;">
                Prepared By: ...BRIAN OCHIENG.
            </div>
            <div style="margin-top: 10px; margin-bottom: 10px; font-size:10.5px;">
                Approved By: ...BRIAN OCHIENG.
            </div>
            <div style="margin-bottom: 20px; font-size:11px;">
                Sign: ..........................................
            </div>
            <div style="margin-bottom: 12px; font-size:11px;">
                Stamp: ..........................................
            </div>
        </div>

        <div class="footer">
            <table class="w-full">
                <tr>
                    <td class="w-half" style="text-align: left;">
                        <table>
                            <tr>
                                <td class="w-half" style="text-align: left;">
                                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Stamp" width="100"
                                        height="100">
                                    <div class="verify-text">
                                        <strong>E Verify</strong> <br>
                                        Scan this QR Code to verify.<br>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="w-half" style="text-align: right; padding-right: 8px;">
                        <div>
                            Bramanjo Enterprises<br>
                            Bramanjo Enterprises<br>
                            Bramanjo Enterprises<br>
                            Bramanjo Enterprises<br>
                            Bramanjo Enterprises<br>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</body>

</html>
