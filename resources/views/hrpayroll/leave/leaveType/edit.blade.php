@extends('home')
@section('title', 'Edit Leave Type')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Type
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

                <form action="{{ route('hrpayroll.leaveType.update', $leaveType->id) }}" method="post" class="card">
                    @csrf
                  <div class="card-header">
                    <h4 class="card-title">Edit Leave Type</h4>
                  </div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="col-xl-4">
                        <div class="row">
                          <div class="col-md-6 col-xl-12">
                           
                            <div class="mb-3">
                              <label class="form-label">Type Name</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $leaveType->name }}" name="name" placeholder="Input type name">
                                @error('name')
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
                    <button type="submit" class="btn btn-primary ms-auto">Update Type</button>
                  </div>
                </div>
              </form>
            </div>
            </div>
          
          </div>
        </div>
      </div>
@endsection