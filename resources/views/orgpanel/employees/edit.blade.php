@extends('orgpanel.layout')
@section('title','Edit Employee | HospitALL')
@section('styles')
  <link rel="stylesheet" href="{{ asset('backend/css/fileupload.css') }}">
<!--   <link rel="stylesheet" href="{{ asset('backend/js/masking/inputmask.js') }}">
  <link rel="stylesheet" href="{{ asset('backend/js/mask/jquery.mask.js') }}"> -->
@endsection
@section('content')
<div class="container-fluid px-xl-5">
  <section class="py-5">
    <div class="row">
      @include('adminpanel.notification')
      <!-- Form Elements -->
      <div class="col-lg-12 mb-5">
        <div class="card">
          <div class="card-header">
            <h3 class="h6 text-uppercase mb-0">Edit Employees</h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="post" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="form-group row">
                  <label class="col-md-2 form-control-label">Employee Name <span class="asterisk">*</span></label>
                  <div class="col-md-10">
                        <input type="text" name="name" placeholder="Employee name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $employee->name }}" required>

                      @if($errors->has('name'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('name') }}</div>
                      @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label">Email</label>
                  <div class="col-md-4">
                        <input type="text" name="email" placeholder="Email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $employee->email }}">

                      @if($errors->has('email'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('email') }}</div>
                      @endif
                  </div>
                  <label class="col-md-2 form-control-label">Phone <span class="asterisk">*</span></label>
                  <?php $phone = formatPhone($employee->phone);  ?>
                  <div class="col-md-4">
                        <input type="text" name="phone" data-mask="9999-9999999" placeholder="Phone"
                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ $phone }}" required>

                      @if($errors->has('phone'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('phone') }}</div>
                      @endif
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-2 form-control-label" id="organization_id">Organization</div>
                  <div class="col-md-4">
                  <input type="text" name="organization_id" placeholder="{{$org->name}}"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{$org->name}}" readonly>
                  </div>
                  <div class="col-md-2 form-control-label" id= "employee_code">Employee Code <span class="asterisk">*</span></div>
                  <div class="col-md-4">
                  <input type="text" name="employee_code" placeholder="Enter Employee Code"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $employee->employee_code }}" required>
                        @if($errors->has('employee_code'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('employee_code') }}</div>
                      @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label">Address</label>
                  <div class="col-md-4">
                        <input type="text" name="address" placeholder="address" id="autocomplete" onFocus="geolocate()"
                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ $employee->address }}">
                        <input type="text" id="locality" class="city" hidden name="city" value="{{ $employee->city_name }}"/>
                      @if($errors->has('address'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('address') }}</div>
                      @endif
                  </div>

                  <label class="col-md-2 form-control-label">Gender</label>
                  <div class="col-md-2">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input id="male" type="radio" value="0" name="gender" class="custom-control-input"
                      {{ $employee->gender == 0 ? 'checked':'' }}>
                      <label for="male" class="custom-control-label">Male</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input id="female" type="radio" value="1" name="gender" class="custom-control-input" {{ $employee->gender == 1 ? 'checked':'' }}>
                      <label for="female" class="custom-control-label">Female</label>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label">Marital Status</label>
                  <div class="col-md-1">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input id="unmarried" type="radio" value="0" name="marital_status" class="custom-control-input" {{ $employee->marital_status == 0 ? 'checked':'' }}>
                      <label for="unmarried" class="custom-control-label">Unmarried</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input id="married" type="radio" value="1" name="marital_status" class="custom-control-input" {{ $employee->marital_status == 1 ? 'checked':'' }}>
                      <label for="married" class="custom-control-label">married</label>
                    </div>
                  </div>

                  <label class="col-md-1 form-control-label">Age</label>
                  <div class="col-md-1">
                        <input type="text" name="age" placeholder="age"
                        class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}"
                        value="{{ $employee->age }}" >

                      @if($errors->has('age'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('age') }}</div>
                      @endif
                  </div>

                  <label class="col-md-1 form-control-label">Weight</label>
                  <div class="col-md-1">
                        <input type="text" name="weight" placeholder="weight"
                        class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}"
                        value="{{ $employee->weight }}">

                      @if($errors->has('weight'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('weight') }}</div>
                      @endif
                  </div>
                  <label class="col-md-1 form-control-label">Height</label>
                  <div class="col-md-1">
                        <input type="text" name="height" placeholder="height"
                        class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}"
                        value="{{ $employee->height }}">

                      @if($errors->has('height'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('height') }}</div>
                      @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label">Patient Owner</label>
                  <div class="col-md-10">
                        <input type="text" name="patient_coordinator_id" placeholder="{{ $owner }}"
                        class="form-control {{ $errors->has('patient_coordinator_id') ? 'is-invalid' : '' }}" value="{{ $owner }}" readonly>
                      @if($errors->has('patient_coordinator_id'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('patient_coordinator_id') }}</div>
                      @endif
                  </div>
                </div>

<!--                 <div class="form-group row">

                  <label class="col-md-2 form-control-label">Notes <span class="asterisk">*</span></label>
                  <div class="col-md-10">
                      <textarea placeholder="Enter Details" class="form-control tiny" name="notes" id="" cols="30" rows="5"><p>What:</p><p>When:</p><p>Why:</p></textarea>
                      @if($errors->has('notes'))
                      <div class="invalid-feedback ml-3">{{ $errors->first('notes') }}</div>
                      @endif
                  </div>
                </div> -->

<!--                 <div class="form-group row">
                  <label class="col-md-2 form-control-label">Follow Up <span class="asterisk">*</span></label>
                  <div class="col-md-4">
                        <input type="date" name="next_contact_date" placeholder="next_contact_date"
                        class="form-control {{ $errors->has('next_contact_date') ? 'is-invalid' : '' }}" value="{{ old('next_contact_date') }}" required>

                      @if($errors->has('next_contact_date'))
                        <div class="invalid-feedback ml-3">{{ $errors->first('next_contact_date') }}</div>
                      @endif
                  </div>
                  <label class="col-md-2 form-control-label">Attachments</label>
                  <div class="col-md-4">
                    <span class="btn btn-success fileinput-button">
                        <span>Select Attachment</span>
                        <input type="file" name="file" id="files" class="form-control {{ $errors->has('picture') ? 'is-invalid' : '' }}"><br />
                    </span>
                    <output id="Filelist"></output>
                      @if($errors->has('picture'))
                      <div class="invalid-feedback ml-3">{{ $errors->first('picture') }}</div>
                      @endif
                  </div>
                </div> -->

                <div class="form-group row">
                  <div class="col-md-10 ml-auto">
                    <button type="submit" class="btn btn-primary">Update Employee</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('scripts')
<script src="{{ asset('backend/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('backend/js/tinymce-config.js') }}" ></script>
<script src="{{ asset('backend/js/fileupload.js') }}" ></script>
<script src="{{ asset('backend/js/bootstrap-inputmask.min.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-*.min.js"></script>
<script>
  $('#organization_id').on('change',function(){
        if( $(this).val()){
        $("#employee_code").show()
        }
        else{
        $("#employee_code").hide()
        }
    });
</script>
<script>
var placeSearch, autocomplete;

var componentForm = {
  // street_number: 'short_name',
  // route: 'long_name',
  locality: 'long_name',
  // administrative_area_level_1: 'short_name',
  // country: 'long_name',
  // postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// $(".city").val(locality);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9RHZgUXffbQmvczfgC8CeNKfm6IYMAJQ&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
