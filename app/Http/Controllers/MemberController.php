<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Reservoir;
use Illuminate\Http\Request;
use Validator;
use PDF;


class MemberController extends Controller
{
    const RESULTS_IN_PAGE = 5;
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::orderBy('surname')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        $reservoirs = Reservoir::orderBy('title')->get();
        if ($request->filter && 'reservoir' == $request->filter) {
            $members = Member::where('reservoir_id', $request->reservoir_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        elseif ($request->sort && 'name' == $request->sort) {
            $members = Member::orderBy('name')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        elseif ($request->sort && 'surname' == $request->sort) {
            $members = Member::orderBy('surname')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        elseif ($request->sort && 'live' == $request->sort) {
            $members = Member::orderBy('live')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        elseif ($request->sort && 'new' == $request->sort) {
            $members = Member::orderBy('created_at', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        return view('member.index', ['members' => $members, 'reservoirs' => $reservoirs, 'reservoir_id' => $request->reservoir_id ?? '0']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservoirs = Reservoir::orderBy('title')->get();
        return view('member.create', ['reservoirs' => $reservoirs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'member_name' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:100'],
            'member_surname' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:150'],
            'member_live' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:50'],
            'member_experience' => ['required', 'numeric'],
            'member_registered' => ['required', 'numeric', 'lt:member_experience'],
            'reservoir_id' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $member = new Member;
        
        
        $member->name = mb_convert_case($request->member_name, MB_CASE_TITLE, 'UTF-8');
        $member->surname = mb_convert_case($request->member_surname, MB_CASE_TITLE, 'UTF-8');
        $member->live = mb_convert_case($request->member_live, MB_CASE_TITLE, 'UTF-8');
        $member->experience = $request->member_experience;
        $member->registered = $request->member_registered;
        $member->reservoir_id = $request->reservoir_id;
        
        $member->save();
        return redirect()->route('member.index')->with('success_message', 'Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $reservoirs = Reservoir::all();
        return view('member.edit', ['member' => $member, 'reservoirs' => $reservoirs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
            $validator = Validator::make($request->all(),
        [
            'member_name' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:100'],
            'member_surname' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:150'],
            'member_live' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:50'],
            'member_experience' => ['required', 'numeric'],
            'member_registered' => ['required', 'numeric', 'lt:member_experience'],
            'reservoir_id' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        
        
        $member->name = mb_convert_case($request->member_name, MB_CASE_TITLE, 'UTF-8');
        $member->surname = mb_convert_case($request->member_surname, MB_CASE_TITLE, 'UTF-8');
        $member->live = mb_convert_case($request->member_live, MB_CASE_TITLE, 'UTF-8');
        $member->experience = $request->member_experience;
        $member->registered = $request->member_registered;
        $member->reservoir_id = $request->reservoir_id;
        
        $member->save();
        return redirect()->route('member.index')->with('success_message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('member.index')->with('success_message', 'Successfully removed.');
    }
}
