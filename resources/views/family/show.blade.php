@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Family Members for {{ $familyHead->name }} {{ $familyHead->surname }}</h2>

    <a href="{{ route('family.index') }}" class="btn btn-outline-secondary mb-3">Back to Family List</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Marital Status</th>
                <th>Wedding Date</th>
                <th>Education</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($familyHead->familyMembers as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->birthdate }}</td>
                    <td>{{ $member->marital_status }}</td>
                    <td>{{ $member->wedding_date ?? 'N/A' }}</td>
                    <td>{{ $member->education ?? 'N/A' }}</td>
                    <td>
                        @if ($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" alt="Family Member Photo" width="100" height="100">
                        @else
                            No Photo
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No family members found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
