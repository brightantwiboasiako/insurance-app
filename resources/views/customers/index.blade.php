@extends('layouts.app')

@section('title')
    Customers | {{ config('app.name') }}
@endsection


@section('css')
    <!-- this page specific styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/dataTables.tableTools.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/form-validation.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/nifty-component.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/libs/datepicker.css') }}" type="text/css" />
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

            setActiveLink('customer');

            $('#birth-day').datepicker({
                format: 'dd-mm-yyyy',
                endDate: new Date()
            });

        });
    </script>

    <script src="{{ asset('js/custom/utils/customer.js') }}"></script>
    <script src="{{ asset('js/custom/customer.js') }}"></script>
@endsection


@section('content')
    <div class="row" id="vue-customers">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div id="content-header" class="clearfix">
                        <div class="pull-left">
                            <ol class="breadcrumb">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li class="active"><span>Customers</span></li>
                            </ol>

                            <h1>Customers</h1>
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
                                <h2 class="pull-left"><i class="fa fa-circle-o"></i> Customers</h2>

                                @include('customers.modals.add-customer')

                                <div class="filter-block pull-right">
                                    <a data-toggle="modal" href="#modal-add-customer" class="btn-sm pull-right btn btn-primary mrg-b-lg">
                                        <i class="fa fa-plus-circle fa-lg"></i> Add Customer
                                    </a>
                                </div>
                            </header>

                            <div class="main-box-body clearfix">
                                @include('customers.includes.find-customer-form')
                                <div class="search-results v-cloak--hidden" v-if="found.length > 0">
                                    <div class="title clearfix">
                                        <h2 class="pull-left">Search Results:</h2>
                                        <h2 class="pull-right"><span class="badge">@{{ found.length }}</span> total</h2>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th><span>Name</span></th>
                                                <th><span>Email</span></th>
                                                <th class="text-center"><span>Phone Number</span></th>
                                                <th class="text-center"><span>Gender</span></th>
                                                <th class="text-center"><span>Birth Day</span></th>
                                                <th class="text-center"><span>Actions</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="customer in found" v-on:click="showEditForm(customer)">
                                                <td><i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    @{{{ getCustomerName(customer) }}}</td>
                                                <td>@{{ customer.email }}</td>
                                                <td class="text-center">@{{ customer.primary_phone_number }}</td>
                                                <td class="text-center">@{{ customer.gender }}</td>
                                                <td class="text-center">@{{ date(customer.birth_day) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row edit-form" style="display: none;">
                <div class="col-md-12">
                    <div class="main-box-body clearfix">
                        <form class="form-inline" name="edit-form" role="form" v-on:submit.prevent="modify">
                            <div class="input-group">
                                <select class="form-control w-80" v-model="selectedCustomer.title">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss.">Miss.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Rev.">Rev.</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input autofocus type="text" placeholder="Surname" class="form-control w-100 validate[required]"
                                       v-model="selectedCustomer.surname" name="surname">
                            </div>
                            <div class="input-group">
                                <input autofocus type="text" name="first_name"
                                       placeholder="First Name" class="form-control w-80" v-model="selectedCustomer.first_name">
                            </div>
                            <div class="input-group">
                                <input autofocus type="text" placeholder="Other Name" name="other_name"
                                       class="form-control w-100" v-model="selectedCustomer.other_name">
                            </div>
                            <div class="input-group">
                                <input autofocus type="text" placeholder="Email" name="email"
                                       class="form-control v-100" v-model="selectedCustomer.email">
                            </div>
                            <div class="input-group">
                                <input autofocus type="text" placeholder="Phone Number" name="primary_phone_number"
                                       class="form-control v-80" v-model="selectedCustomer.primary_phone_number">
                            </div>
                            <button type="submit" class="btn btn-success btn-submit">Modify</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection