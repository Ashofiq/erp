@extends('home')
@section('title', 'Daily Cash Statement | report')

@section('content')

    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" >
                <h1 class="card-title text-center">Daily Cash Statement</h1>
                    <form method="post" action="{{ route('accounts.acctrans.cash.sheet') }}">
                        @csrf
                        <div class="row d-flex justify-content-center " >
                            <div class="col-1">
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="companyId" class="form-control" id="exampleSelect">
                                        @foreach($companies as $company)
                                            <option {{ ($companyId == $company->id) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                         
                            <div class="col-4">
                                <input name="fromDate" type="text" class="form-control date" placeholder="Form Date" value="{{ Helper::dateEnToBn($fromDate) }}">
                            </div>
                    
                            <div class="col-2">
                                <input type="submit" class="btn btn-success " placeholder="Last name" aria-label="Last name">
                            </div>
                        
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <div class="alert alert-primary text-center" role="alert">
                        <h2>Cash Statement</h2>
                    </div>
                    <table class="table card-table table-vcenter table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Head Of Account</th>
                                <th scope="col">Particulars</th>
                                <th scope="col">Received</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $totalDebit = 0; 
                                $totalCredit = 0; 
                            ?>
                              <tr>
                                    <td colspan="5">
                                        Opening Balance
                                    </td>
                               
                                    <td width="10%" align="right"> <b>11111</b></td>
                                </tr>
                            @foreach($cashData as $key => $voucher)

                                
                                <tr>
                                    <td width="10%">
                                        <b>{{ $key + 1  }}</b>
                                    </td>
                                    <td width="10%">
                                        {{ $voucher->accHead }}
                                    </td>
                                    <td width="30%">{{ $voucher->narration }}</td>
                                    <td width="10%">{{ $voucher->dAmount }}</td>
                                    <td width="10%" align="right"> {{ $voucher->cAmount }}</td>
                                    <td width="10%" align="right"> {{ $voucher->cAmount  }}</td>
                                </tr>

                                
                            @endforeach

                        </tbody>
                    </table>

                    <br>
                    <br>
                    <div class="alert alert-primary text-center" role="alert">
                        <h2>Bank Statement</h2>
                    </div>
                    <table class="table card-table table-vcenter table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Head Of Account</th>
                                <th scope="col">Amount	</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $bankTotal = 0; 
                            ?>
                            @foreach($bankData as $key => $bank)

                                
                                <tr>
                                    <td width="5%">
                                     {{ $key + 1 }}
                                    </td>
                                    <td width="10%">
                                        {{ $bank->accHead }}
                                    </td>
                                   
                                    <td width="10%" align="right"> {{ $bank->dAmount  }}</td>
                                </tr>

                            <?php 
                                $bankTotal += $bank->dAmount; 
                            ?>
                                
                            @endforeach
                                <tr>
                                    <td colspan="2" align="right">
                                        <b>Total: </b>
                                    </td>
                                   
                                    <td width="10%" align="right"><b> {{ $bankTotal  }}</b></td>
                                </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>



@endsection