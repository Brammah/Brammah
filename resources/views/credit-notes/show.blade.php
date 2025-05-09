@extends('layouts.app')

@section('title', 'Invoice Details')

@use('Carbon\Carbon')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Invoice</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Dispatch Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('invoice.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Invoice Details</li>
    </ul>
@endsection

@section('main-content')
    <div class="mb-5 card mb-xxl-8"
        style="background-position: center right -8rem;50px;background-size: 700px; background-repeat:no-repeat; background-image:url('{{ asset('assets/media/stock/bg-card.png') }}')">
        <div class="pb-0 card-body pt-9 border-end border-3 rounded-top rounded-bottom border-info">
            <div class="flex-wrap d-flex flex-sm-nowrap">
                <div class="mb-2 me-7">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ asset('assets/media/misc/inspection.jpg') }}" alt="quotation image">
                        <div class="bottom-0 mb-6 border-4 position-absolute translate-middle start-100 rounded-circle border-body h-20px w-20px bg-success"
                            {{ $invoice->is_approved === 1 ? 'bg-success' : 'bg-danger' }}">
                        </div>
                    </div>

                </div>

                <div class="flex-grow-1">
                    <div class="flex-wrap mb-2 d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <div class="mb-1 d-flex align-items-center">
                                <a href="#" class="text-gray-900 text-hover-primary fs-3 fw-bold me-1">
                                    {{ $invoice->invoice_number }} - {{ strtoupper($invoice->customer->name) }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-calendar fs-4 me-1"></i>
                                    Date: {{ Carbon::parse($invoice->date)->format('d-F-Y') }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Currency: {{ strtoupper($invoice->currency->code) }} -
                                    {{ $invoice->currency->name }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Invoice Amount:
                                    {{ number_format($invoice->invoice_amount - $invoice->opening_charges, 2) }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Opening Charges: {{ number_format($invoice->opening_charges, 2) }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    VAT Amount: {{ number_format($invoice->vat_amount, 2) }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Discount Amount: {{ number_format($invoice->discount_amount, 2) }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Invoice Amont Inclsv VAT:
                                    {{ number_format($invoice->invoice_amount_inclusive_vat, 2) }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Job Card: {{ strtoupper($invoice->jobCard->jobcard_number ?? 'COUNTER SALE QUOTE') }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Job Inspection:
                                    {{ strtoupper($invoice->jobInspection->inspection_number ?? 'COUNTER SALE QUOTE') }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Quotation:
                                    {{ strtoupper($invoice->deliveryNote->quotation->quotation_number ?? 'COUNTER SALE QUOTE') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-wrap d-flex flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="flex-wrap d-flex">
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-coins fs-3 text-danger me-2"></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80"
                                        data-kt-initialized="1">
                                        {{ number_format($invoice->discount_amount, 2) }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Total Discount</div>
                            </div>
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-boxes fs-3 text-dark me-2"></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80"
                                        data-kt-initialized="1">
                                        {{ number_format($invoice->invoiceProducts->sum('quoted_quantity')) ?? 0 }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Total Invoiced Quantity</div>
                            </div>
                        </div>
                        <div class="flex-wrap d-flex">
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-coins fs-3 text-success me-2"></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500"
                                        data-kt-countup-prefix="Total Charges" data-kt-initialized="1">
                                        {{ strtoupper($invoice->currency->code) }}.
                                        {{ number_format($invoice->invoice_amount_inclusive_vat, 2) }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Total Invoice Cost</div>
                            </div>
                            {{-- <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-coins fs-3 text-success me-2"></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500"
                                        data-kt-countup-prefix="Total Charges" data-kt-initialized="1">
                                        {{ strtoupper($invoice->currency->code) }}.
                                        {{ number_format($invoice->quotationCharges->sum('total_amount'), 2) ?? 0 }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Total Miscellaneous Charges</div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <ul class="border-transparent nav nav-stretch nav-line-tabs nav-line-tabs-2x fs-5 fw-bold">
                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 active" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#invoiced-products-details">
                        Invoiced Products
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#invoiced-charges-details">
                        Invoiced Charges
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="invoiced-products-details" role="tabpanel">
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="shadow-sm card">
                    <div class="mt-4 card-header">
                        <div class="card-title flex-column">
                            <h3 class="mb-1 fw-bold">Invoiced Products</h3>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table
                                class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                                id="invoiced-products-list">
                                <thead>
                                    <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Part Number</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>UOM</th>
                                        <th>Invoiced Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice->invoiceProducts as $invoiceProduct)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ strtoupper($invoiceProduct->product->name) }}</td>
                                            <td>{{ strtoupper($invoiceProduct->product->part_number) }}</td>
                                            <td>{{ strtoupper($invoiceProduct->product->brand->name ?? '-') }}</td>
                                            <td>{{ strtoupper($invoiceProduct->product->category->name ?? '-') }}</td>
                                            <td>
                                                {{ strtoupper($invoiceProduct->product->unitOfMeasure->name ?? '-') }}
                                            </td>
                                            <td>{{ number_format($invoiceProduct->quoted_quantity, 2) }}
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="6" class="fw-bold">Totals:</td>
                                        <td class="fw-bold">
                                            {{ number_format($invoice->invoiceProducts->sum('quoted_quantity'), 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="invoiced-charges-details" role="tabpanel">
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="shadow-sm card">
                    <div class="mt-4 card-header">
                        <div class="card-title flex-column">
                            <h3 class="mb-1 fw-bold">Invoiced Charges</h3>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            {{-- <table
                                class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                                id="invoiced-charges-list">
                                <thead>
                                    <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Charge</th>
                                        <th>Price</th>
                                        <th>Vat Amount</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice->quotationCharges as $invoiceCharge)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ strtoupper($invoiceCharge->product->name) }}</td>
                                            <td>{{ strtoupper($invoiceCharge->miscellaneousCharge->name) }}</td>
                                            <td>{{ number_format($invoiceCharge->price, 2) }}
                                            <td>{{ number_format($invoiceCharge->vat_amount, 2) }}
                                            <td>{{ number_format($invoiceCharge->total_amount, 2) }}
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="3" class="fw-bold">Totals:</td>
                                        <td class="fw-bold">
                                            {{ number_format($invoice->quotationCharges->sum('price'), 2) }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ number_format($invoice->quotationCharges->sum('vat_amount'), 2) }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ number_format($invoice->quotationCharges->sum('total_amount'), 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#invoiced-products-list').DataTable({
                dom: "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-content-start my-4'f>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'B>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",

                buttons: [{
                        extend: "pageLength",
                        titleAttr: "Record Count",
                        className: "btn-light-pri",
                    },
                    {
                        extend: "collection",
                        text: '<span><i class="la la-download"></i> Data Export</span>',
                        titleAttr: "Record Export",
                        className: "btn-light-pri",
                        buttons: [{
                                extend: "csvHtml5",
                                text: '<li><span><i class="la la-file-text-o"></i></span>&nbsp;<span>CSV Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "excelHtml5",
                                text: '<li><span><i class="la la-file-excel-o"></i></span>&nbsp;<span>Excel Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "pdfHtml5",
                                text: '<li><span><i class="la la-file-pdf-o"></i></span>&nbsp;<span>PDF Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "copyHtml5",
                                text: '<li><span><i class="la la-copy"></i></span>&nbsp;<span>Copy Table</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "print",
                                text: '<li><span><i class="la la-print"></i></span>&nbsp;<span>Print Table</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                        ],
                    },
                ],
            });
            $('#invoiced-charges-list').DataTable({
                dom: "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-content-start my-4'f>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'B>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",

                buttons: [{
                        extend: "pageLength",
                        titleAttr: "Record Count",
                        className: "btn-light-pri",
                    },
                    {
                        extend: "collection",
                        text: '<span><i class="la la-download"></i> Data Export</span>',
                        titleAttr: "Record Export",
                        className: "btn-light-pri",
                        buttons: [{
                                extend: "csvHtml5",
                                text: '<li><span><i class="la la-file-text-o"></i></span>&nbsp;<span>CSV Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "excelHtml5",
                                text: '<li><span><i class="la la-file-excel-o"></i></span>&nbsp;<span>Excel Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "pdfHtml5",
                                text: '<li><span><i class="la la-file-pdf-o"></i></span>&nbsp;<span>PDF Export</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "copyHtml5",
                                text: '<li><span><i class="la la-copy"></i></span>&nbsp;<span>Copy Table</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                            {
                                extend: "print",
                                text: '<li><span><i class="la la-print"></i></span>&nbsp;<span>Print Table</span></li>',
                                exportOptions: {
                                    columns: ":visible",
                                },
                            },
                        ],
                    },
                ],
            });
        });
    </script>
@endsection
