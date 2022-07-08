@extends('home')
@section('title', 'Company Assign')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Company Assign
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
               
                  <!-- <a href="{{ route('accounts.fiscal.year.add') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Chart Of Accounts
                  </a> -->

                  
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Chart Of Accounts
                  </a>
               
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="page-body" id="app">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
            @include('extras.__message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Company Assign</h3>
              </div>
              <div class="card-body border-bottom py-3">
                <div class="d-flex">
                  
                  
                </div>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                        <th>Account Head</th>
                        <th>Acc Lavel</th>
                        <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($chartOfAccounts as $row)
                    <tr>
                        <td>
                            <a id="{{ $row->id }}" companyId="{{ $row->company->id }}" company="{{ $row->company->name }}" href="{{ route('accounts.chart.of.acc.index', ['parentId' => $row->id]) }}">{{ $row->accHead }}</a>
                        </td>
                        <td>
                            {{ $row->accLavel }}
                        </td>
                        <td width="10%">
                          <ul class="list-group list-group-horizontal">
                            <li>
                              <form id="deleteChart" method="post" action="{{ route('accounts.chart.of.acc.delete') }}">
                                @csrf
                                <input type="hidden" value="{{ $row->id }}" name="id">
                                <input onclick="deleteChart()" type="button" value="Del" class="btn btn-sm btn-red">
                              </form>
                            </li>
                            <li>
                              <a  onclick="edit(event)" class="edit-modal-button" title="edit" data-bs-toggle="modal" data-bs-target="#edit-modal" href="#" class="btn btn-sm btn-flickr btn-icon" aria-label="Flickr">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                              </a>
                            </li>
                          </ul>
                        </td>
                    </tr>
                    @endforeach
                  
                    
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <ul class="pagination m-0 ms-auto">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                      <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
                      prev
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- add new chart Modal -->
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Chart Of Account  </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('accounts.chart.of.acc.add') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <select name="companyId" class="form-select" required>
                        <option disabled selected>Select Company</option>
                        @foreach($companies as $row)  
                            <option {{ ($row->id == old('companyId')) ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                    @error('companyId')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Head</label>
                    <input type="text" class="form-control" name="accHead" placeholder="Your report name" required>
                    @error('accHead')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input type="hidden" name="parentId" value="{{ $_GET['parentId'] }}">

          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-4">
                   
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <input type="submit" class="btn btn-primary ms-auto" value="Save Chart Of Account">
            <!-- <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Save Chart Of Account
            </a> -->
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--Edit Modal -->
    <div class="modal modal-blur fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Chart Of Account  </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('accounts.chart.of.acc.update') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <select name="companyId" id="editCompany" class="form-select" required>
                        <option disabled selected>Select Company</option>
                        @foreach($companies as $row)  
                            <option {{ ($row->id == old('companyId')) ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                   
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Head</label>
                    <input type="text" class="form-control" id="editAccHead" name="accHead" placeholder="Your report name" required>

                  </div>
                <input type="hidden" name="id" id="editId" value="{{ $_GET['parentId'] }}">

          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-4">
                   
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <input type="submit" class="btn btn-primary ms-auto" value="Update Chart Of Account">

          </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@section('script')
<script>

  function deleteChart() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $('#deleteChart').submit()
        }
      })
  }

  function edit(event) {
    var id = $(event.target).closest('tr').find("a").attr('id')
    var company = $(event.target).closest('tr').find("a").attr('company')
    var companyId = $(event.target).closest('tr').find("a").attr('companyId')
    var acchead = $(event.target).closest('tr').find("a").html();
    $("#editCompany").append('<option value='+ companyId +' selected> '+ company +' </option>');
    $('#editAccHead').val(acchead);
    $('#editId').val(id);
  }
  
</script>

@endsection