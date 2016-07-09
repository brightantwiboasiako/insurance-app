@extends('layouts.app')

@section('title')
    Claim Registration | {{ config('app.name') }}
@endsection

@section('content')

<div class="container">

    <div class='col-sm-offset-1 col-sm-10'>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Search Customer
            </div>

            <div class="panel-body">
     
            <form action="{{ url('/claim/clients')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                <div class="form-group">
                    <label for="customer-name" class="col-sm-3 control-label"><strong>Search Customer</strong></label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder= " first name or surname" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-btn fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    @if(isset($query))
    <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Customers search Result
                </div>

                <div class="panel-body">
                    @if (count($customers) > 0)
                        <table class="table table-striped">
                            <thead>
                                <th>Surname</th>
                                <th>First Name</th>
                                <th>Other Name</th>
                                <th>Occupation</th>
                                <th>Phone Number</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="table-text"><div>{{ $customer->surname }}</div></td>
                                        <td class="table-text"><div>{{ $customer->first_name }}</div></td>
                                        <td class="table-text"><div>{{ $customer->other_name }}</div></td>
                                        <td class="table-text"><div>{{ $customer->occupation }}</div></td>
                                        <td class="table-text"><div>{{ $customer->primary_phone_number }}</div></td>

                                        <td>
                                            <form action="/claim/{{ $customer->id }}" method="POST">
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-briefcase"></i> <strong>Policies</strong>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <p>There is no client with surname or first name as "<strong>{{$query}}</strong>".</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
</div>

@endsection