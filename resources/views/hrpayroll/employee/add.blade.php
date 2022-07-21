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
                    <form action="{{ route('hrpayroll.employee.save') }}" method="post" class="card">
                        @csrf
                        <div class="card">
                            <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#job-information" class="nav-link active" data-bs-toggle="tab"
                                        aria-selected="true" role="tab">Employee Job Information</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a href="#personal-information" class="nav-link" data-bs-toggle="tab"
                                        aria-selected="false" role="tab" tabindex="-1"
                                        onclick="togleNavTab()">Employee Personal
                                        Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#nominee-information" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                        role="tab" tabindex="-1"  onclick="togleNavTab()">Nominee Information</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#contact-information" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                        role="tab" tabindex="-1" onclick="togleNavTab()">Employee Contact Information</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#educational-information" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                        role="tab" tabindex="-1" onclick="togleNavTab()">Educational Qualification</a>
                                </li> --}}
                            </ul>
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane show active" id="job-information" role="tabpanel">

                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <label class="form-label required">Employee ID</label>
                                                <input type="text" name="employeeId"
                                                    class="form-control @error('employeeId') is-invalid @enderror"
                                                    autocomplete="off" placeholder="employee Id" required>
                                                @error('employeeId')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Name</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    autocomplete="off" placeholder="name" required>
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
                                                        @foreach ($departments as $dep)
                                                            <option
                                                                {{ $dep->id == old('departmentId') ? 'selected' : '' }}
                                                                value="{{ $dep->id }}">{{ $dep->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label required">Section</label>
                                                    <select name="sectionId " class="form-select chosen-select" required>
                                                        <option disabled selected>Select Section</option>
                                                        @foreach ($sections as $sec)
                                                            <option {{ $sec->id == old('sectionId ') ? 'selected' : '' }}
                                                                value="{{ $sec->id }}">{{ $sec->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Designation</label>
                                                    <select name="designationId" class="form-select chosen-select" required>
                                                        <option disabled selected>Select Designation</option>
                                                        @foreach ($designations as $desig)
                                                            <option
                                                                {{ $desig->id == old('designationId') ? 'selected' : '' }}
                                                                value="{{ $desig->id }}">{{ $desig->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Shift</label>
                                                    <select name="shiftId" class="form-select chosen-select" required>
                                                        <option disabled selected>Select Shift</option>
                                                        @foreach ($shifts as $shift)
                                                            <option {{ $shift->id == old('shiftId') ? 'selected' : '' }}
                                                                value="{{ $shift->id }}">{{ $shift->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </fieldset>


                                    </div>
                                    {{-- <div class="tab-pane" id="personal-information" role="tabpanel">
                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <label class="form-label required">Father's Name</label>
                                                <input type="text" name="fathersName"
                                                    class="form-control @error('fathersName') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Father's Name" required>
                                                @error('fathersName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Mother's Name</label>
                                                <input type="text" name="mothersName"
                                                    class="form-control @error('mothersName') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Mother's Name" required>
                                                @error('mothersName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">NID No</label>
                                                <input type="text" name="nid"
                                                    class="form-control @error('nid') is-invalid @enderror"
                                                    autocomplete="off" placeholder="NID No" required>
                                                @error('nid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Date Of Birth</label>
                                                <input type="text" name="dateOfBirth" id="dateOfBirth"
                                                    class="form-control @error('dateOfBirth') is-invalid @enderror"
                                                    autocomplete="off" placeholder="" required>
                                                @error('dateOfBirth')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Account No</label>
                                                <input type="text" name="accountNo" id="accountNo"
                                                    class="form-control @error('accountNo') is-invalid @enderror"
                                                    autocomplete="off" placeholder="" required>
                                                @error('accountNo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Marital Status</label>
                                                    <select id="maritalStatus" name="maritalStatus"
                                                        class="form-select chosen-select" required>
                                                        <option disabled selected>Select Marital Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Gender</label>
                                                    <select id="gender" name="gender"
                                                        class="form-select chosen-select" required>
                                                        <option disabled selected>Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Religion</label>
                                                    <select id="religion" name="religion"
                                                        class="form-select chosen-select" required>
                                                        <option disabled selected>Select Religion</option>
                                                        <option value="islam">Islam</option>
                                                        <option value="hindu">Hindu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="nominee-information" role="tabpanel">
                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <label class="form-label required">Nominee Name</label>
                                                <input type="text" name="nomineeName"
                                                    class="form-control @error('nomineeName') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee Name" required>
                                                @error('nomineeName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Nominee Fathers's Name</label>
                                                <input type="text" name="nomineeFathersName"
                                                    class="form-control @error('nomineeFathersName') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee Fathers's Name" required>
                                                @error('nomineeFathersName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Nominee Mother's Name</label>
                                                <input type="text" name="nomineeMothersName"
                                                    class="form-control @error('nomineeMothersName') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee Mother's Name" required>
                                                @error('nomineeMothersName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Nominee NID No</label>
                                                <input type="text" name="nominee_nid"
                                                    class="form-control @error('nominee_nid') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee NID No" required>
                                                @error('nominee_nid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Relationship</label>
                                                <input type="text" name="nomineeRelationship"
                                                    class="form-control @error('nomineeRelationship') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee Relationship" required>
                                                @error('nomineeRelationship')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Nominee Cell No</label>
                                                <input type="text" name="nomineeCellNo"
                                                    class="form-control @error('nomineeCellNo') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee Cell No" required>
                                                @error('nomineeCellNo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Nominee Address</label>
                                                <input type="text" name="nomineeAddress"
                                                    class="form-control @error('nid') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Nominee Address" required>
                                                @error('nomineeAddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="contact-information" role="tabpanel">
                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <label class="form-label required">Corporate Sim No</label>
                                                <input type="text" name="corporateSimNo"
                                                    class="form-control @error('corporateSimNo') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Corporate Sim No" required>
                                                @error('corporateSimNo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Personal Sim No</label>
                                                <input type="text" name="personalSimNo"
                                                    class="form-control @error('personalSimNo') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Personal Sim No" required>
                                                @error('personalSimNo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Email</label>
                                                <input type="text" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Email" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Password</label>
                                                <input type="text" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Present Address</label>
                                                <textarea name="presentAddress"
                                                    class="form-control @error('presentAddress') is-invalid @enderror"
                                                    autocomplete="off" required>
                                                </textarea>
                                                @error('presentAddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Permanent Address</label>
                                                <textarea name="permanentAddress"
                                                    class="form-control @error('permanentAddress') is-invalid @enderror"
                                                    autocomplete="off" required>
                                                </textarea>
                                                @error('permanentAddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="educational-information" role="tabpanel">
                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <label class="form-label required">Highest Academic Degree</label>
                                                <input type="text" name="highestAcademicDegree"
                                                    class="form-control @error('highestAcademicDegree') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Highest Academic Degree" required>
                                                @error('highestAcademicDegree')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">College/University</label>
                                                <input type="text" name="college/university"
                                                    class="form-control @error('college/university') is-invalid @enderror"
                                                    autocomplete="off" placeholder="College/University" required>
                                                @error('college/university')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Passing Year</label>
                                                <input type="text" name="passingYear"
                                                    class="form-control @error('passingYear') is-invalid @enderror"
                                                    autocomplete="off" placeholder="Passing Year" required>
                                                @error('passingYear')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                        </fieldset>
                                    </div> --}}
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
<script>
    const togleNavTab = () => {
        $(".chosen-select").chosen('destroy');
        $(".chosen-select").chosen({
            width: "100%"
        });
        $("#dateOfBirth").datepicker();
    }
</script>
