@extends('layouts.app')

@section('title')
    Claims View | {{ config('app.name') }}
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
       
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center; margin-top: 0; margin-bottom: 0; "><strong>Claims</strong></h2>
                </div>
                    @if (count($claims) > 0)
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <th>Policy Type</th>
                                    <th>Policy Number</th>
                                    <th>Claim Amount</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    @foreach ($claims as $claim)
                                        <tr>
                                            <td class="table-text"><div> @foreach ($policyType as $policy)
                                                                            @continue($policy->id !== $claim->policy_type)
                                                                            <strong>{{ $policy->title }}</strong>
                                                                        @endforeach</div></td>
                                            <td class="table-text"><div>{{ $claim->policy_number }}</div></td>
                                            <td class="table-text"><div>{{ $claim->amount }}</div></td>

                                            <td>
                                              <form action="/claim/detail" >
                                                  {{ csrf_field() }}
                                                  <button type="submit" class="btn btn-primary">
                                                      <strong>Details</strong>
                                                  </button>
                                              </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div class="panel-body"><strong>No claim registered!</strong></div>
                    @endif
            </div>
        </div>
    </div>
@endsection