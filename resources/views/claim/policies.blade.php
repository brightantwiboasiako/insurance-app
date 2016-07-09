@extends('layouts.app')

@section('title')
    Customer Policies | {{ config('app.name') }}
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
          
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$customer->first_name}} {{$customer->surname}}'s Policies
                    </div>
                        @if (count($funerals) > 0)
                            <div class="panel-body">
                                <table class="table table-striped">
                                <h3><span class="label label-primary">Funeral Policies</span></h3>
                                    <thead>
                                        <th>Policy Number</th>
                                        <th>Sum Assured</th>
                                        <th>Underwriting Premium</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($funerals as $funeral)
                                            <tr>
                                                <td class="table-text"><div>{{ $funeral->policy_number }}</div></td>
                                                <td class="table-text"><div>{{ $funeral->sum_assured }}</div></td>
                                                <td class="table-text"><div>{{ $funeral->underwriting_premium }}</div></td>

                                                <td>
                                                   <!-- <form action="/claim/{{ $customer->id }}" method="POST">
                                                        {{ csrf_field() }}-->

                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#f{{$funeral->id}}">
                                                            <i class="fa fa-btn fa-calculator"></i> <strong>Claim</strong>
                                                        </button>
                                                  <!--  </form>-->
                                                  <div class="modal fade" id="f{{$funeral->id}}">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                                  <h3 class="modal-title">Funeral Policy</h3>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p>You are about to register a claim on this policy.</p>
                                                                  <p>Policy number {{$funeral->policy_number}}: <br>
                                                                  This policy has a sum assured of GHc {{$funeral->sum_assured}} and an underwriting premium of GHc {{$funeral->underwriting_premium}}. Confirm this policy and register claim.</p>
                                                              </div>

                                                              <div class="modal-footer">
                                                                <form action="/claim/registered" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="policy_number" value="{{$funeral->policy_number}}">
                                                                    <input type="hidden" name="sum_assured" value="{{$funeral->sum_assured}}">
                                                                    <input type="hidden" name="identifier" value="{{$funeral->identifier}}">
                                                                    <input type="hidden" name="status" value="0">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-btn fa-calculator"></i> <strong>Register Claim</strong>
                                                                    </button>
                                                                </form>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        @if (count($motors) > 0)
                            <div class="panel-body">
                                <table class="table table-striped">
                                <h3><span class="label label-primary">Motor Policies</span></h3>
                                    <thead>
                                        <th>Policy Number</th>
                                        <th>Sum Assured</th>
                                        <th>Underwriting Premium</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($motors as $motor)
                                            <tr>
                                                <td class="table-text"><div>{{ $motor->policy_number }}</div></td>
                                                <td class="table-text"><div>{{ $motor->sum_assured }}</div></td>
                                                <td class="table-text"><div>{{ $motor->underwriting_premium }}</div></td>

                                                <td>
                                                   <!-- <form action="/claim/{{ $customer->id }}" method="POST">
                                                        {{ csrf_field() }}-->

                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m{{$motor->id}}">
                                                            <i class="fa fa-btn fa-calculator"></i> <strong>Claim</strong>
                                                        </button>
                                                  <!--  </form>-->
                                                  <div class="modal fade" id="m{{$motor->id}}">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                                  <h3 class="modal-title">Motor Policy</h3>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p>You are about to register a claim on this policy.</p>
                                                                  <p>Policy number {{$motor->policy_number}}: <br>
                                                                  This policy has a sum assured of GHc {{$motor->sum_assured}} and an underwriting premium of GHc {{$motor->underwriting_premium}}. Confirm this policy and register claim.</p>
                                                              </div>

                                                              <div class="modal-footer">
                                                                <form action="/claim/registered" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="policy_number" value="{{$motor->policy_number}}">
                                                                    <input type="hidden" name="sum_assured" value="{{$motor->sum_assured}}">
                                                                    <input type="hidden" name="identifier" value="{{$motor->identifier}}">
                                                                    <input type="hidden" name="status" value="0">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-btn fa-calculator"></i> <strong>Register Claim</strong>
                                                                    </button>
                                                                </form>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                
            

                        @if (count($lifes) > 0)
                            <div class="panel-body">
                                <table class="table table-striped">
                                <h3><span class="label label-primary">Life Policies</span></h3>
                                    <thead>
                                        <th>Policy Number</th>
                                        <th>Sum Assured</th>
                                        <th>Underwriting Premium</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($lifes as $life)
                                            <tr>
                                                <td class="table-text"><div>{{ $life->policy_number }}</div></td>
                                                <td class="table-text"><div>{{ $life->sum_assured }}</div></td>
                                                <td class="table-text"><div>{{ $life->underwriting_premium }}</div></td>

                                                <td>
                                                   <!-- <form action="/claim/{{ $customer->id }}" method="POST">
                                                        {{ csrf_field() }}-->

                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#l{{$life->id}}">
                                                            <i class="fa fa-btn fa-calculator"></i> <strong>Claim</strong>
                                                        </button>
                                                  <!--  </form>-->
                                                  <div class="modal fade" id="l{{$life->id}}">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                                  <h3 class="modal-title">Life Policy</h3>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p>You are about to register a claim on this policy.</p>
                                                                  <p>Policy number {{$life->policy_number}}: <br>
                                                                  This policy has a sum assured of GHc {{$life->sum_assured}} and an underwriting premium of GHc {{$life->underwriting_premium}}. Confirm this policy and register claim.</p>
                                                              </div>

                                                              <div class="modal-footer">
                                                                <form action="/claim/registered" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="policy_number" value="{{$life->policy_number}}">
                                                                    <input type="hidden" name="sum_assured" value="{{$life->sum_assured}}">
                                                                    <input type="hidden" name="identifier" value="{{$life->identifier}}">
                                                                    <input type="hidden" name="status" value="0">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-btn fa-calculator"></i> <strong>Register Claim</strong>
                                                                    </button>
                                                                </form>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                </div>
    </div>

@endsection