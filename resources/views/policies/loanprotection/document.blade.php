@extends('layouts.app')

@section('title')
    {{ e($policy->policyNumber()) }} | Document
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/funeral.css') }}"/>
@endsection

@section('js')

    <script>

        new Vue({

            el: '.policy-document',
            data: {
                page: 1
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
            <button type="button" @click="toPage(2)" class="btn btn-xs btn-primary">Page 2</button> |
            <a target="_blank" href="{{ url('policy/document/loanprotection/'.e($policy->policyNumber()).'/download') }}" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Print</a>
            <a href="{{ url('policy/loanprotection') }}"
               class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Loan Protection Home</a>
        </div>
        @include('policies.loanprotection.document.front')
        @include('policies.loanprotection.document.borrowers')
    </div>
@endsection