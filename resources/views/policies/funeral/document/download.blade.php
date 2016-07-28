@extends('layouts.print')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/funeral.css') }}"/>
@endsection

@section('content')
    <div class="policy-document">
        @include('policies.funeral.document.front')
        @include('policies.funeral.document.coverage')
        @include('policies.funeral.document.details')
    </div>
@endsection