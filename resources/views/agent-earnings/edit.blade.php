@extends('layouts.app')

@section('title', 'Edit Agent')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Agents</h1>
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
            <a href="{{ route('agent.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Edit Agent</li>
    </ul>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Edit Agent</h2>
            </div>
        </div>

        <form action="{{ route('agent.update', $agent) }}" class="form" method="post" accept-charset="utf-8">
            @csrf
            @method('PATCH')
            <div class="card-body">
                @include('agents.form')
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
            const emailInput = $('#email');
            const kraPinInput = $('#kra_pin');
            const addressInput = $('#address');
            const flatFeeInput = $('#flatFee');
            const agentTypeSelectInput = $('#type');
            const paymentTypeSelectInput = $('#payment_type');
            const percentageValueInput = $('#percentageValue');
            const businessDetailsContainer = $('#businessDetails');

            function handleAgentTypeChange() {
                if (agentTypeSelectInput.val() == 'business') {
                    businessDetailsContainer.removeClass('d-none');
                    emailInput.attr('required', true);
                    kraPinInput.attr('required', true);
                    addressInput.attr('required', true);
                } else {
                    businessDetailsContainer.addClass('d-none');
                    emailInput.removeAttr('required');
                    kraPinInput.removeAttr('required');
                    addressInput.removeAttr('required');
                }
            }

            function handlePaymentTypeChange() {
                if (paymentTypeSelectInput.val() == 'flat-fee') {
                    flatFeeInput.removeClass('d-none');
                    percentageValueInput.addClass('d-none');
                    flatFeeInput.attr('required', true);
                    percentageValueInput.removeAttr('required');
                } else {
                    flatFeeInput.addClass('d-none');
                    percentageValueInput.removeClass('d-none');
                    percentageValueInput.attr('required', true);
                    flatFeeInput.removeAttr('required');
                }
            }

            agentTypeSelectInput.on('change', handleAgentTypeChange);
            paymentTypeSelectInput.on('change', handlePaymentTypeChange);

            handleAgentTypeChange();
            handlePaymentTypeChange();
        });
    </script>
@endsection
