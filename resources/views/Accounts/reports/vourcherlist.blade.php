@extends('home')
@section('title', 'Journal Voucher Create')

@section('content')

    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" >
                <h1 class="card-title text-center">Voucher Report</h1>
                    <form method="post" action="{{ route('accounts.acctrans.voucher.list') }}">
                        @csrf
                        <div class="row text-end" style="width:100%">
                            <div class="col-1">
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select name="companyId" class="form-control" id="exampleSelect">
                                        @foreach($companies as $company)
                                            <option {{ ($companyId == $company->id) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <select name="transType" class="form-control" id="exampleSelect" required>
                                    <option selected disabled>Select Type</option>
                                    @foreach($transTypes as $key => $type)
                                        <option {{ ($transType == $key) ? 'selected' : '' }} value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input name="fromDate" type="text" class="form-control date" placeholder="Form Date" value="{{ Helper::dateEnToBn($fromDate) }}">
                            </div>
                            <div class="col-2">
                                <input name="toDate" type="text" class="form-control date" placeholder="To Date" value="{{ Helper::dateEnToBn($toDate) }}">
                            </div>
                            <div class="col-1">
                                <input type="submit" class="btn btn-success " placeholder="Last name" aria-label="Last name">
                            </div>
                        
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Voucher No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Account Name	</th>
                                <th scope="col">Narration</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $totalDebit = 0; 
                                $totalCredit = 0; 
                            ?>
                            @foreach($vouchers as $voucher)

                                @foreach($voucher->details as $key => $row)
                                    <tr>
                                        <td width="10%">
                                        <b>{{ $voucher->vourcher_no  }}</b>
                                        </td>
                                        <td width="10%">
                                            {{ Helper::dateEnToBn($voucher->date) }}
                                        </td>
                                        <td width="20%">{{ $row->accHead }}</td>
                                        <td width="30%">{{ $voucher->narration }}</td>
                                        <td width="10%" align="right"> {{ $row->dAmount }}</td>
                                        <td width="10%" align="right"> {{ $row->cAmount  }}</td>
                                    </tr>

                                    <?php 
                                        $totalDebit += $row->dAmount; 
                                        $totalCredit += $row->cAmount; 
                                    ?>
                                @endforeach
                            @endforeach

                                    <tr>
                                        <td colspan="4" align="right">
                                            <b>Total: </b>
                                        </td>
                                       
                                        <td width="10%" align="right"> <b>{{ $totalDebit }}</b></td>
                                        <td width="10%" align="right"> <b>{{ $totalCredit  }}</b></td>
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