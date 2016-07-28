@extends('layouts.app')

@section('title')
    Funeral Policy | {{ config('app.name') }}
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

    <script src="{{ asset('js/wizard.js') }}"></script>
    <script src="{{ asset('js/custom/vue-mixins.js') }}"></script>
    <script src="{{ asset('js/custom/policies/funeral.js') }}"></script>
@endsection


@section('content')
    <div class="row" id="vue-funeral">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div id="content-header" class="clearfix">
                        <div class="pull-left">
                            <ol class="breadcrumb">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li class="active"><span>Funeral</span></li>
                            </ol>

                            <h1>Funeral Policy</h1>
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
                                <h2 class="pull-left"><i class="fa fa-umbrella" aria-hidden="true"></i> Funeral Policy</h2>

                                @include('customers.modals.find-customer-form')
                                <div class="filter-block pull-right">
                                    <a class="btn-sm pull-right btn btn-primary mrg-b-lg" data-toggle="modal"
                                            data-target=".find-customer-form">
                                        <i class="fa fa-plus-circle fa-lg"></i> New Policy
                                    </a>
                                </div>
                            </header>

                            <div class="main-box-body clearfix">
                                <div class="search-box">
                                    <div class="title">
                                        <h2 class="pull-left"><i class="fa fa-search search-icon"></i> Find Policy</h2>
                                        <h2 class="pull-right text-danger" v-show="policySearch.emptyResults">
                                            <i class="fa fa-exclamation-circle"></i> No results found</h2>
                                    </div>
                                    <form class="form-inline finder-form" role="form" @submit.prevent="findPolicy">
                                        <div class="form-group">
                                            <label class="sr-only" for="search-query">Search Query</label>
                                            <input autofocus autocomplete="off" type="text" class="form-control search-query" id="search-query"
                                                   placeholder="Policy Number" v-model="policySearch.query"
                                            @keyup.enter="findPolicy">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-submit">Search</button>
                                        <p class="alt-search">
                                            <a href="{{ url('/customer') }}">
                                                Search by customer?
                                            </a>
                                        </p>
                                    </form>
                                    <div class="search-results" v-if="foundPolicies.length > 0">
                                        <div class="title clearfix">
                                            <h2 class="pull-left">Matching Policy:</h2>
                                        </div>
                                        <h4>@{{{ policyUrl() }}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection