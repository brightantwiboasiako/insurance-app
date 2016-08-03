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
            <a target="_blank" href="{{ url('policy/document/childeducation/'.e($policy->policyNumber()).'/download') }}" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Print</a>
            <a href="{{ url('policy/childeducation') }}"
               class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Child Education Home</a>
        </div>
        @include('policies.childeducation.document.front')
        @include('policies.childeducation.document.children')
    </div>
@endsection