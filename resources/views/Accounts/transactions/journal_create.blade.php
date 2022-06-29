@extends('home')
@section('title', 'Journal Voucher Create')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ $title }}
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
               
                  <a href="{{ route('settings.company.add') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Company
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
            <div class="card">
            
              <div class="card-body border-bottom py-3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-label">Company</div>
                    <select class="form-select chosen-select">
                      @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                      @endforeach
                      
                    </select>
                  </div>

                  <div class="col-md-4">
                    <div class="form-label">Financial Year</div>
                    <input class="form-control" type="text" name="fiscalYear" value="{{ $financialYear->fromDate }} to {{ $financialYear->toDate }}" readonly>
                  </div>

                  <div class="col-md-4">
                    <div class="form-label">Transaction Date</div>
                    <div class="input-group">
                      <input id="txtDate" value="{{ date('d-m-Y') }}" type="text" name="transactionDate" class="form-control date" readonly="readonly" />
                      <label class="input-group-btn" for="txtDate">
                          <span class="btn btn-default">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>
                          </span>
                      </label>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-label">Narration</div>
                    <textarea class="form-control" name="example-textarea-input" rows="1">Oh! Come and see </textarea>
                  </div>

                  <div class="col-md-4">
                    <div class="form-label">Voucher Type</div>
                    <input class="form-control" type="text" name="transType" value="{{ $transType }}" readonly>
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
                        <button  class="btn btn-sm btn-success" onclick="addNewRaw()">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                          Add
                        </button>
                      </th>
                         
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td width="20%">
                          <select class="form-select chosen-select" id="accHead_1">

                          </select>
                      </td>
                      <td>
                        <input class="form-control" type="text" name="description[]" id="description_1" placeholder="description">
                      </td>
                      <td width="20%">
                        <input class="form-control" type="text" name="debit[]" id="debit_1" placeholder="0.00">
                      </td>
                      <td width="20%">
                        <input class="form-control" type="text" name="credit[]" id="credit_1" placeholder="0.00">
                      </td>
                      <td width="7%" class="text-end">
                        <button class="btn btn-sm btn-red text-center" onclick="removeRow(this)">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M4 7h3m4 0h9" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="14" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" /><line x1="18.384" y1="14.373" x2="19" y2="7" /><path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>

                        </button>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <!-- save button -->
                <div class="row">
                  <div class="col-6 col-sm-4 col-md-2 col-xl py-3">
                    <a href="#" class="btn btn-success active w-100">
                      Save 
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>
      $(document).ready(function(){
        setAccHead(1)
      })
      
      function setAccHead(i){
        const global = new Global();
        var url = "{{ route('accounts.acchead', [1, 1]) }}";
        global.sendReq(url, '', method = 'GET', function(response){
          console.log("ok", response);
          global.setChosenValue(response, 'accHead_'+i, 'Acc Head')
        });
      }

      // add new Raw
      function addNewRaw() {
        var i = $('#accTable tr').length - 1;
        html = '<tr>';
        html += '<td>'+ i +'</td>';
        html += '<td width="20%">';
        html += '<select class="form-select chosen-select" id="accHead_'+ i +'">';
        html += '</select>';
        html += '</td>';
        html += '<td>';
        html += '<input class="form-control" type="text" name="description[]" id="description_'+ i +'" placeholder="description">';
        html += '</td>';
        html += '<td width="20%">';
        html += '<input class="form-control" type="text" name="debit[]" id="debit_1" placeholder="0.00">';
        html += '</td>';
        html += '<td width="20%">';
        html += '<input class="form-control" type="text" name="credit[]" id="credit_1" placeholder="0.00">';
        html += '</td>';
        html += '<td width="7%" class="text-end">';
        html += '<button class="btn btn-sm btn-red text-center" onclick="removeRow(this)">';
        html += '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M4 7h3m4 0h9" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="14" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" /><line x1="18.384" y1="14.373" x2="19" y2="7" /><path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
        html += '</button>';
        html += '</td>';
        html += '<tr>';

        $('#accTable').append(html);
        setAccHead(i);
      }

      function removeRow (el) {
        $(el).parents("tr").remove()
        // totalAmount()
      }

      
    </script>
              
@endsection