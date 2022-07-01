@extends('home')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                      {{ $title }} List
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
               
                  <a href="{{ route('accounts.acctrans.jv.create', $typeNo) }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add {{ $title }}
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
              <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
              </div>
              <!-- <div class="card-body border-bottom py-3">
                <div class="d-flex">
                  <div class="text-muted">
                  
                  </div>
                  <div class="ms-auto text-muted">
                    Search:
                    <div class="ms-2 d-inline-block">
                      <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="table-responsive">
                <table class="table card-table table-striped datatable" >
                  <thead class="table-dark">
                    <tr>
                      <th>ID</th>
                      <th>Voucher Date</th>
                      <th>Voucher No</th>
                      <th>Narration</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($accTrans as $key =>  $row)
                    <tr>
                      
                      <td  width="3%">{{ $row->id }}</td>
                      <td><span class="text-muted">{{ Helper::dateEnToBn($row->date) }}</span></td>
                      <td>{{ $row->vourcher_no }}</td>
                      <td  width="40%"> {{ $row->narration }}</td>
                      <td>{{ $row->dAmount }}</td>
                      <td>{{ $row->cAmount }}</td>
                      <td class="text-end" width="10%">
                        
                          <a href="#" class="btn btn-red">
                            Red
                          </a>
                          <a title="edit" href="{{ route('accounts.acc.trans.edit', $row->id) }}" class="btn btn-flickr btn-icon" aria-label="Flickr">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                          </a>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
               
                <ul class="pagination m-0 ms-auto">
                {{ $accTrans->links('pagination::bootstrap-4') }}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
              
@endsection