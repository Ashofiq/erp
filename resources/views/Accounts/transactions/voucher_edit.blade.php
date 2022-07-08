@extends('home')
@section('title', $title)

@section('script')
<script src="{{asset('public/dist/custom/transaction.js')}}"></script>
@endsection

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ $title }} Edit
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
               
                  <a href="{{ route('accounts.acc.trans.index', $typeNo) }}" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-blockquote" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M6 15h15"></path>
                      <path d="M21 19h-15"></path>
                      <path d="M15 11h6"></path>
                      <path d="M21 7h-6"></path>
                      <path d="M9 9h1a1 1 0 1 1 -1 1v-2.5a2 2 0 0 1 2 -2"></path>
                      <path d="M3 9h1a1 1 0 1 1 -1 1v-2.5a2 2 0 0 1 2 -2"></path>
                    </svg>                    
                      
                    List
                  </a>
               
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
          @include('extras.__message')

            <div class="card">
            <form method="POST" action="{{ route('accounts.acc.trans.update', $vouchers->id) }}">
              @csrf
              <div class="card-body border-bottom py-3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-label">Company</div>
                    <select name="companyId" class="form-select chosen-select" id="companyId">
                      
                      @foreach($companies as $company)
                        <option {{ ($company->id == $vouchers->companyId) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                      @endforeach
                    </select>
                   
                  </div>

                  <div class="col-md-4">
                    <div class="form-label">Financial Year</div>
                    <input class="form-control" type="text" value="{{ $financialYear->fromDate }} to {{ $financialYear->toDate }}" readonly>
                    <input type="hidden" name="fiscalYearId" value="{{ $financialYear->id }}">

                  </div>

                  <div class="col-md-4">
                    <div class="form-label">Transaction Date</div>
                    <div class="input-group">
                      <input id="transactionDate" value="{{ Helper::dateEnToBn($vouchers->date) }}" type="text" name="transactionDate" class="form-control date" readonly="readonly" />
                      <label class="input-group-btn" for="txtDate">
                          <span class="btn btn-default">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>
                          </span>
                      </label>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="form-label">Narration</div>
                    <textarea name="narration" class="form-control" name="example-textarea-input" rows="1" required>{{ $vouchers->narration }}</textarea>
                  </div>

                  <div class="col-md-4">
                    <div class="form-label">Voucher Type</div>
                    <input class="form-control" type="text" name="transType" value="{{ $vouchers->transType }}" readonly>
                  </div>
                </div>
                
              </div>
              <div class="table-responsive" style="height:300px">
                <table class="table card-table table-vcenter table-striped" id="accTable">
                  <thead>
                    <tr>
                      <th class="w-1">ID</th>
                      <th>Head of Accounting</th>
                      <th>Description</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th align="right" class="text-end">
                        <!-- <a  class="btn btn-sm btn-primary" onclick="addNewRaw()">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                          Add
                        </a> -->
                      </th>
                         
                    </tr>
                  </thead>
                  <tbody >
                    @foreach($vouchers->details as $key => $row)
                    <tr>
                      <td width="3%">{{ $key + 1 }}</td>
                      <td width="30%">
                          <select name="accHead[]" class="form-select chosen-select" id="accHead_{{ $key + 1 }}" >
                            @foreach($acchead as $acH)
                                <option {{ $acH->id == $row->chartOfAccId  ? 'selected' : '' }} value="{{ $acH->id }}">{{ $acH->accHead }} </option>
                            @endforeach
                          </select>
                      </td>
                      <td width="20%">
                        <input class="form-control" value="{{ $row->description }}" type="text" name="description[]" id="description_{{ $key + 1 }}" placeholder="description">
                      </td>
                      <td width="15%">
                        <input class="form-control numeric changesDebit" value="{{ $row->dAmount }}" type="text" name="dAmount[]" id="debit_{{ $key + 1 }}" placeholder="0.00">
                      </td>
                      <td width="15%">
                        <input class="form-control numeric changesCredit" value="{{ $row->cAmount }}" type="text" name="cAmount[]" id="credit_{{ $key + 1 }}" placeholder="0.00">
                      </td>
                      <td width="7%" class="text-end">
                        <button class="btn btn-sm btn-red text-center" onclick="removeRow(this)">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M4 7h3m4 0h9" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="14" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" /><line x1="18.384" y1="14.373" x2="19" y2="7" /><path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>

                        </button>
                      </td>
                    </tr>
                    <input value="{{ $row->id }}" type="hidden" name="accDetailsId[]" >

                    @endforeach
                  </tbody>
                </table>

                
              </div>
              <div class="card-footer text-end">
                <!-- save button -->
                <div class="d-flex">
                    <button type="submit" class="btn btn-success ">
                      Save 
                    </button>

                    <ul class="list-group list-group-horizontal-sm ms-auto" style="height: 41px">
                      <li class="list-group-item"><b>Total Debit: 
                        <span id="total_debit">0.00</span></b>
                        <input type="hidden" class="ms-auto" id="total_debit_in" value="0.00">
                      </li>
                      <li class="list-group-item"><b>Total Credit : <span id="total_credit">0.00</span></b>
                        <input type="hidden" class="ms-auto" id="total_credit_in" value="0.00">
                      </li>
                    </ul>

                    <a type="submit" class="btn btn-primary ms-auto" onclick="addNewRaw()">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                      Add
                    </a>
                  
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>

      
      function setAccHead(i){
        const global = new Global();
        var companyId = $('#companyId').val();
        var url = "{{ route('accounts.acchead', [$typeNo, 0]) }}";
        var url = url.replace("0", companyId);  
        console.log('companyId', companyId);
        global.sendReq(url, '', method = 'GET', function(response){
          console.log("ok", response);
          global.setChosenValue(response, 'accHead_'+i, 'Acc Head')
        });
      }

      // add new Raw
      function addNewRaw() {
        var i = $('#accTable tr').length;
        html = '<tr>';
        html += '<td width="3%">'+ i +'</td>';
        html += '<td width="30%">';
        html += '<select name="accHead[]" class="form-select chosen-select" id="accHead_'+ i +'">';
        html += '</select>';
        html += '</td>';
        html += '<td width="20%">';
        html += '<input class="form-control" type="text" name="description[]" id="description_'+ i +'" placeholder="description">';
        html += '</td>';
        html += '<td width="15%">';
        html += '<input class="form-control changesDebit" type="text" name="dAmount[]" id="debit_'+ i +'" placeholder="0.00">';
        html += '</td>';
        html += '<td width="15%">';
        html += '<input class="form-control changesCredit" type="text" name="cAmount[]" id="credit_'+ i +'" placeholder="0.00">';
        html += '</td>';
        html += '<td width="7%" class="text-end">';
        html += '<button class="btn btn-sm btn-red text-center" onclick="removeRow(this)">';
        html += '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M4 7h3m4 0h9" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="14" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" /><line x1="18.384" y1="14.373" x2="19" y2="7" /><path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
        html += '</button>';
        html += '</td>';
        html += '<tr>';

        $('#accTable').append(html);
        setAccHead(i);
        return false;
      }

      function removeRow (el) {
        $(el).parents("tr").remove()
        // totalAmount()
      }

      
    </script>
              
@endsection