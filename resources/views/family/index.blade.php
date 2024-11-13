@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Family Head List</h2>

    <a href="{{ route('family.create') }}">
        <button type="button" class="btn btn-outline-primary" id="add-hobby">Add Family Head</button>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Birthdate</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>Pincode</th>
                <th>Marital Status</th>
                <th>Wedding Date</th>
                <th>Hobbies</th>
                <th>Photo</th>
                <th>Family Members</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($families as $family)
                <tr>
                    <td>{{ $family?->name . " " . $family?->surname }}</td>
                    <td>{{ $family?->birthdate }}</td>
                    <td>{{ $family?->mobile_no }}</td>
                    <td>{{ $family?->address }}</td>
                    <td>{{ $family?->state?->name }}</td>
                    <td>{{ $family?->city?->name }}</td>
                    <td>{{ $family?->pincode }}</td>
                    <td>{{ $family?->marital_status }}</td>
                    <td>{{ $family?->wedding_date }}</td>
                    <td>{{ implode(', ', json_decode($family?->hobbies ?? '[]', true)) }}</td>
                    <td>
                        @if($family->photo)
                            <img src="{{ asset('storage/' . $family->photo) }}" alt="Photo" style="width: 50px; height: 50px;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $family?->familyMembers->count() }}</td>
                    <td>
                        <a href="{{ route('family.show', $family->id) }}" class="btn btn-outline-info btn-sm">View Members</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center">No families found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
