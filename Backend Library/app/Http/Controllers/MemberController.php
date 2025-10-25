<?php
namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $members = Member::all();
        return response()->json($members, 200);
    }

    /**
     * Store a newly created member.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'required|string|max:15',
        ]);

        $member = Member::create($request->all());
        return response()->json($member, 201);
    }

    /**
     * Display the specified member.
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member, 200);
    }

    /**
     * Update the specified member.
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:members,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
        ]);

        $member->update($request->all());
        return response()->json($member, 200);
    }

    /**
     * Remove the specified member.
     */
    public function destroy($id)
    {
        Member::destroy($id);
        return response()->json(null, 204);
    }
}