<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $members = Member::where('assigned_by',Auth::user()->id)
                        ->where('deleted_at',null)
                        ->select('id', 'name','phone_no')
                        ->paginate(7);
       return view('admin.Member.memberList',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.Member.addMemberList');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15|unique:members,phone_no',
        ]);

        try {
            // Create a new member record
            $member = new Member();
            $member->name = $request->input('name');
            $member->phone_no = $request->input('phone_no');
            $member->assigned_by = Auth::user()->id;
            if($member->save()){
                return redirect()->route('members.index')->with('success', 'Member created successfully!');
            }else{
                return redirect()->back()->with('error', 'Failed to create member! Please Try Agiain.');
            }
            
        } catch (\Exception $e) {
            // Redirect with error message in case of failure
            return redirect()->back()->with('error', 'Failed to create member: ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
                       
            $member = Member::findOrFail($id);
            if($member){
                return view('admin.Member.viewMemberDetails', compact('member'));
            }else{
                return redirect()->route('members.index')->with('error', 'Member not found');
            }
            
        } catch (\Exception $e) {
            // If member not found, redirect with an error message
            return redirect()->route('members.index')->with('error', 'Member not found'. $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
             $member = Member::find($id);
             if($member){
                 return  view('admin.Member.editMemberList',compact('member'));
             }else{
                 return redirect()->back()->with('error', 'Member not found with this id! Please try again!!');
             }
         
        } catch (\Exception $e) {
         
         // Redirect with error message in case of failure
         return redirect()->back()->with('error', 'Failed to create member: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15|unique:members,phone_no,' . $id,
        ]);

        try {
            // Find the member and update details
            $member = Member::findOrFail($id);
            $member->name = $request->input('name');
            $member->phone_no = $request->input('phone_no');
            if($member->save()){
                return redirect()->route('members.index')->with('success', 'Member updated successfully!');
            }else{
                return redirect()->back()->with('error', 'Failed to update member! Please try again!');
            }
            
        } catch (\Exception $e) {
            // Redirect with error message in case of failure
            return redirect()->back()->with('error', 'Failed to update member: ' . $e->getMessage());
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            
            $member = Member::findOrFail($id); 
    
            // Soft delete the member
            if($member){
                $member->delete();
                return redirect()->route('members.index')->with('success', 'Member deleted successfully');
            }else{
                return redirect()->route('members.index')->with('error', 'Member Not Found!');
            }

        } catch (\Exception $e) {
            
            return redirect()->route('members.index')->with('error', 'An error occurred while deleting the member');
        }
        
    }
}
