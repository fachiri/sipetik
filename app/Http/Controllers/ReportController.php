<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ReportController extends Controller
{
    public function landing()
    {
        $categories = Category::all();
        return view('landing')
            ->with('categories', $categories);
    }

    public function index()
    {
        $myreports = Report::where('user_id', auth()->user()->id)->get();
        return view('report')
            ->with('myreports', $myreports);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'judul' => 'required|string',
                'jenis' => 'required|string',
                'kategori' => 'required|string',
                'isi' => 'required|string',
                'tanggal' => 'required|date',
            ]);
            
            if ($validator->fails()) {
                throw new Exception('Isi form dengan benar!');
            }

            Report::create([
                'user_id' => auth()->user()->id,
                'judul' => $request->judul,
                'jenis' => $request->jenis,
                'kategori' => $request->kategori,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'lampiran' => $request->lampiran,
            ]);

            return redirect(route('report'))
                ->with('success', 'Laporan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', $th->getMessage())
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
