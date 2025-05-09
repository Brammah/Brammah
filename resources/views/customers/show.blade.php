@extends('layouts.app')
@use('Carbon\Carbon')
@use('App\Http\Helpers\CustomerHelper')

@section('title', 'Customer Details')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Customers</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Customers & Vehicles</li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('customer.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">{{ $customer->name }} Details</li>
    </ul>
@endsection


@section('main-content')
    <div class="mb-5 card mb-xxl-8"
        style="background-position: center right -8rem;50px;background-size: 700px; background-repeat:no-repeat; background-image:url('{{ asset('assets/media/stock/bg-card.png') }}')">
        <div class="pb-0 card-body pt-9 border-end border-3 rounded-top rounded-bottom border-info">
            <div class="flex-wrap d-flex flex-sm-nowrap">
                <div class="mb-4 me-7">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ asset('assets/media/avatars/customer-image.jpeg') }}" alt="customer image">
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
                                    {{ $customer->name }}, {{ $customer->customer_number }}
                                </a>
                            </div>

                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Phone: {{ $customer->phone }}
                                </a>
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Email: {{ $customer->email }}
                                </a>
                            </div>
                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                    Branch: {{ $customer->branch->name ?? '-' }}
                                </a>

                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>
                                    Account Manager: {{ $customer->accountManager->full_name ?? '-' }}
                                </a>
                            </div>
                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>
                                    Opening Balance: {{ number_format($customer->opening_balance, 2) }}
                                </a>
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>
                                    Outstanding Balance: {{ number_format($customer->outstanding_balance, 2) }}
                                </a>
                            </div>
                            <div class="flex-wrap mb-2 d-flex fw-semibold fs-6 pe-2">
                                <a href="#" class="text-gray-500 d-flex align-items-center text-hover-primary me-5">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>
                                    Credit Limit: {{ number_format($customer->credit_limit, 2) }}
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
                                    <i class="fa-solid fa-coins fs-5 text-dark me-2"></i>
                                    <div class="fs-5 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500"
                                        data-kt-countup-prefix="KES" data-kt-initialized="1">
                                        KES
                                        {{ number_format(CustomerHelper::getOutstandingBalance($customer), 2) }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Outstanding Balance</div>
                            </div>

                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-file-invoice-dollar fs-5 text-success me-2"></i>
                                    <div class="fs-5 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80"
                                        data-kt-initialized="1">
                                        {{ $customer->invoices_count }}
                                    </div>
                                </div>
                                <div class="text-gray-500 fw-semibold fs-6">Invoices</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="border-transparent nav nav-stretch nav-line-tabs nav-line-tabs-2x fs-5 fw-bold">
                <li class="mt-2 nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 active" data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#invoices">
                        Invoices - ({{ $customer->invoices_count }})
                    </a>
                </li>
                <li class="mt-2 nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 " data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#contacts">
                        Contacts - ({{ $customer->customer_contacts_count }})
                    </a>
                </li>
                <li class="mt-2 nav-item">
                    <a class="py-5 nav-link text-active-primary ms-0 me-10 " data-bs-toggle="tab" aria-selected="true"
                        role="tab" href="#customer-accounts">
                        Accounting - ({{ $customer->customer_accounts_count }})
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="invoices" role="tabpanel">
            <div class="mb-5 card mb-xxl-8">
                <div class="pb-0 card-body">
                    <div class="table-responsive">
                        <table id="customer-invoices-list"
                            class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th> #</th>
                                    <th>Date</th>
                                    <th>Inv No</th>
                                    <th>Warranty</th>
                                    <th>Terms</th>
                                    <th>Cost</th>
                                    <th>Opening Charges</th>
                                    <th>VAT Amount</th>
                                    <th>Discount</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->invoices as $invoice)
                                    @php
                                        $date = $invoice->date ? Carbon::parse($invoice->date)->format('d-M-Y') : '-';
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $date }}</td>
                                        <td>{{ strtoupper($invoice->invoice_number) }}</td>
                                        <td>{{ $invoice->is_warranted ? 'YES' : 'NO' }}</td>
                                        <td>{{ strtoupper($invoice->paymentTerm->name) }}</td>
                                        <td>{{ number_format($invoice->invoice_amount - $invoice->opening_charges, 2) }}
                                        </td>
                                        <td>{{ number_format($invoice->opening_charges, 2) }}</td>
                                        <td>{{ number_format($invoice->vat_amount, 2) }}
                                        <td>{{ number_format($invoice->discount_amount, 2) }}</td>
                                        <td>{{ number_format($invoice->invoice_amount_inclusive_vat, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"><b>Totals</b></td>
                                    <td><b>{{ number_format($customer->invoices->sum('invoice_amount') - $customer->invoices->sum('opening_charges'), 2) }}</b>
                                    </td>
                                    <td><b>{{ number_format($customer->invoices->sum('opening_charges'), 2) }}</b></td>
                                    <td><b>{{ number_format($customer->invoices->sum('vat_amount'), 2) }}</b></td>
                                    <td><b>{{ number_format($customer->invoices->sum('discount_amount'), 2) }}</b></td>
                                    <td><b>{{ number_format($customer->invoices->sum('invoice_amount_inclusive_vat'), 2) }}</b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contacts" role="tabpanel">
            <div class="card">
                <div class="pb-0 card-body">
                    <div class="table-responsive">
                        <table id="customer-contacts-list"
                            class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th> #</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->customerContacts as $customerContact)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $customerContact->name ?? '-' }}</td>
                                        <td>{{ $customerContact->email ?? '-' }}</td>
                                        <td>{{ $customerContact->phone ?? '-' }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </a>
                                            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
                                                data-kt-menu="true">
                                                @can(['edit customer contact'])
                                                    <div class="px-3 menu-item">
                                                        <a href="{{ route('customer-contact.edit', $customerContact) }}"
                                                            class="px-3 menu-link">
                                                            <i class="fas fa-edit text-success font-weight-boldest me-2"></i>
                                                            Edit
                                                        </a>
                                                    </div>
                                                @endcan

                                                @can(['delete customer contact'])
                                                    <div class="px-3 menu-item">
                                                        <span data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                                            data-bs-url="{{ route('customer-contact.destroy', $customerContact) }}">
                                                            <a type="button" class="px-3 menu-link" title="Delete"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-custom-class="tooltip-inverse"
                                                                data-bs-placement="top">
                                                                <i
                                                                    class="fa-solid fa-trash-alt text-danger font-weight-boldest me-2"></i>
                                                                Delete
                                                            </a>
                                                        </span>
                                                    </div>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="customer-accounts" role="tabpanel">
            <div class="card">
                <div class="mt-5 card-header">
                    <div class="card-title flex-column">
                        <h3 class="mb-1 fw-bold">Customer Accounts</h3>
                        <div class="mb-2 text-gray-400 ">List of Customer Accounts</div>
                    </div>

                    <div class="my-1 card-toolbar">
                        @can('add customer account')
                            <a href="{{ route('customer-account.create', $customer) }}" class="btn btn-primary btn-sm">
                                New Account
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="pb-0 card-body">
                    <div class="table-responsive">
                        <table id="customer-accounts-list"
                            class="table align-middle border rounded table-striped table-row-bordered gy-2 gs-4 fs-7">
                            <thead>
                                <tr class="align-middle text-start fw-bold fs-7 text-uppercase gs-0">
                                    <th> #</th>
                                    <th>Payment Term</th>
                                    <th>Maximum Invoices</th>
                                    <th>Billing Currency</th>
                                    <th>Opening Balance</th>
                                    <th>Credit Limit</th>
                                    <th>Account Manager</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->customerAccounts as $customerAccount)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ strtoupper($customerAccount->paymentTerm->name) }}</td>
                                        <td>{{ number_format($customerAccount->maximum_invoices) }}</td>
                                        <td>{{ strtoupper($customerAccount->currency->name) }}</td>
                                        <td>{{ number_format($customerAccount->opening_balance, 2) }}</td>
                                        <td>{{ number_format($customerAccount->credit_limit, 2) }}</td>
                                        <td>{{ strtoupper($customerAccount->accountManager->full_name) }}</td>
                                        <td>{!! $customerAccount->statusBadge() !!}</td>
                                        @canany([
                                            'edit customer account',
                                            'delete customer account',
                                            'view customer
                                            account',
                                            ])
                                            <td>
                                                <a href="#"
                                                    class="btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                                <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
                                                    data-kt-menu="true">
                                                    @can(['edit customer account'])
                                                        <div class="px-3 menu-item">
                                                            <a href="{{ route('customer-account.edit', $customerAccount) }}"
                                                                class="px-3 menu-link">
                                                                <i class="fas fa-edit text-success font-weight-boldest me-2"></i>
                                                                Edit
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can(['delete customer account'])
                                                        <div class="px-3 menu-item">
                                                            <span data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                                                data-bs-url="{{ route('customer-account.destroy', $customerAccount) }}">
                                                                <a type="button" class="px-3 menu-link" title="Delete"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-custom-class="tooltip-inverse"
                                                                    data-bs-placement="top">
                                                                    <i
                                                                        class="fa-solid fa-trash-alt text-danger font-weight-boldest me-2"></i>
                                                                    Delete
                                                                </a>
                                                            </span>
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

    <div class="modal fade" tabindex="-1" id="deleteConfirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Deletion Confirmation</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete this Customer Account?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST" id="form_customer_account_delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger font-weight-bold hover-scale">Yes
                            Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            initializeDatatable('customer-invoices-list');
            initializeDatatable('customer-contacts-list');
            initializeDatatable('customer-accounts-list');

            const fragment = window.location.hash;

            if (fragment) {
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('active show');

                const tabLink = $('.nav-link[href="' + fragment + '"]');
                const tabPane = $(fragment);

                if (tabLink.length && tabPane.length) {
                    tabLink.addClass('active');
                    tabPane.addClass('active show');
                }
            }

            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal')
            const deleteForm = document.getElementById('form_customer_account_delete')
            deleteConfirmationModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const url = button.getAttribute('data-bs-url')
                deleteForm.setAttribute('action', url)
            });
        });
    </script>
@endsection
