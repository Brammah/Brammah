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
            text-align: right;
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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(0deg);
            opacity: 0.1;
            z-index: -1;
            width: 400px;
            height: auto;
            pointer-events: none;
        }
    </style>

    <body>
        {{-- <div class="watermark-text">{{ config('app.name') }}</div> --}}
        <img src="{{ public_path('assets/media/logos/logo.png') }}" class="watermark-image" alt="Watermark">

        <table class="w-full margin-top">
            <tr>
                <td class="w-half" style="text-align: left;">
                    <h1>QUOTATION</h1>
                </td>

                <td class="w-half" style="text-align: right;">
                    <img src="{{ public_path('assets/media/logos/logo.png') }}" alt="{{ config('app.name') }}"
                        width="150" />
                </td>
            </tr>
        </table>
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div class="system-info" style="text-align: left;">
                        <b>Customer:</b> {{ $data['customerName'] }}
                    </div>
                    <div class="system-info" style="text-align: left;">
                        <b>Job Card No:</b> {{ $data['jobCardNumber'] }}
                    </div>
                    <div class="system-info" style="text-align: left;">
                        <b>Job Inspection No:</b> {{ $data['jobinspectionNumber'] }}
                    </div>
                    <div class="system-info" style="text-align: left;">
                        <b>Quotation No:</b> {{ $data['quotationNumber'] }}
                    </div>
                    <div class="system-info" style="text-align: left;">
                        <b>Date:</b> {{ $data['quotationDate'] }}
                    </div>
                </td>
                <td class="w-half">
                    <div>
                        <table>
                            <td class="w-half">
                                <div class="system-info" style="text-align: right;">info@easyfuelinjectors.com,</div>
                                <div class="system-info" style="text-align: right;">
                                    P.O BOX 78518-00507,
                                </div>
                                <div class="system-info" style="text-align: right;">
                                    Runyenjes Road, Industrial Area, Nairobi, Kenya.
                                </div>
                                <div class="system-info" style="text-align: right;">
                                    <b>PIN:</b> P051464075H.
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
                        <b>Current Outstanding Balance:</b>
                        {{ $data['currency'] }}. {{ $data['totalOutstandingBalance'] }}
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
                            <th>TYPE</th>
                            <th>PRODUCT</th>
                            <th>QUANTITY</th>
                            <th>RATE</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['items'] as $index => $item)
                            <tr class="items">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ strtoupper($item['type']) }}</td>
                                <td>{{ strtoupper($item['name']) }}</td>
                                <td>{{ number_format($item['quantity'], 2) }}</td>
                                <td>{{ number_format($item['rate'], 2) }}</td>
                                <td>{{ number_format($item['total_amount'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="total">
                <table>
                    <tr>
                        <td class="w-half">
                            <div style="text-align: right; margin-bottom:3px;">
                                <b>Subtotal: </b>{{ $data['quotationCost'] }}
                            </div>
                            <div style="text-align: right; margin-bottom:3px;">
                                <b>Opening Charges: </b> {{ $data['openingCharges'] }}
                            </div>
                            <div style="text-align: right; margin-bottom:3px;">
                                <b>Discount:</b> {{ $data['discountAmount'] }}
                            </div>
                            <div style="text-align: right; margin-bottom:3px;">
                                <b> VAT ({{ $data['vatPercentage'] }} %):</b> {{ $data['quotationVatAmount'] }}
                            </div>
                            <div style="text-align: right; margin-bottom:3px;">
                                <b>Total - {{ $data['currency'] }}: </b> {{ $data['quotationTotalCost'] }}
                            </div>
                            <div style="text-align: right; margin-bottom:3px;">
                                ({{ $data['quotationCostToWords'] }})
                            </div>
                        </td>
                    </tr>
                </table>

            </div>

            <div class="notice">
                <table class="w-full margin-top">
                    <tr>
                        <td class="w-full">
                            <div>
                                <table>
                                    <td class="w-three-quarter">
                                        <div class="text-items">
                                            {!! $data['termsAndConditions'] !!}
                                        </div>
                                    </td>

                                    {{-- <td class="w-quarter">
                                        <div style="margin-top: 10px; margin-bottom: 10px; font-size:11px;">
                                            Received By: ...................................
                                        </div>
                                        <div style="margin-bottom: 20px; font-size:11px;">
                                            Sign: ..........................................
                                        </div>
                                        <div style="margin-bottom: 12px; font-size:11px;">
                                            Stamp:
                                        </div>
                                    </td> --}}
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="footer margin-top">
                <div>Thank you for your continued support!</div>
                <div>&copy; {{ env('APP_NAME') }}</div>
            </div>
        </div>
    </body>

</html>
