@extends('layouts.app')

@section('title')
    {{ e($policy->policyNumber()) }} | Document
@endsection

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
            padding-left: 30px;
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
            padding: 10px 200px;
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

    </style>
@endsection

@section('js')

    <script>

        new Vue({

            el: '.policy-document',
            data: {
                page: 2
            },

            methods: {
                toPage: function(page){
                    this.page = page;
                }
            }

        });

    </script>

@endsection

@section('content')
    <div class="policy-document">
        <div class="controls">
            <button type="button" @click="toPage(1)" class="btn btn-xs btn-primary">Page 1</button>
            <button type="button" @click="toPage(2)" class="btn btn-xs btn-primary">Page 2</button>
            <button type="button" @click="toPage(3)" class="btn btn-xs btn-primary">Page 3</button> |
            <a href="" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Print</a>
            <a href="{{ url('policy/funeral') }}"
               class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Funeral Home</a>
        </div>
        @include('policies.funeral.document.front')
        @include('policies.funeral.document.coverage')
    </div>
@endsection