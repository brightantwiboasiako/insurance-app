@extends('layouts.app')

@section('title')
    Dashboard | {{ config('app.name') }}
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/form-validation.css') }}"/>
@endsection


@section('js')
    <script src="{{ asset('js/custom/auth.js') }}"></script>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div id="content-header" class="clearfix">
                        <div class="pull-left">
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li class="active"><span>Dashboard</span></li>
                            </ol>

                            <h1>Dashboard</h1>
                        </div>

                        @include('includes.quick-summary')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored emerald-bg">
                        <i class="fa fa-envelope"></i>
                        <span class="headline">Messages</span>
                        <span class="value">4.658</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored green-bg">
                        <i class="fa fa-money"></i>
                        <span class="headline">Orders</span>
                        <span class="value">22.631</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored red-bg">
                        <i class="fa fa-user"></i>
                        <span class="headline">Users</span>
                        <span class="value">92.421</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored purple-bg">
                        <i class="fa fa-globe"></i>
                        <span class="headline">Visits</span>
                        <span class="value">13.298</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2 class="pull-left">Sales &amp; Earnings</h2>
                        </header>

                        <div class="main-box-body clearfix">
                            <div class="row">
                                <div class="col-md-9">
                                    <div id="graph-bar" style="height: 240px; padding: 0px; position: relative;"></div>
                                </div>
                                <div class="col-md-3">
                                    <ul class="graph-stats">
                                        <li>
                                            <div class="clearfix">
                                                <div class="title pull-left">
                                                    Earnings
                                                </div>
                                                <div class="value pull-right" title="10% down" data-toggle="tooltip">
                                                    &dollar;94.382 <i class="fa fa-level-down red"></i>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div style="width: 69%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="69" role="progressbar" class="progress-bar">
                                                    <span class="sr-only">69% Complete</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="clearfix">
                                                <div class="title pull-left">
                                                    Orders
                                                </div>
                                                <div class="value pull-right" title="24% up" data-toggle="tooltip">
                                                    3.930 <i class="fa fa-level-up green"></i>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div style="width: 42%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="42" role="progressbar" class="progress-bar progress-bar-danger">
                                                    <span class="sr-only">42% Complete</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="clearfix">
                                                <div class="title pull-left">
                                                    New Clients
                                                </div>
                                                <div class="value pull-right" title="8% up" data-toggle="tooltip">
                                                    894 <i class="fa fa-level-up green"></i>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div style="width: 78%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="78" role="progressbar" class="progress-bar progress-bar-success">
                                                    <span class="sr-only">78% Complete</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="clearfix">
                                                <div class="title pull-left">
                                                    Visitors
                                                </div>
                                                <div class="value pull-right" title="17% down" data-toggle="tooltip">
                                                    824.418 <i class="fa fa-level-down red"></i>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div style="width: 94%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="94" role="progressbar" class="progress-bar progress-bar-warning">
                                                    <span class="sr-only">94% Complete</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection