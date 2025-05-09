<!doctype html>
<html lang="en">

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
        margin: 0;
    }

    h4 {
        margin: 0;
    }

    .w-full {
        width: 100%;
    }

    .w-three-quarter {
        width: 75%;
    }

    .w-half {
        width: 50%;
    }

    .w-quarter {
        width: 25%;
    }

    .margin-top {
        margin-top: 1.25rem;
    }

    .margin-bottom {
        margin-bottom: 4px;
    }

    .footer {
        font-size: 10px;
        padding: 1rem;
        text-align: left;
        position: fixed;
        bottom: 0;
    }

    .notice {
        font-size: 8.5px;
        padding: 1rem;
        text-align: left;
        position: fixed;
        bottom: 100px;
        border-radius: 4px;
    }

    table {
        width: 100%;
        border-spacing: 0;
    }

    table.products {
        font-size: 8px;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 4px;
        overflow: hidden;
    }

    table.products th {
        background-color: #d3d3d3;
        padding: 0.5rem;
        text-align: left;
        font-weight: bold;
    }

    table.products tr {
        background-color: #166dbe;
    }

    table.products td {
        padding-left: 8px;
        padding-bottom: 4px;
        font-size: 8.75px;
    }

    table.products th {
        color: #000000;
        padding: 0.5rem;
        text-align: left;
    }

    table.products tfoot {
        color: #ffffff;
        padding: 0.5rem;
        text-align: left;
    }

    table tr.items {
        background-color: rgb(241 245 249);
    }

    table tr.items td {
        padding-left: 8px;
        padding-bottom: 4px;
        font-size: 8.75px;
    }

    .table-warning {
        background-color: #ffc107 !important;
    }

    .total {
        text-align: left;
        margin-top: 12px;
        margin-bottom: 12px;
        font-size: 10px;
    }

    .text-items {
        padding: 1px;
        font-size: 10px;
    }

    .system-info {
        padding: 1px;
        font-size: 12px;
        text-align: right;
    }

    .recipient-info {
        padding: 1px;
        font-size: 11px;
        text-align: left;
    }

    .standard-font {
        font-size: 0.875rem;
        margin-top: 4px;
        font-family: "Roboto";
    }

    .content-wrapper {
        flex: 1;
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
        transform: scale(-1, 1);
    }
</style>

<body>
    <img src="{{ public_path('assets/media/logos/efil-flag.png') }}" class="watermark-image" alt="Watermark">

    <table class="w-full margin-top">
        <tr>
            <td class="w-half" style="text-align: left;">
                <img src="{{ public_path('assets/media/logos/logo.png') }}" alt="{{ config('app.name') }}"
                    width="150" />

            </td>

            <td class="w-half" style="text-align: right;">
                <h1>DELIVERY NOTE</h1>
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
                    {{ $data['customerName'] }}
                </div>
                <div class="system-info" style="text-align: left;">
                    {{ $data['customerAddress'] }}
                </div>
                <div class="system-info" style="text-align: left;">
                    {{ $data['customerPhone'] }}
                </div>
                <div class="system-info" style="text-align: left;">
                    {{ $data['customerEmail'] }}
                </div>
            </td>
            <td class="w-half">
                <div>
                    <table>
                        <td class="w-half">
                            <div class="system-info" style="text-align: right;">
                                <b>D.Note Date:</b> {{ $data['deliveryNoteDate'] }}
                            </div>
                            <div class="system-info" style="text-align: right;">
                                <b>D.Note Number:</b> {{ $data['deliveryNoteNumber'] }}
                            </div>
                            @if ($data['jobCardNumber'])
                                <div class="system-info" style="text-align: right;">
                                    <b>Job Card No:</b> {{ $data['jobCardNumber'] }}
                                </div>
                            @endif
                            @if ($data['isQuotation'])
                                <div class="system-info" style="text-align: right;">
                                    <b>Quotation No:</b> {{ $data['quotationNumber'] }}
                                </div>
                            @endif
                            @if ($data['isCashSale'])
                                <div class="system-info" style="text-align: right;">
                                    <b>Sale No:</b> {{ $data['saleNumber'] }}
                                </div>
                            @endif
                            <div class="system-info" style="text-align: right;">
                                <b>Customer LPO No:</b> {{ $data['customerLpoNumber'] }}
                            </div>
                        </td>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <hr />
    <table class="w-full">
        <tr>
            <td class="w-half">
                <div class="system-info" style="text-align: left;">
                    <p>Dear Sir/Madam</p>
                    <p>Please acknowledge the receipt of the following item(s)</p>
                </div>
            </td>
        </tr>
    </table>

    <div class="content-wrapper">
        <div class="margin-top">
            <table class="products">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PART NUMBER</th>
                        <th>PRODUCT</th>
                        <th>QUANTITY</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['items'] as $index => $item)
                        <tr class="items">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['part_number'] }}</td>
                            <td>{{ strtoupper($item['name']) }}</td>
                            <td>{{ number_format($item['quantity']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total">
            <p>Comments: {{ $data['customerLpoNumber'] }}</p>
        </div>

        <div class="total">
            <table class="w-full margin-top">
                <tr>
                    <td class="w-full">
                        <div>
                            <table>
                                <tr>
                                    <td class="w-half">
                                        <div class="text-items">
                                            <p>Customer's Signature: ...............................</p>
                                        </div>
                                    </td>
                                    <td class="w-half">
                                        <div class="text-items" style="text-align: right;">
                                            <p>Authorized Signatory : ...............................</p>
                                            <p>For <b>{{ env('APP_NAME') }}</b></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="total">
            <p>Collected By: {{ $data['collectorInformation'] }}</p>
        </div>

        @include('pdf-footer')
    </div>
</body>

</html>
