@extends('home')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                       Company Assign List
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">

                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New 
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
              
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>User Name</th>
                        <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($companyAssigns as $key => $row)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td companyId="{{ $row->companyId }}">{{ $row->companyName }}</td>
                        <td userId="{{ $row->userId }}">{{ $row->name }}</td>
                        <td width="10%">
                          <input type="hidden" name="defaultdata" value="{{ $row->default }}">
                          <input type="hidden" id="assignId" value="{{ $row->id }}">

                          <ul class="list-group list-group-horizontal">
                            <li>
                              <form id="deleteChart" method="post" action="{{ route('settings.company.assign.delete') }}">
                                @csrf
                                <input type="hidden" value="{{ $row->companyId }}" name="companyId">
                                <input type="hidden" value="{{ $row->userId }}" name="userId">
                                <input onclick="deleteChart()" type="button" value="Del" class="btn btn-sm btn-red">
                              </form>
                            </li>
                            <li>
                              <a  onclick="edit(event)" class="edit-modal-button" title="edit" data-bs-toggle="modal" data-bs-target="#edit-modal" href="#" class="btn btn-sm btn-flickr btn-icon" aria-label="Flickr">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                Edit
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
                    {{ $companyAssigns->links('pagination::bootstrap-4') }}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- add new Modal -->
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New   </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('settings.company.assign.save') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="userId" class="form-select" required>
                        <option disabled selected>Select user</option>
                        @foreach($users as $user)  
                            <option {{ ($row->id == old('userId')) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('userId')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
                    <label class="form-label">Default Company</label>
                    <input type="checkbox" name="default">
                </div>

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
            <input type="submit" class="btn btn-primary ms-auto" value="Save ">
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
            <h5 class="modal-title">Edit   </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('settings.company.assign.update') }}">
                @csrf
                
                <input type="hidden" name="id" id="updateId">
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="userId" id="userId" class="form-select" required>
                        <option disabled selected>Select user</option>
                        @foreach($users as $user)  
                            <option {{ ($row->id == old('userId')) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <select name="companyId" id="companyId" class="form-select" required>
                        <option disabled selected>Select Company</option>
                        @foreach($companies as $row)  
                            <option {{ ($row->id == old('companyId')) ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Default Company</label>
                    <input type="hidden" name="id" id="updatedId">
                    <input type="checkbox" id="default" name="default">
                </div>

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
            <input type="submit" class="btn btn-primary ms-auto" value="Update ">

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
    var companyId = $(event.target).closest('tr').find("td").eq(1).attr('companyId')
    var company = $(event.target).closest('tr').find("td").eq(1).html()

    var userId = $(event.target).closest('tr').find("td").eq(2).attr('userId')
    var user = $(event.target).closest('tr').find("td").eq(2).html()

    var defaultData = $(event.target).closest('tr').find("input[name='defaultdata']").val();
    if (defaultData == 1) {
      $('#default').prop( "checked", true );
      $('#default').val('on');
    }else{
      $('#default').val('off');
    }
    id = $('#assignId').val();
    $('#updatedId').val(id);

    $("#companyId").append('<option value='+ companyId +' selected> '+ company +' </option>');
    $("#userId").append('<option value='+ userId +' selected> '+ user +' </option>');


  }
  
</script>

@endsection