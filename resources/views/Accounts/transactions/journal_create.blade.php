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
                    <input class="form-control" type="date" name="transactionDate" value="{{ date('m-d-Y') }}">
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
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                      <th class="w-1">ID</th>
                      <th>Head of Accounting</th>
                      <th>Description</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th align="right" class="text-end">
                        <button  class="btn btn-success">
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
                      <td></td>
                      <td width="20%">
                        <input class="form-control" type="text" name="debit[]" id="debit_1" placeholder="0.00">
                      </td>
                      <td width="20%">
                        <input class="form-control" type="text" name="credit[]" id="credit_1" placeholder="0.00">
                      </td>
                      <td width="7%" class="text-end">
                        
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <!-- save button -->
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>
      const global = new Global();
      var url = "{{ route('accounts.acchead', [1, 1]) }}";
      global.sendReq(url, '', method = 'GET', function(response){
        console.log("ok", response);
        global.setChosenValue(response, 'accHead_1', 'Acc Head')
      });

      setAccHead(){
        
      }
    </script>
              
@endsection