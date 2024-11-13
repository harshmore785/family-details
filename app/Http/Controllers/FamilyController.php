<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyRequest;
use Illuminate\Http\Request;
use App\Models\FamilyHead;
use App\Models\FamilyMember;
use App\Models\State;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('dd');
        $families = FamilyHead::with('state', 'city')->withCount('familyMembers')->get();
        return view('family.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::latest()->get();
        return view('family.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFamilyRequest $request)
    {
        // Store the family head data
        $familyHeadData = $request->only(['name', 'surname', 'birthdate', 'mobile_no', 'address', 'state_id', 'city_id', 'pincode', 'marital_status', 'wedding_date', 'hobbies']);
        if ($request->hasFile('photo')) {
            $familyHeadData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->has('hobbies') && is_array($request->hobbies)) {
            $familyHeadData['hobbies'] = json_encode($request->hobbies);
        }

        $familyHead = FamilyHead::create($familyHeadData);

        // Store the family members data
        if ($request->has('family_members')) {
            foreach ($request->family_members as $member) {
                $memberData = $member;
                $memberData['family_head_id'] = $familyHead->id;
                if (isset($member['photo'])) {
                    $memberData['photo'] = $member['photo']->store('photos', 'public');
                }
                FamilyMember::create($memberData);
            }
        }

        return redirect()->route('family.index')->with('success', 'Family information saved successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $familyHead = FamilyHead::with('familyMembers')->findOrFail($id);

        return view('family.show', compact('familyHead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
