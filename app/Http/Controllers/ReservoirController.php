<?php

namespace App\Http\Controllers;

use App\Models\Reservoir;
use App\Models\Member;
use Illuminate\Http\Request;
use Validator;
use PDF;


class ReservoirController extends Controller
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
    public function index()
    {
        $reservoirs = Reservoir::orderBy('area', 'DESC')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('reservoir.index', ['reservoirs' => $reservoirs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservoir.create');
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
            'reservoir_title' => ['required', 'min:3', 'max:100'],
            'reservoir_area' => ['required','numeric', 'min:3', 'max:150'],
            'reservoir_about' => ['sometimes',  'max:500'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $reservoir = new Reservoir;
        
        // $member->name = mb_convert_case($request->reservoir_title, MB_CASE_TITLE, 'UTF-8');
        
        $reservoir->title = mb_convert_case($request->reservoir_title, MB_CASE_TITLE, 'UTF-8');
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;
        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function show(Reservoir $reservoir)
    {
        $members = Member::all();
        return view('reservoir.show', ['reservoir' => $reservoir, 'members' => $members]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservoir $reservoir)
    {
        return view('reservoir.edit', ['reservoir' => $reservoir]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservoir $reservoir)
    {
        $validator = Validator::make($request->all(),
        [
            'reservoir_title' => ['required','regex:/^([\p{L}]*)$/u', 'min:3', 'max:200'],
            'reservoir_area' => ['required','numeric', 'min:0', 'max:2000'],
            'reservoir_about' => ['required', 'min:200', 'max:500'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        
        // $member->name = mb_convert_case($request->reservoir_title, MB_CASE_TITLE, 'UTF-8');
        
        $reservoir->title = mb_convert_case($request->reservoir_title, MB_CASE_TITLE, 'UTF-8');
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;
        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservoir $reservoir)
    {
        if($reservoir->getMembers->count()){
            return redirect()->back()->with('info_message', 'Trinti negalima, nes turi knygų.');
        }
        $reservoir->delete();
        return redirect()->route('reservoir.index')->with('success_message', 'Sekmingai ištrintas.');
    }
    public function pdf(Reservoir $reservoir)
    {
        $members = Member::all();
        $pdf = PDF::loadView('reservoir.pdf', ['reservoir' => $reservoir, 'members' => $members]);
        return $pdf->download(ucfirst($reservoir->title).'.pdf');
    }

}
