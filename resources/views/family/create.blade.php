
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Family Information Form</h2>
    <form action="{{ route('family.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Head of Family Section -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Head of Family</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" required>
                        @error('surname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}" required>
                        @error('birthdate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="mobile_no" class="form-label">Mobile No</label>
                        <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}" required>
                        @error('mobile_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <select name="state_id" id="state" class="form-control @error('state') is-invalid @enderror" required>
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <select name="city_id" id="city" class="form-control @error('city') is-invalid @enderror" required>
                            <option value="">Select City</option>
                        </select>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}" required>
                        @error('pincode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="marital_status" class="form-label">Marital Status</label>
                        <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status" required>
                            <option value="">Select Status</option>
                            <option value="Unmarried" {{ old('marital_status') == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                            <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        </select>
                        @error('marital_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6" id="wedding_date_field" style="display: none;">
                        <label for="wedding_date" class="form-label">Wedding Date</label>
                        <input type="date" name="wedding_date" class="form-control @error('wedding_date') is-invalid @enderror" value="{{ old('wedding_date') }}">
                        @error('wedding_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Hobbies</label>
                        <div id="hobbies-container">
                            <input type="text" name="hobbies[]" class="form-control mb-2 @error('hobbies.*') is-invalid @enderror" placeholder="Hobby" value="{{ old('hobbies.0') }}" required>
                            @error('hobbies.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="add-hobby">Add Hobby</button>
                    </div>

                    <div class="col-md-6">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" required>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        <!-- Family Members Section -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Family Members</h4>
            </div>
            <div class="card-body" id="family-members-container">
                <div class="family-member mb-3">
                    <h5>Family Member</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="family_members[0][name]" class="form-label">Name</label>
                            <input type="text" name="family_members[0][name]" class="form-control family-member-name" value="{{ old('family_members[0][name]') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="family_members[0][birthdate]" class="form-label">Birthdate</label>
                            <input type="date" name="family_members[0][birthdate]" class="form-control family-member-birthdate" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="family_members[0][marital_status]" class="form-label">Marital Status</label>
                            <select name="family_members[0][marital_status]" class="form-control marital-status" required>
                                <option value="">Select Status</option>
                                <option value="Unmarried">Unmarried</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                        <div class="col-md-6 wedding-date-field" style="display: none;">
                            <label for="family_members[0][wedding_date]" class="form-label">Wedding Date</label>
                            <input type="date" name="family_members[0][wedding_date]" class="form-control wedding-date">
                        </div>

                        <div class="col-md-6">
                            <label for="family_members[0][education]" class="form-label">Education</label>
                            <input type="text" name="family_members[0][education]" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="family_members[0][photo]" class="form-label">Photo</label>
                            <input type="file" name="family_members[0][photo]" class="form-control">
                        </div>

                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-outline-primary" id="add-family-member">Add Family Member</button>
            </div>
        </div>

        <a href="{{ route('family.index') }}" type="button" class="btn btn-secondary mt-4">Cancel</a>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const maritalStatus = document.getElementById('marital_status');
        const weddingDateField = document.getElementById('wedding_date_field');

        maritalStatus.addEventListener('change', function () {
            if (this.value === 'Married') {
                weddingDateField.style.display = 'block';
            } else {
                weddingDateField.style.display = 'none';
            }
        });
    });

    // Add hobbies dynamically
    document.getElementById('add-hobby').addEventListener('click', function() {
        let hobbyInput = document.createElement('input');
        hobbyInput.type = 'text';
        hobbyInput.name = 'hobbies[]';
        hobbyInput.classList.add('form-control', 'mb-2');
        hobbyInput.placeholder = 'Hobby';
        document.getElementById('hobbies-container').appendChild(hobbyInput);
    });

    $(document).ready(function() {
        $('#state').on('change', function() {
            var stateId = $(this).val();
            $('#city').html('<option value="">Select City</option>'); // Reset city dropdown
            if (stateId) {
                $.ajax({
                    url: '/get-cities/' + stateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(cities) {
                        $.each(cities, function(index, city) {
                            $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
<script>
    document.getElementById('add-family-member').addEventListener('click', function () {
        let container = document.getElementById('family-members-container');
        let index = container.children.length;
        let newMember = container.children[0].cloneNode(true);

        newMember.querySelectorAll('input, select').forEach(field => {
            if (field.name) {
                field.name = field.name.replace(/\[0\]/, `[${index}]`);
                field.value = '';
            }
        });

        newMember.querySelector('.wedding-date-field').style.display = 'none';
        newMember.querySelector('.wedding-date').removeAttribute('required');

        container.appendChild(newMember);
        newMember.querySelector('.marital-status').addEventListener('change', function () {
            let weddingField = this.closest('.family-member').querySelector('.wedding-date-field');
            if (this.value === 'Married') {
                weddingField.style.display = 'block';
                weddingField.querySelector('.wedding-date').setAttribute('required', 'required');
            } else {
                weddingField.style.display = 'none';
                weddingField.querySelector('.wedding-date').removeAttribute('required');
            }
        });
    });

    // marital status change handler for default member
    document.querySelector('.marital-status').addEventListener('change', function () {
        let weddingField = this.closest('.family-member').querySelector('.wedding-date-field');
        if (this.value === 'Married') {
            weddingField.style.display = 'block';
            weddingField.querySelector('.wedding-date').setAttribute('required', 'required');
        } else {
            weddingField.style.display = 'none';
            weddingField.querySelector('.wedding-date').removeAttribute('required');
        }
    });
</script>


@endsection
