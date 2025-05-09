@extends('layouts.app')

@section('title', 'Quotation Details')

@use('Carbon\Carbon')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Quotation</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Job Card Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('quotation.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Quotation Details</li>
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
                            {{ $quotation->is_approved === 1 ? 'bg-success' : 'bg-danger' }}">
                        </div>
                    </div>

                </div>

                <div class="flex-grow-1">
                    <div class="flex-wrap mb-2 d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <div class="mb-1 d-flex align-items-center">
                                <a href="#" class="text-gray-900 text-hover-primary fs-3 fw-bold me-1">
                                    {{ $quotation->quotation_number }} - {{ strtoupper($quotation->customer->name) }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-calendar fs-4 me-1"></i>
                                    Date: {{ Carbon::parse($quotation->date)->format('d-F-Y') }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Currency: {{ strtoupper($quotation->currency->code) }} -
                                    {{ $quotation->currency->name }}
                                </a>
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Quotation Amount: {{ number_format($quotation->quotation_amount, 2) }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    VAT Amount: {{ number_format($quotation->vat_amount, 2) }}
                                </a>
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Discount Amount: {{ number_format($quotation->discount_amount, 2) }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Quotation Amount Inclusive VAT:
                                    {{ number_format($quotation->quotation_amount_inclusive_vat, 2) }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Job Card: {{ strtoupper($quotation->jobCard->jobcard_number ?? '-') }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Job Inspection:
                                    {{ strtoupper($quotation->jobInspection->inspection_number ?? '-') }}
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
                                    <i class="fa-solid fa-coins fs-3 text-success me-2"></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500"
                                        data-kt-countup-prefix="Total Charges" data-kt-initialized="1">
                                        {{ strtoupper($quotation->currency->code) }}.
                                        {{ number_format($quotation->quotation_amount_inclusive_vat, 2) }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Total Quotation Amount Inclsv</div>
                            </div>
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-coins fs-3 text-success me-2"></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500"
                                        data-kt-countup-prefix="Total Charges" data-kt-initialized="1">
                                        {{ strtoupper($quotation->currency->code) }}.
                                        {{ number_format($quotation->quotationCharges->sum('total_amount'), 2) ?? 0 }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Total Miscellaneous Charges</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="border-transparent nav nav-stretch nav-line-tabs nav-line-tabs-2x fs-5 fw-bold">
                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 active" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#quoted-products-details">
                        Quoted Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#quoted-charges-details">
                        Quoted Charges
                    </a>
                </li>
                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#revised-quotations">
                        Revised Quotations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#below-cost-remarks">
                        Below Cost Remarks
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="quoted-products-details" role="tabpanel">
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="shadow-sm card">
                    <div class="mt-4 card-header">
                        <div class="card-title flex-column">
                            <h3 class="mb-1 fw-bold">Quoted Products</h3>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table
                                class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                                id="quoted-products-list">
                                <thead>
                                    <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th>Product</th>
                                        <th>Quoted Qty</th>
                                        <th>Selling Price</th>
                                        <th>VAT Amount</th>
                                        <th>Total Amount</th>
                                        <th>Issued Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotation->quotationProducts as $quotationProduct)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ strtoupper($quotationProduct->product->brand->name ?? '-') }}</td>
                                            <td>
                                                {{ strtoupper($quotationProduct->product->name) }}
                                                <div class="text-muted">
                                                    {{ strtoupper($quotationProduct->product->part_number) }}</div>
                                            </td>
                                            <td>{{ number_format($quotationProduct->quoted_quantity, 2) }} </td>
                                            <td>{{ number_format($quotationProduct->selling_price, 2) }} </td>
                                            <td>{{ number_format($quotationProduct->vat_amount, 2) }} </td>
                                            <td>
                                                {{ number_format($quotationProduct->selling_price * $quotationProduct->quoted_quantity + $quotationProduct->vat_amount, 2) }}
                                            </td>
                                            <td>{{ number_format($quotationProduct->material_issued_quantity, 2) }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="quoted-charges-details" role="tabpanel">
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="shadow-sm card">
                    <div class="mt-4 card-header">
                        <div class="card-title flex-column">
                            <h3 class="mb-1 fw-bold">Quoted Charges</h3>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table
                                class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                                id="quoted-charges-list">
                                <thead>
                                    <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Charge</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Vat Amount</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotation->quotationCharges as $quotationCharge)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ strtoupper($quotationCharge->product->name) }}
                                                <div class="text-muted">
                                                    {{ strtoupper($quotationCharge->product->part_number) }}</div>
                                            </td>
                                            <td>{{ strtoupper($quotationCharge->miscellaneousCharge->name) }}</td>
                                            <td>{{ number_format($quotationCharge->price, 2) }}</td>
                                            <td>{{ number_format($quotationCharge->quantity, 2) ?? 0 }}</td>
                                            <td>{{ number_format($quotationCharge->vat_amount, 2) }}</td>
                                            <td>
                                                {{ number_format($quotationCharge->price * $quotationCharge->quantity + $quotationCharge->vat_amount, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="revised-quotations" role="tabpanel">
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="shadow-sm card">
                    <div class="mt-4 card-header">
                        <div class="card-title flex-column">
                            <h3 class="mb-1 fw-bold">Revised Quotations</h3>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table
                                class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                                id="revised-quotations-list">
                                <thead>
                                    <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Quote Number</th>
                                        <th>Customer</th>
                                        <th>Currency</th>
                                        <th>Total Amount Inclsv</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotation->revisedQuotations as $revisedQuotation)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ Carbon::parse($revisedQuotation->date)->format('d-M-Y') }}
                                            </td>
                                            <td>{{ strtoupper($revisedQuotation->quotation_number) }}</td>
                                            <td>{{ strtoupper($revisedQuotation->customer->customer_name) }}</td>
                                            <td>{{ strtoupper($revisedQuotation->currency->code) }} </td>
                                            <td>
                                                {{ number_format($revisedQuotation->quotation->quotation_amount_inclusive_vat, 2) ?? 0 }}
                                            </td>
                                            @canany(['edit quotation', 'delete quotation', 'view quotation'])
                                                <td>
                                                    <a href="#"
                                                        class="border btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary @if ($quotation->is_low_stock) border-dark @endif"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px"
                                                        data-kt-menu="true">
                                                        @can('view quotation')
                                                            <div class="px-3 menu-item">
                                                                <a href="{{ route('quotation.show', $revisedQuotation) }}"
                                                                    class="px-3 menu-link">
                                                                    <i class="fas fa-eye text-info font-weight-boldest me-2"></i>
                                                                    View
                                                                </a>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="below-cost-remarks" role="tabpanel">
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="shadow-sm card">
                    <div class="mt-4 card-header">
                        <div class="card-title flex-column">
                            <h3 class="mb-1 fw-bold">Below Cost Remarks</h3>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table
                                class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7"
                                id="below-cost-remarks-list">
                                <thead>
                                    <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Ideal Amount (Inclsv)</th>
                                        <th>Quoted Amount (Inclsv)</th>
                                        <th>Price Difference</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotation->belowCostRemarks as $belowCostRemark)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ Carbon::parse($belowCostRemark->date)->format('d-M-Y') }}
                                            </td>
                                            <td>
                                                {{ number_format($belowCostRemark->ideal_quotation_amount_inclusive_vat, 2) ?? 0 }}
                                            </td>
                                            <td>
                                                {{ number_format($belowCostRemark->quoted_quotation_amount_inclusive_vat, 2) ?? 0 }}
                                            </td>
                                            <td>
                                                {{ number_format($belowCostRemark->price_difference, 2) ?? 0 }}
                                            </td>
                                            <td>{{ $belowCostRemark->remarks }}</td>
                                            @canany(['edit quotation', 'delete quotation', 'view quotation'])
                                                <td>
                                                    <a href="#"
                                                        class="border btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary @if ($quotation->is_low_stock) border-dark @endif"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px"
                                                        data-kt-menu="true">
                                                        {{-- @can('view quotation')
                                                            <div class="px-3 menu-item">
                                                                <a href="{{ route('below-cost-quotation-remark.edit', $belowCostRemark) }}"
                                                                    class="px-3 menu-link">
                                                                    <i class="fas fa-eye text-info font-weight-boldest me-2"></i>
                                                                    View
                                                                </a>
                                                            </div>
                                                        @endcan --}}
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            $('#quoted-products-list').DataTable({
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

            $('#quoted-charges-list').DataTable({
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

            $('#revised-quotations-list').DataTable({
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

            $('#below-cost-remarks-list').DataTable({
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
