@extends('home')
@section('title', 'Dashboard')

@section('content')
    <div class="page-body" id="app">
      <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-3">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Summary</h3>
                  </div>
                  <table class="table card-table table-vcenter">
                    <thead>
                      <tr>
                        <th colspan="2">A/C Head</th>
                        <th >Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($summary as $row)
                      <tr>
                        <td colspan="2">{{ $row->accHead }}</td>
                        <td>{{ $row->dAmount }}</td>
                        <!-- <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                          </div> -->
                        </td>
                      </tr>
                      @endforeach
                
                   
                    
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title text-center">Quick Access</h3>
                    </div>
                </div>

                <div class="row pt-1">
                    <div class="col-md-4">
                        <a class="card card-link" href="#">
                            <div class="card-body">
                                <div class="row">
                                    <span class="bg-blue text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                                    </span>
                                    <div class="col">
                                        <div class="font-weight-medium">Balance Sheet</div>
                                        <div class="text-muted">Balance</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a class="card card-link" href="{{ route('accounts.trial.balance') }}">
                            <div class="card-body">
                                <div class="row">
                                    <span class="bg-blue text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                                    </span>
                                    <div class="col">
                                        <div class="font-weight-medium">Trial Balance</div>
                                        <div class="text-muted">Balance</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a class="card card-link" href="{{ route('accounts.liquid.cash') }}">
                            <div class="card-body">
                                <div class="row">
                                    <span class="bg-blue text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                                    </span>
                                    <div class="col">
                                        <div class="font-weight-medium">Cash Statement</div>
                                        <div class="text-muted">Statement</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
       </div>
    </div>
@endsection