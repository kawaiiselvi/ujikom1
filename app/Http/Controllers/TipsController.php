<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tip;
use Session;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class TipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
   		if ($request->ajax()){
            $tip = Tip::select(['id','Judul']);
            return Datatables::of($tip)
            ->addColumn('action',function($tip){
                return view('datatable._action', [
                    'model'     => $tip,
                    'form_url'  => route('tips.destroy',$tip->id),
                    'edit_url'  => route('tips.edit',$tip->id),
                    'confirm_message' => 'Yakin Ingin Menghapus ' . $tip->nama . ' ?' ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'Tips','name'=>'Tips','title'=>'Judul'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('tips.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'Tips'=>'required']);
        $tip = Tip::create($request->only('Tips'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan $tip->Tips"]);
        return redirect()->route('tips.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
