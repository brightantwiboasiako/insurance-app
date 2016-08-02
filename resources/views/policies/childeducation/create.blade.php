@extends('layouts.app')

@section('title')
    Create Child Education Policy | {{ config('app.name') }}
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
    <script src="{{ asset('js/custom/vue-mixins.js') }}"></script>
    <script src="{{ asset('js/custom/policies/childeducation/policy.js') }}"></script>
@endsection


@section('content')
    <div class="row" id="vue-childeducation">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <header class="main-box-header clearfix">
                                <h2 class="pull-left">
                                    <i class="fa fa-plus-circle"></i> New Child Education Policy for {{ e($customer->name()) }}
                                </h2>
                                <div class="filter-block pull-right">
                                    <a class="btn-sm pull-right btn btn-primary mrg-b-sm" href="{{ url('policy/childeducation') }}">
                                        <i class="fa fa-arrow-left"></i> Child Education Home
                                    </a>
                                </div>
                            </header>

                            <div class="main-box-body clearfix">
                                <div class="new-policy-form">
                                    <form class="creation-policy" method="post" @submit.prevent="createPolicy">
                                        <input type="hidden" v-model="policy.customer_id"
                                                   value="{{ e($customer->id) }}"/>
                                            <div class="col-md-12">
                                                <div class="main-box-body clearfix">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="step-pane active" id="policy">
                                                                <br/>
                                                                <h4>Information Pertaining to the Policy</h4>
                                                                <div class="col-md-12">
                                                                    <label><i class="fa fa-briefcase"></i> POLICY</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" class="form-control validate[required,min[10]]" name="sum_assured"
                                                                           v-model="policy.policy_details.sum_assured"  placeholder="Sum Assured">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" class="form-control date datepicker validate[required]"
                                                                           v-model="policy.policy_details.issue_date" placeholder="Issue Date">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>PREMIUM PAYMENT</label>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" class="form-control validate" name="bank_name"
                                                                               v-model="policy.policy_details.bank.name" placeholder="Bank Name">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <input type="text" class="form-control" name="account_number"
                                                                           v-model="policy.policy_details.bank.account_number" placeholder="Account Number">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <select class="form-control validate[required]" name="mode_of_payment"
                                                                            v-model="policy.policy_details.mode_of_payment">
                                                                        @include('policies.includes.payment-methods')
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <select class="form-control validate[required]" name="payment_frequency"
                                                                            v-model="policy.policy_details.payment_frequency">
                                                                        @include('policies.includes.payment-frequencies')
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label><i class="fa fa-users" aria-hidden="true"></i> CHILDREN</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="col-md-12">
                                                                        <label>Add New Child</label>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <input class="form-control validate[required,maxSize[64]]" v-model="child.name"
                                                                               name="child_name" placeholder="Name"/>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <input class="form-control date datepicker validate[required]" v-model="child.birthday"
                                                                               name="child_birthday" placeholder="Date of Birth"/>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <select class="form-control" name="child_gender" v-model="child.gender">
                                                                            <option value="Male">Male</option>
                                                                            <option value="Female">Female</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <input class="form-control validate[required]" v-model="child.percentage"
                                                                               name="child_percentage" placeholder="Percentage (e.g 5 for 5%)"/>
                                                                    </div>
                                                                    <div class="form-group col-md-1">
                                                                        <button type="button" v-show="!editing" @click="addChild" class="btn btn-sm btn-primary">Add Child</button>
                                                                        <button type="button" v-show="editing" @click="editChild" class="btn btn-sm btn-primary">Save</button>
                                                                    </div>
                                                                    <div class="col-md-12" v-if="policy.children.length > 0">
                                                                        <div class="col-md-12">
                                                                            <label>Added Children</label>
                                                                        </div>
                                                                        <div class="col-md-12 table-responsive">
                                                                            <table class="table table-stripped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Name</th>
                                                                                    <th>Birth Day</th>
                                                                                    <th>Gender</th>
                                                                                    <th>Percentage</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr v-for="(key, child) in policy.children">
                                                                                    <td>@{{ (key + 1) }}</td>
                                                                                    <td>@{{ child.name }}</td>
                                                                                    <td>@{{ child.birthday }}</td>
                                                                                    <td>@{{ child.gender }}</td>
                                                                                    <td>@{{ child.percentage }}</td>
                                                                                    <td>
                                                                                        <button class="btn btn-default btn-xs" title="Edit"
                                                                                        @click="setEditableChild(key)" type=button>
                                                                                        <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button class="btn btn-danger btn-xs" title="Remove"
                                                                                        @click="removeChild(key)" type="button">
                                                                                        <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        @include('policies.childeducation.includes.creation.underwriting')
                                                                    </div>
                                                                    <div class="col-md-12 mrg-b-md">
                                                                        @include('policies.childeducation.includes.creation.agency')
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
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