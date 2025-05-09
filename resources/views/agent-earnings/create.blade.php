@extends('layouts.app')

@section('title', 'Create Agent')

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
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Create Agent</li>
    </ul>
@endsection

@section('toolbar')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="my-1 text-gray-900 d-flex fw-bold fs-3">Agents</h1>
    </div>

    <div class="py-2 d-flex align-items-center">
        <ul class="my-1 text-gray-600 breadcrumb breadcrumb-dot fw-semibold fs-7">
            <li class="text-gray-600 breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Home</a>
            </li>
            <li class="text-gray-600 breadcrumb-item">Job Card Management</li>
            <li class="text-gray-600 breadcrumb-item">
                <a href="{{ route('agent.index') }}" class="text-primary fw-bold text-hover-primary">
                    Go Back
                </a>
            </li>
            <li class="text-gray-900 breadcrumb-item">Create Agent</li>
        </ul>
    </div>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Agent</h2>
            </div>
        </div>

        <form action="{{ route('agent.store') }}" class="form" method="post" accept-charset="utf-8">
            @csrf
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
            const agentTypeSelectInput = $('#type');
            const businessDetailsContainer = $('#businessDetails');
            const url = '{{ route('agent.get-agent-code') }}'

            $.get(url, function(data) {
                $('#agent_code').val(data.agent_code)
            });

            agentTypeSelectInput.on('change', function() {
                if ($(this).val() == 'business') {
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
            });
        });
    </script>
@endsection
