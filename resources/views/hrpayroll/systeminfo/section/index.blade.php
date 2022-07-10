@extends('home')
@section('title', 'Section | Hr Payroll')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Section List
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
               
 
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Section
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
              
              <div class="card-body border-bottom py-3">
                <div class="d-flex">
                  <div class="text-muted">
                    Show
                    <div class="mx-2 d-inline-block">
                      <input type="text" id="datatableLength" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                    </div>
                    entries
                  </div>
                  <div class="ms-auto text-muted">
                    Search:
                    <div class="ms-2 d-inline-block">
                      <input type="text" class="form-control form-control-sm" id="datatableSearch">
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table card-table datatable">
                  <thead>
                    <tr>
                        <th>SL</th>
                        <th>Section Name</th>
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sections as $key => $row)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a id="{{ $row->id }}">{{ $row->name }}</a></td>
                        <td>{{ $row->description }}</td>
                        <td width="10%">
                          <ul class="list-group list-group-horizontal">
                            <li>
                              <form id="deleteChart_{{ $row->id }}" method="post" action="{{ route('hrpayroll.section.delete') }}">
                                @csrf
                                <input name="id" value="{{ $row->id }}" type="hidden">

                                <input id="{{ $row->id }}" onclick="deleteChart(this.id)" type="button" value="Del" class="btn btn-sm btn-red">
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
            <h5 class="modal-title">Add New Section  </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('hrpayroll.section.create') }}">
                @csrf
               
                <div class="mb-3">
                    <label class="form-label">Section name</label>
                    <input type="text" class="form-control" name="name" placeholder="Section name" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" class="form-control" name="description" placeholder="Section description" required></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
            <input type="submit" class="btn btn-primary ms-auto" value="Save Section">
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
            <form method="post" action="{{ route('hrpayroll.section.update') }}">
                @csrf
                <input type="hidden" name="id" id="editId" value="">

                <div class="mb-3">
                    <label class="form-label">Section name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Section name" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Section description" required></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
            <input type="submit" class="btn btn-primary ms-auto" value="Update Section">

          </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@section('script')
<script>

  function deleteChart(id) {
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
          $('#deleteChart_'+id).submit()
        }
      })
  }

  function edit(event) {
    var name = $(event.target).closest('tr').find("td a").text()
    var description = $(event.target).closest('tr').find("td").eq(1).text()
    var id = $(event.target).closest('tr').find("td a").attr('id')
    $('#editId').val(id);
    $("#name").val(name);
    $('#description').val(description);
  }
  
</script>

@endsection