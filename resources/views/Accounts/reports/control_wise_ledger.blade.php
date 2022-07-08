@extends('home')
@section('title', 'Control Wise Subsidiary Ledger | report')

@section('content')

    <div class="page-body">
      <div class="container-xl">
        <div class="voucher voucher-cards">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('accounts.control.wise.ledger') }}">
                    <div class="card-header" >
                        <h1 class="card-title text-center">Control Wise Ledger</h1>
                            @csrf
                            <div class="row" style="width:100%">
                                <div class="col-1">
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <select name="companyId" class="form-control" id="exampleSelect" required>
                                            @foreach($companies as $company)
                                                <option {{ ($companyId == $company->id) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <select name="accHeadId" class="form-control chosen-select" id="exampleSelect" required> 
                                            <!-- <option selected disabled>Select Acc Head</option>     -->
                                            @foreach($controlWiseLedger as $acc)
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
                                <th align="center">Accounts</th>
                                <th align="center" colspan="2">Opening</th>
                                <th align="center" colspan="2">Transaction </th>
                                <th align="center" colspan="2">Closing Balance</th>
                            </tr>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Debit </th>
                                <th scope="col">Credit </th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $total_op = 0;   $total_bal = 0;
                            
                            $total_op_debit = 0;
                            $total_op_credit = 0;
                            
                            $total_tr_debit = 0;
                            $total_tr_credit = 0;
                            
                            $total_bal_debit = 0;
                            $total_bal_credit = 0;
                                
                        ?>
                        
                            @foreach($vouchers as $key => $voucher)
                                <?php 
                                    $op  = $voucher->op_debit - $voucher->op_credit;
                                    if($op>0) $total_op_debit += $op;
                                    if($op<0) $total_op_credit += $op;
                                    $bal = $op + $voucher->tr_debit -  $voucher->tr_credit;
                    
                                    $total_op = $total_op + $op;
                                    $total_bal  = $total_bal + $bal;
                    
                                    $total_tr_debit = $total_tr_debit + $voucher->tr_debit;
                                    $total_tr_credit = $total_tr_credit + $voucher->tr_credit;
                                    
                                    if($bal>0) $total_bal_debit = $total_bal_debit + $bal;
                                    if($bal<0) $total_bal_credit = $total_bal_credit + $bal;
                                ?>
                                
                                <tr>
                                    <td width="10%"><b>{{ $voucher->accHead }}</b></td>
                                    <td width="10%">{{ $voucher->op_debit }}</td>
                                    <td width="10%">{{ $voucher->op_credit }}</td>
                                    <td width="10%">{{ $voucher->tr_debit }}</td>
                                    <td width="10%">{{ $voucher->tr_credit }}</td>
                                    <td align="right" width="10%">{{ $bal > 0 ? number_format($bal,2):'0.00'}}</td>
                                    <td align="right" width="10%">{{ $bal < 0 ? number_format(abs($bal),2) :'0.00'}}</td>
                                </tr>
                                
                            @endforeach
                            <tr>
                                <td align="right"><b>Total:</b></td>
                                <td align="right"><b>{{ number_format($total_op_debit,2) }}</b></td>
                                <td align="right"><b>{{ number_format(abs($total_op_credit),2) }}</b></td>
                                <td align="right"><b>{{ number_format($total_tr_debit,2) }}</b></td>
                                <td align="right"><b>{{ number_format(abs($total_tr_credit),2) }}</b></td>
                                <td align="right"><b>{{ number_format($total_bal_debit,2) }}</b></td>
                                <td align="right"><b>{{ number_format(abs($total_bal_credit),2) }}</b></td>
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