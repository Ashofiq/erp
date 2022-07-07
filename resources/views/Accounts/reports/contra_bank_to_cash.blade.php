@extends('home')
@section('title', 'Subsidiary Ledger | report')

@section('content')

    <div class="page-body">
      <div class="container-xl">
        <div class="voucher voucher-cards">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('accounts.contra.bank.to.cash') }}">
                    <div class="card-header" >
                        <h1 class="card-title text-center">Contra Bank To Cash </h1>
                            @csrf
                            <div class="voucher d-flex" style="width:100%">
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
                                <td align="right" colspan="3">Bank To Cash</td>
                            </tr>
                            <tr>
                                <th scope="col">Account Name</th>
                                <th scope="col">Date </th>
                                <th scope="col">Debit(Cash) </th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            
                            $total_debit = 0;
                            $total_credit = 0;
                                
                        ?>
                        
                            @foreach($vouchers as $key => $voucher)
                                <?php 
                                    $total_debit += $voucher->dAmount;
                                    $total_credit += $voucher->cAmount;
                                ?>
                                
                                <tr>
                                    <td width="10%"><b>{{ $voucher->accHead }}</b></td>
                                    <td width="10%">{{ Helper::dateEnToBn($voucher->date)}}</td>
                                    <td width="10%" align="right">{{ $voucher->cAmount }}</td>
                                </tr>
                                
                            @endforeach

                                <tr>
                                    <td width="10%" align="right" colspan="2"><b>Total: </b></td>
                                    <td width="10%" align="right"><b>{{ $total_credit }}</b></td>
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