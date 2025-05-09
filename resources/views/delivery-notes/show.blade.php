@extends('layouts.app')

@section('title', 'Delivery Note Details')

@use('Carbon\Carbon')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Delivery Notes</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Sales Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('delivery-note.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Delivery Note Details</li>
    </ul>
@endsection

@section('main-content')
    <div class="card">
        <div class="py-20 card-body">
            <div class="mx-auto mw-lg-950px w-100">
                <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                    <h4 class="text-gray-800 fw-bolder fs-2qx pe-5 pb-7 text-sm-start">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="w-400">
                        <div class="text-sm-start fw-semibold fs-6 mt-7">
                            <div>P.O BOX 78518-00507</div>
                            <div>RUNYENJES ROAD, INDUSTRIAL AREA</div>
                            <div>NAIROBI, KENYA</div>
                            <div>PIN: P051464075H</div>
                        </div>
                    </h4>

                    <div class="text-sm-end">
                        <h4 class="text-gray-800 fw-bolder fs-2qx pe-5 pb-7">DELIVERY NOTE</h4>
                        <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                            <div class="fw-bold fs-2">{{ strtoupper($deliveryNote->customer->name) }},
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="fs-6 text-muted">
                                            {{ $deliveryNote->customer->phone }},<br>
                                            {{ $deliveryNote->customer->email }},<br>
                                            {{ $deliveryNote->customer->address }},<br>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-12">
                    <div class="d-flex flex-column gap-7 gap-md-10">
                        <div class="separator"></div>
                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Delivery Note Date</span>
                                <span class="fs-5">{{ Carbon::parse($deliveryNote->date)->format('d-F-Y') }}</span>
                            </div>

                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Job Card ID</span>
                                <span
                                    class="fs-5">{{ $deliveryNote->jobCard->jobcard_number ?? 'COUNTER SALE QUOTE' }}</span>
                            </div>

                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Job Inspection ID</span>
                                <span
                                    class="fs-5">{{ $deliveryNote->jobInspection->inspection_number ?? 'COUNTER SALE QUOTE' }}</span>
                            </div>

                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Quotation/Sale ID</span>
                                <span
                                    class="fs-5">{{ $deliveryNote->quotation->quotation_number ?? $deliveryNote->sale->sale_number }}</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between flex-column">
                            <div class="table-responsive border-bottom mb-9">
                                <table class="table mb-0 align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class="border-bottom fs-6 fw-bold text-muted">
                                            <th class="pb-2 min-w-175px">Products</th>
                                            <th class="pb-2 min-w-70px text-end">Part Number</th>
                                            <th class="pb-2 min-w-80px text-end">QTY</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-gray-600 fw-semibold">
                                        @foreach ($deliveryNote->deliveryNoteProducts as $deliveryNoteProduct)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-5">
                                                            <div class="fw-bold">
                                                                {{ $deliveryNoteProduct->product->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    {{ $deliveryNoteProduct->product->part_number }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $deliveryNoteProduct->delivered_quantity }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-wrap d-flex flex-stack mt-lg-20 pt-13">
                    <a href="#" class="my-1 btn btn-primary">Create Invoice (WIP)</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {});
    </script>
@endsection
