@extends('layouts.app')

@section('title', 'Vehicle Make Details')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Vehicle Makes</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Customers & Vehicles </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('vehicle-make.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">{{ $vehicleMake->name }} Details</li>
    </ul>
@endsection


@section('main-content')
    <div class="mb-5 card mb-xxl-8">
        <div class="pb-0 card-body pt-9">
            <div class="flex-wrap d-flex flex-sm-nowrap">
                <div class="mb-4 me-7">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image">
                        <div
                            class="bottom-0 mb-6 border-4 position-absolute translate-middle start-100 bg-success rounded-circle border-body h-20px w-20px">
                        </div>
                    </div>
                </div>

                <div class="flex-grow-1">
                    <div class="flex-wrap mb-2 d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <div class="mb-2 d-flex align-items-center">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                    {{ $vehicleMake->name }}
                                </a>
                                <a href="#"><i class="ki-outline ki-verify fs-1 text-primary"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="flex-wrap d-flex flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="flex-wrap d-flex">
                                <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                            data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">
                                            $4,500</div>
                                    </div>

                                    <div class="text-gray-500 fw-semibold fs-6">Earnings</div>
                                </div>

                                <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80"
                                            data-kt-initialized="1">80</div>
                                    </div>

                                    <div class="text-gray-500 fw-semibold fs-6">Projects</div>
                                </div>

                                <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60"
                                            data-kt-countup-prefix="%" data-kt-initialized="1">%60</div>
                                    </div>

                                    <div class="text-gray-500 fw-semibold fs-6">Success Rate</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="border-transparent nav nav-stretch nav-line-tabs nav-line-tabs-2x fs-5 fw-bold">
                <li class="mt-2 nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 active" href="#">
                        Invoices
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="mb-5 card mb-xxl-8">
        <div class="pb-0 card-body">
            <div class="table-responsive">
                <table id="vehicle-makes-list"
                    class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4">
                    <thead>
                        <tr class="text-gray-800 fw-bold px-7">
                            <th> #</th>
                            <th> Service</th>
                            <th> Payment Method</th>
                            <th> Billed Amount</th>
                            <th> Paid Amount</th>
                            <th> Payment Reference</th>
                            <th> Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @foreach ($treatmentPayment->treatmentPaymentServices as $treatmentPaymentService)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $treatmentPaymentService->service->name }}</td>
                                <td>{{ $treatmentPaymentService->paymentMethod->name }}</td>
                                <td>{{ number_format($treatmentPaymentService->billed_amount, 2) }}</td>
                                <td>{{ number_format($treatmentPaymentService->paid_amount, 2) }}</td>
                                <td>{{ $treatmentPaymentService->payment_reference }}</td>
                                <td>{!! $treatmentPaymentService->statusBadge() !!}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="deleteConfirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Delete Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete this Invoice?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="hover-scale btn btn-sm btn-light-secondary text-dark font-weight-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_vehicle_inspections_delete">
                        @csrf
                        <button type="submit" class="hover-scale btn btn-sm btn-success font-weight-bold">Yes
                            Invoice</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            initializeDatatable('vehicle-makes-list');

            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal')
            const invoiceForm = document.getElementById('form_vehicle_inspections_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                invoiceForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
