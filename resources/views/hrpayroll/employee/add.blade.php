@extends('home')
@section('title', 'Employee Information | HR Payroll')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Add Employee
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    @include('extras.__message')
                    <form action="{{ route('hrpayroll.employee.create') }}" method="post" class="card">
                        @csrf
                        <div class="card">
                            <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#job-information" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Employee Job Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-profile-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Employee Personal Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-activity-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Nominee Information</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-activity-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Employee Contact Information</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-activity-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Educational Qualification</a>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="tab-content">

                                <div class="tab-pane show active" id="job-information" role="tabpanel">
                                    
                                    <fieldset class="form-fieldset">
                                        <div class="mb-3">
                                            <label class="form-label required">Employee ID</label>
                                            <input type="text" name="employeeId" class="form-control @error('employeeId') is-invalid @enderror" autocomplete="off"  placeholder="employee Id" required>
                                            @error('employeeId')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Name</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off"  placeholder="name" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label required">Department</label>
                                                <select name="departmentId" class="form-select chosen-select" required>
                                                    <option disabled selected>Select Department</option>
                                                    @foreach($departments as $dep)  
                                                        <option {{ ($dep->id == old('departmentId')) ? 'selected' : '' }} value="{{ $dep->id }}">{{ $dep->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label required">Section</label>
                                                <select name="sectionId " class="form-select chosen-select" required>
                                                    <option disabled selected>Select Section</option>
                                                    @foreach($sections as $sec)  
                                                        <option {{ ($sec->id == old('sectionId ')) ? 'selected' : '' }} value="{{ $sec->id }}">{{ $sec->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Designation</label>
                                                <select name="designationId" class="form-select chosen-select" required>
                                                    <option value="">Select Designation</option>
                                                    @foreach($designations as $desig)  
                                                        <option {{ ($desig->id == old('designationId')) ? 'selected' : '' }} value="{{ $desig->id }}">{{ $desig->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <label class="form-label">Shift</label>
                                                <select name="shiftId" class="form-select chosen-select" required>
                                                    <option disabled selected>Select Shift</option>
                                                    @foreach($shifts as $shift)  
                                                        <option {{ ($shift->id == old('shiftId')) ? 'selected' : '' }} value="{{ $shift->id }}">{{ $shift->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </fieldset>

                                   
                                </div>
                                <div class="tab-pane" id="tabs-profile-14" role="tabpanel">
                                    <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
                                </div>
                                <div class="tab-pane" id="tabs-activity-14" role="tabpanel">
                                    <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <!-- <a href="#" class="btn btn-link">Cancel</a> -->
                                <button type="submit" class="btn btn-primary ms-auto">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
        
            </div>
          
          </div>
        </div>
      </div>
@endsection