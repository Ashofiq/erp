@extends('home')
@section('title', 'Subsidiary Ledger | report')

@section('content')

    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('accounts.acctrans.subsidary.ledger') }}">
                    <div class="card-header" >
                        <h1 class="card-title text-center">Subsidiary Ledger</h1>
                            @csrf
                            <div class="row d-flex" style="width:100%">
                                <div class="col-1">
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <select name="companyId" class="form-control" id="exampleSelect">
                                            @foreach($companies as $company)
                                                <option {{ ($companyId == $company->id) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <select name="accHeadId" class="form-control chosen-select" id="exampleSelect">
                                            <option selected disabled>Select Acc Head</option>    
                                            @foreach($accHeads as $acc)
                                                <option {{ ($accHeadId == $acc->id) ? 'selected' : '' }} value="{{ $acc->id }}">{{ $acc->accHead }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-2">
                                    <input name="fromDate" type="text" class="form-control date" placeholder="Form Date" value="{{ Helper::dateEnToBn($fromDate) }}">
                                </div>

                                <div class="col-2">
                                    <input name="toDate" type="text" class="form-control date" placeholder="Form Date" value="{{ Helper::dateEnToBn($toDate) }}">
                                </div>
                        
                                <div class="col-2">
                                    <input type="submit" class="btn btn-success " placeholder="Last name" aria-label="Last name">
                                </div>
                            
                            </div>
                        
                    </div>
                </form>
                <div class="table-responsive">

                    <table class="table card-table table-vcenter table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Narration</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $totalDebit = 0; 
                                $totalCredit = 0; 
                                $balance = 0;
                            ?>
                              <tr>
                                    <td colspan="5">
                                        Opening Balance
                                    </td>
                                   <?php 
                                    $opening = $opening->debit - $opening->credit;
                                    $total_Debit = 0;   $total_Credit = 0; ?> 
                                    <td width="10%" align="right"> <b>{{$opening}}</b></td>
                                </tr>
                            @foreach($vouchers as $key => $voucher)
                            <?php 
                                $balance = $opening + $voucher->dAmount - $voucher->cAmount;
                                $total_Debit = $total_Debit + $voucher->dAmount;
                                $total_Credit = $total_Credit + $voucher->cAmount; ?>
                                
                                <tr>
                                    <td width="10%">
                                        <b>{{ $voucher->date }}</b>
                                    </td>
                                    <td width="30%">
                                        {{ $voucher->narration }}
                                    </td>
                                    <td width="10%">{{ $voucher->vourcher_no }}</td>
                                    <td width="10%">{{ $voucher->dAmount }}</td>
                                    <td width="10%" align="right"> {{ $voucher->cAmount }}</td>
                                    <td width="10%" align="right"> {{ $balance  }}</td>
                                </tr>

                                
                            @endforeach

                                <tr>
                                    <td colspan="3" align="right">
                                        <b>Total:</b>
                                    </td>
                                    <td width="10%" align="right"> <b>{{ number_format($total_Debit, 0) }}</b></td>
                                    <td width="10%" align="right"> <b> {{ number_format($total_Credit, 0) }}</b></td>
                                    <td width="10%" align="right"> <b> {{ number_format($balance, 0)  }}</b></td>
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