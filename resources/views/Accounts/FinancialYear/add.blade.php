@extends('home')
@section('title', 'Financial Year')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Add Financial Year
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
            <div class="col-12">
                @include('extras.__message')

                <form action="{{ route('accounts.fiscal.year.save') }}" method="post" class="card">
                    @csrf
                  <div class="card-header">
                    <h4 class="card-title">Add Financial Year</h4>
                  </div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="col-xl-4">
                        <div class="row">
                          <div class="col-md-6 col-xl-12">
                           
                            <div class="mb-3">
                              <label class="form-label">From Date</label>
                              <input type="text" value="{{ old('fromDate') }}" class="date form-control @error('fromDate') is-invalid @enderror" value="{{ old('name') }}" name="fromDate" placeholder="From date" readonly>
                                @error('fromDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                              <label class="form-label">To Date</label>
                              <input type="text" value="{{ old('toDate') }}" class="date form-control @error('toDate') is-invalid @enderror" name="toDate" placeholder="To date" readonly>
                              @error('toDate')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Company Id</label>
                              <!-- <input type="text" value="{{ old('companyId') }}" class="form-control @error('companyId') is-invalid @enderror" name="companyId" placeholder="Enter Company Id"> -->
                              <select name="companyId" class="chosen-select form-control @error('companyId') is-invalid @enderror">
                                <option selected disabled>Select Company</option>
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
                              <label class="form-label">Status</label>
                              <!-- <input type="text" value="{{ old('status') }}" class="form-control @error('status') is-invalid @enderror" name="status" placeholder="Enter Status"> -->
                              <label class="form-check form-switch">
                                <input name="status" class="form-check-input @error('status') is-invalid @enderror" type="checkbox" checked="">
                              </label>
                              @error('status')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                         
                            <div class="mb-3">
                              <!-- <label class="form-label">Input with help icon</label> -->
                              <div class="row g-2">
                                <div class="col">
                                  <!-- <input type="text" class="form-control" placeholder="Search for…"> -->
                                </div>
                                <div class="col-auto align-self-center">
                                  <!-- <span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<p>ZIP Code must be US or CDN format. You can use an extended ZIP+4 code to determine address more accurately.</p>
                                  <p class='mb-0'><a href='#'>USP ZIP codes lookup tools</a></p>
                                  " data-bs-html="true">?</span> -->
                              </div>

                            </div>
                          </div>
                        </div>
                       
                      </div>
                    </div>
                 
                  </div>
                </div>
                <div class="card-footer text-end">
                  <div class="d-flex">
                    <!-- <a href="#" class="btn btn-link">Cancel</a> -->
                    <button type="submit" class="btn btn-primary ms-auto">Save Financial Year</button>
                  </div>
                </div>
              </form>
            </div>
            </div>
          
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $('.chosen-select').chosen();
      </script>
@endsection