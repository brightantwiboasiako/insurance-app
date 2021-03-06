@extends('layouts.print')

@section('css')
    <style>
        .policy-document{
            background-color: #fff;
            font-size: 12px !important;
            border: 2px solid rgba(0,0,0,.4);
            padding: 10px 20px;
            margin-top: -5px;
            position: relative;
        }
        .policy-document .title{
            text-align: center;
        }

        .policy-document .logo{
            clear: both;
            margin: 5px auto;
            border: 2px solid rgba(0,0,0,1);
            width: 300px;
            text-align: center;
            /*overflow: hidden;*/
        }

        .policy-document .business{
            font-family: Comic Sans MS, sans-serif;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 15px auto;
            padding-bottom: 10px;
            border-bottom: 3px solid rgba(0,0,0,1);
        }

        .policy-document .policy-summary{
            font-size: 12px!important;
        }

        .policy-document .border-bottom-3{
            border-bottom: 3px solid rgba(0,0,0,1);
        }

        .policy-document .dashed-bottom-1{
            border-bottom: 1px dashed rgba(0,0,0,1);
        }

        .policy-document .page-info{
            text-align: left!important;
            padding: 15px;
            font-size: 15px;
        }

        .policy-document .premium{
            padding: 10px;
        }

        .policy-document .terms{
            padding: 15px;
            font-size: 15px;
        }

        .policy-document .controls{
            position: absolute;
            right: 10px;
        }

        .policy-document .coverage h2{
            text-align: center;
        }

        .policy-document .coverage.title{
            text-align: left!important;
            font-size: 12px;
        }

        .policy-document .coverage td{
            padding: 6px 4px!important;
            border:none!important;
        }

        .border-top-1{
            border-top: 1px solid #000!important;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
@endsection

@section('content')
    <div class="policy-document">
        @include('policies.funeral.document.front')
        <div class="page-break"></div>
        @include('policies.funeral.document.coverage')
        <div class="page-break"></div>
        @include('policies.funeral.document.details')
    </div>
@endsection