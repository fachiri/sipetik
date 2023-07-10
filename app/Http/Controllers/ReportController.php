<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use App\Models\History;
use App\Models\Teknisi;
use App\Models\Assignment;
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

    public function pengaduan()
    {
        $categories = Category::all();
        return view('pages.pengaduan.pengaduan-data')->with([
            'categories' => $categories,
            'reports' => Report::class
        ]);
    }

    public function permintaan()
    {
        $categories = Category::all();
        return view('pages.permintaan.permintaan-data')->with([
            'categories' => $categories,
            'reports' => Report::class
        ]);
    }

    public function saran()
    {
        $categories = Category::all();
        return view('pages.saran.saran-data')->with([
            'categories' => $categories,
            'reports' => Report::class
        ]);
    }

    public function pengaduan_detail($reportId)
    {
        $report = Report::where('report_id', $reportId)
            ->with('user', 'history')
            ->get()[0];
        return view('pages.pengaduan.pengaduan-detail')->with([
            'report' => $report
        ]);
    }

    public function pengaduan_edit($reportId)
    {
        $report = Report::where('report_id', $reportId)
            ->with('user', 'history')
            ->get()[0];

        $teknisi2 = Teknisi::with('category')->get();
        return view('pages.pengaduan.pengaduan-edit')->with([
            'report' => $report,
            'teknisi2' => $teknisi2,
        ]);
    }

    public function report_verified(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggapan' => 'required|string',
                'teknisi' => 'required',
            ]);

            
            if ($validator->fails()) {
                throw new Exception('Isi form dengan benar!');
            }

            History::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'status' => 'Verifikasi',
            ]);

            foreach ($request->teknisi as $teknisi) {
                Assignment::create([
                    'report_id' => $id,
                    'teknisi_id' => (int)$teknisi
                ]);
            }

            return redirect(route('pengaduan'))
                ->with('success', 'Pengaduan telah diverifikasi!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', $th->getMessage())
                ->withErrors($validator)
                ->withInput();
        }
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

            if ($request->jenis == 'Pengaduan') {
                $report_id = 'PD'.now()->timestamp;
            } elseif ($request->jenis == 'Permintaan') {
                $report_id = 'PM'.now()->timestamp;
            } elseif ($request->jenis == 'Saran') {
                $report_id = 'SR'.now()->timestamp;
            } else {
                throw new Exception('Terjadi kesalahan, Report ID tidak bisa dibuat!');
            }

            $report = Report::create([
                'report_id' => $report_id,
                'user_id' => auth()->user()->id,
                'judul' => $request->judul,
                'jenis' => $request->jenis,
                'kategori' => $request->kategori,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'lampiran' => $request->lampiran,
            ]);

            History::create([
                'report_id' => $report->id,
                'user_id' => auth()->user()->id
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
