@extends('layouts.app')

@section('title')
    {{ config('policy.childeducation.name') }} | {{ config('app.name') }}
    @endsection


    @section('css')
            <!-- this page specific styles -->
    <link rel="stylesheet" href="{{ asset('css/custom/form-validation.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/nifty-component.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/libs/datepicker.css') }}" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/compiled/wizard.css') }}">
    @endsection


    @section('js')

            <!-- this page specific scripts -->
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('js/classie.js') }}"></script>
    <script src="{{ asset('js/modalEffects.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <!-- this page specific inline scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            setActiveLink('policy');
        });
    </script>

    <script src="{{ asset('js/custom/vue-mixins.js') }}"></script>
    <script src="{{ asset('js/custom/policies/childeducation/childeducation.js') }}"></script>
@endsection


@section('content')
    <div class="row" id="vue-childeducation">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div id="content-header" class="clearfix">
                        <div class="pull-left">
                            <ol class="breadcrumb">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li class="active"><span>{{ e(config('policy.childeducation.name')) }}</span></li>
                            </ol>

                            <h1>{{ e(config('policy.childeducation.name')) }}</h1>
                        </div>

                        @include('includes.quick-summary')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <header class="main-box-header clearfix">
                                <h2 class="pull-left">
                                    <i class="fa fa-child" aria-hidden="true"></i>
                                    {{ e(config('policy.childeducation.name')) }}
                                </h2>
                                @include('customers.modals.find-customer-form')
                                <div class="filter-block pull-right">
                                    <a class="btn-sm pull-right btn btn-primary mrg-b-lg" data-toggle="modal"
                                       data-target=".find-customer-form">
                                        <i class="fa fa-plus-circle fa-lg"></i> New Plan
                                    </a>
                                </div>
                            </header>

                            <div class="main-box-body clearfix">
                                <div class="search-box">
                                    <div class="title">
                                        <h2 class="pull-left"><i class="fa fa-search search-icon"></i> Find Plan</h2>
                                        <h2 class="pull-right text-danger finder-empty-results">
                                            <i class="fa fa-exclamation-circle"></i> No results found</h2>
                                    </div>
                                    <form class="form-inline finder-form" role="form">
                                        <div class="form-group">
                                            <label class="sr-only" for="search-query">Search Query</label>
                                            <input autofocus type="text" class="form-control search-query" id="search-query"
                                                   placeholder="Policy Number">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection