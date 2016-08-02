@extends('layouts.app')

@section('title')
    {{ config('policy.loanprotection.name') }} | {{ config('app.name') }}
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

            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                endDate: new Date()
            });

        });
    </script>

    <script src="{{ asset('js/wizard.js') }}"></script>
    <script src="{{ asset('js/custom/vue-mixins.js') }}"></script>
    <script src="{{ asset('js/custom/policies/loanprotection/loanprotection.js') }}"></script>
@endsection


@section('content')
    <div class="row" id="vue-loanprotection">
        <input type="hidden" v-model="policy.number" value="{{ e($policy->policyNumber()) }}"/>
        <input type="hidden" v-model="borrowers" value="{{ e($policy->loanBorrowers()) }}"/>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <header class="main-box-header clearfix">
                                <h2 class="pull-left">
                                    <i class="fa fa-institution"></i> Policy for {{ e($policy->institutionName()) }}
                                </h2>
                                <div class="filter-block pull-right">
                                    <a class="btn-sm pull-right btn btn-primary mrg-b-sm" href="{{ url('policy/document/loanprotection/'.e($policy->policyNumber())) }}">
                                        <i class="fa fa-file"></i> Policy Document
                                    </a>
                                    <a class="btn-sm pull-right btn btn-primary mrg-b-sm" href="{{ url('policy/loanprotection') }}">
                                        <i class="fa fa-arrow-left"></i> Loan Protection Home
                                    </a>
                                </div>
                            </header>

                            <div class="main-box-body">
                                <div class="clearfix">
                                    <h4 class="pull-left">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        Loans | <span class="badge">@{{ totalPagerItems() }}</span> total |
                                        <strong class="text-danger">AMOUNT {{ e($policy->totalLoanAmount()) }}</strong> |
                                        <strong class="text-success">PREMIUM {{ e($policy->premium()) }}</strong>
                                    </h4>
                                    <h4 class="pull-right">
                                        @include('policies.loanprotection.modals.add-borrower')
                                        <button class="btn btn-default btn-xs" data-toggle="modal"
                                                data-target=".add-borrower-form">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Loan
                                        </button>
                                        @include('policies.loanprotection.modals.upload-borrowers')
                                        <button class="btn btn-primary btn-xs" data-toggle="modal"
                                                data-target=".upload-borrowers-form">
                                            <i class="fa fa-upload" aria-hidden="true"></i> Upload Loans
                                        </button>
                                    </h4>
                                </div>
                                <div class="clearfix">
                                    <form class="form-inline">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Showing</span>
                                                    <input type="text" class="form-control" v-model="perPage">
                                                    <span class="input-group-addon">
                                                        on page <span class="badge">@{{ currentPage }}</span>
                                                        of <span class="badge">@{{ totalPages() }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-search"></i> Find</span>
                                                    <input type="text" class="form-control" v-model="query" placeholder="Search for">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">Loan & Premium</th>
                                            <th colspan="4" class="text-center">Borrower</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>Premium</th>
                                            <th>Issue Date</th>
                                            <th class="text-center">Term (Years)</th>
                                            <th>Maturity Date</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Phone Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(key, borrower) in pageData">
                                                <td>@{{ key + 1 }}</td>
                                                <td>@{{{ moneyFromRaw(borrower.loan_amount) }}}</td>
                                                <td>@{{{ moneyFromRaw(borrower.premium) }}}</td>
                                                <td>@{{ date(borrower.issue_date) }}</td>
                                                <td class="text-center">@{{ borrower.term }}</td>
                                                <td>@{{ date(borrower.maturity_date) }}</td>
                                                <td>@{{ borrower.name }}</td>
                                                <td>@{{ borrower.gender }}</td>
                                                <td>@{{ date(borrower.birthday) }}</td>
                                                <td>@{{ borrower.phone }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-sm btn-default" @click="previousPage">Previous</button>
                                    <button class="btn btn-sm btn-primary" @click="nextPage">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection