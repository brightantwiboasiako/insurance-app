@extends('layouts.app')

@section('title')
    Claims Payment | {{ config('app.name') }}
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">

            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><strong>Registered Claims</strong></h4>
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

                                                @if($claim->status==0)
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#f{{ $claim->id }}">
                                                        <i class="fa fa-btn fa-calculator"></i> <strong>Pay</strong>
                                                    </button>
                                              <div class="modal fade" id="f{{ $claim->id }}">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                              <h3 class="modal-title">Confirm Claim Payment</h3>
                                                          </div>
                                                          <div class="modal-body">
                                                              <p>You are about to pay out this claim.</p>
                                                              
                                                          </div>

                                                          <div class="modal-footer">
                                                          
                                                            <form action="/claim/update" method="POST">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $claim->id }}">
                                                                <input type="hidden" name="status" value="1">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fa fa-btn fa-calculator"></i> <strong>Pay Claim</strong>
                                                                </button>
                                                            </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              @else
                                                <button type="button" class="btn btn-success"><strong>Paid!</strong></button>
                                              @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
            </div>
        </div>
    </div>
@endsection