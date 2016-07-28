@extends('layouts.app')

@section('title')
    Create Funeral Policy | {{ config('app.name') }}
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
    <script src="{{ asset('js/validation/validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/validationEngine.min.js') }}"></script>

    <!-- this page specific inline scripts -->
    <script type="text/javascript">
        $(document).ready(function() {

            setActiveLink('policy');

            $('.form-group').delegate('.date', 'focus', function(){
                $(this).datepicker({
                    format: 'yyyy-mm-dd',
                    endDate: new Date()
                })
            });
        });
    </script>

    <script src="{{ asset('js/wizard.js') }}"></script>
    <script src="{{ asset('js/custom/utils/customer.js') }}"></script>
    <script src="{{ asset('js/custom/vue-mixins.js') }}"></script>
    <script src="{{ asset('js/custom/policies/funeral/policy-creator.js') }}"></script>
@endsection


@section('content')
    <div class="row" id="vue-funeral">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <header class="main-box-header clearfix">
                                <h2 class="pull-left">
                                    <i class="fa fa-plus-circle"></i> New Funeral Policy for {{ e($customer->name()) }}
                                </h2>
                                <div class="filter-block pull-right">
                                    <a class="btn-sm pull-right btn btn-primary mrg-b-sm" href="{{ url('policy/funeral') }}">
                                        <i class="fa fa-arrow-left"></i> Funeral Home
                                    </a>
                                </div>
                            </header>

                            <div class="main-box-body clearfix">
                                <div class="new-policy-form">
                                    <form class="creation-policy" method="post" @submit.prevent="createPolicy">
                                        <input type="hidden" v-model="newPolicy.customer_id"
                                                   value="{{ e($customer->id) }}"/>
                                            <div class="col-md-12">
                                                <div class="main-box-body clearfix">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @include('policies.funeral.includes.creation.policy')
                                                        </div>
                                                        <div class="col-md-12">
                                                            @include('policies.funeral.includes.creation.underwriting')
                                                        </div>
                                                        <div class="col-md-12">
                                                            @include('policies.funeral.includes.creation.beneficiaries')
                                                        </div>
                                                        <div class="col-md-12 mrg-b-md">
                                                            @include('policies.funeral.includes.creation.agency')
                                                        </div>
                                                        <hr>
                                                        <div class="col-md-12">
                                                            <button class="btn btn-default" type="reset">Reset</button>
                                                            <button class="btn btn-primary" type="submit">Create Policy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div><!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection