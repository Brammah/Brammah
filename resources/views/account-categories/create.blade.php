@extends('layouts.app')

@section('title', 'Create Account Category')

@section('header')
    <h1 class="mb-0 text-gray-900 d-flex flex-column fw-bold fs-3">Account Categories</h1>
    <ul class="pt-1 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Account Management</li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('account-category.index') }}" class="text-dark text-hover-primary">Go Back</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bg-gray-300 bullet w-5px h-2px"></span>
        </li>
        <li class="text-gray-900 breadcrumb-item">Create Account Category</li>
    </ul>
@endsection

@section('main-content')
    <div class="shadow-sm card">
        <div class="card-header">
            <div class="card-title">
                <h2>Create Account Category</h2>
            </div>
        </div>

        <form action="{{ route('account-category.store') }}" class="form" method="post" accept-charset="utf-8">
            @csrf
            <div class="card-body">
                @include('account-categories.form')
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
