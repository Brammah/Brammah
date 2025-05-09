@extends('layouts.app')

@section('title', 'Create Expense')

@section('header')
    <h1 class="mb-0 text-gray-900 d-flex flex-column fw-bold fs-3">Expenses</h1>
    <ul class="pt-1 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Expense Management</li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('expense.index') }}" class="text-dark text-hover-primary">Go Back</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="text-gray-900 breadcrumb-item">Create Expense</li>
    </ul>
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Expense</h2>
            </div>
        </div>

        <form action="{{ route('expense.store') }}" class="form" method="post" accept-charset="utf-8">
            @csrf
            <div class="card-body">
                @include('expenses.form')
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12" style="text-align:center">
                        <button type="submit" class="me-2 btn btn-primary btn-sm hover-scale">Submit</button>
                        <button type="reset" class="btn btn-secondary btn-sm hover-scale"
                            onclick="window.history.go(-1); return false;">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            const transactionMethodSelectInput = $('#transaction_method');
            const transactionReferenceInput = $('#transaction_reference');
            const expenseDateInput = $('#date');

            transactionMethodSelectInput.on('change', function() {
                const url = '{{ route('expense.get-cash-reference') }}'
                const transactionMethod = $(this).val()

                if (transactionMethod == 'cash') {
                    $.get(url, {
                        transaction_method: transactionMethod,
                    }, function(response) {
                        transactionReferenceInput.val(response.cashReferenceNumber);
                    });
                } else {
                    transactionReferenceInput.val('');
                }
            });

            expenseDateInput.flatpickr({
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endsection
