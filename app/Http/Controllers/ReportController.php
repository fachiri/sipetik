<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use App\Models\History;
use App\Models\Teknisi;
use App\Models\Assignment;
use App\Models\AttrCriteria;
use App\Models\Chat;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function get_atribut_kriteria($kode, $kriteria)
    {
        if ($kode == 'C2') {
            $kriteria = min($kriteria, 8);
            $kriteria = $kriteria . ' HARI';
        }
        $atribut_kriteria = AttrCriteria::where(['kode' => $kode, 'kriteria' => $kriteria])->value('bobot');
        return $atribut_kriteria;
    }

    public function get_prioritas_dengan_spk($reports)
    {
        $kriteria = collect([
            'C1' => [
                'nama' => 'Asal Aduan',
                'bobot' => 4,
            ],
            'C2' => [
                'nama' => 'Deadline',
                'bobot' => 5,
            ],
        ]);
        $jumlah_bobot = $kriteria['C1']['bobot'] + $kriteria['C2']['bobot'];
        $bobot_kepentingan = collect([
            'C1' => $kriteria['C1']['bobot'] / $jumlah_bobot,
            'C2' => $kriteria['C2']['bobot'] / $jumlah_bobot,
        ]);
        $matriks = collect([]);
        $today = Carbon::now();
        for ($i = 0; $i < $reports->count(); $i++) {
            $deadline = Carbon::parse($reports[$i]->tanggal);
            $matriks['A' . $i + 1] = [
                'ID' => $reports[$i]->id,
                'C1' => $this->get_atribut_kriteria('C1', $reports[$i]->user->level),
                'C2' => $this->get_atribut_kriteria('C2', $deadline->diff($today)->days + 1)
            ];
        }

        $c1Max = $matriks->pluck('C1')->max();
        $c1Min = $matriks->pluck('C1')->min();
        if ($c1Max - $c1Min == 0) {
            $c1Min = 0;
        }
        $c2Max = $matriks->pluck('C2')->max();
        $c2Min = $matriks->pluck('C2')->min();
        if ($c2Max - $c2Min == 0) {
            $c2Min = 0;
        }

        $normalisasi = collect([]);
        foreach ($matriks as $key => $value) {
            $normalisasi[$key] = [
                'C1' => ($matriks[$key]['C1'] - $c1Min) / ($c1Max - $c1Min),
                'C2' => ($matriks[$key]['C2'] - $c2Min) / ($c2Max - $c2Min)
            ];
        }

        $prefensi = collect([]);
        foreach ($normalisasi as $key => $value) {
            $nilai = ($bobot_kepentingan['C1'] * $normalisasi[$key]['C1']) + ($bobot_kepentingan['C2'] * $normalisasi[$key]['C2']);
            if ($nilai >= 0.8) {
                $kategori = 'Sangat Urgen';
            } elseif ($nilai >= 0.6) {
                $kategori = 'Urgen';
            } elseif ($nilai >= 0.4) {
                $kategori = 'Cukup Urgen';
            } elseif ($nilai >= 0.2) {
                $kategori = 'Kurang Urgen';
            } else {
                $kategori = 'Tidak Urgen';
            }
            $prefensi[$key] = [
                'nilai' => $nilai,
                'kategori' => $kategori
            ];
        }

        $reports->transform(function ($item, $key) use ($prefensi) {
            $item->urutan = $key + 1;
            $item->prioritas = $prefensi['A' . ($key + 1)]['kategori'];
            $item->prefensi = $prefensi['A' . ($key + 1)]['nilai'];

            return $item;
        });

        $reports->sortByDesc(function ($item) use ($prefensi) {
            return $prefensi['A' . $item->urutan]['nilai'];
        });

        return $reports;
    }

    public function landing()
    {
        $categories = Category::all();
        return view('landing')
            ->with('categories', $categories);
    }

    public function index()
    {
        $myreports = Report::where('user_id', auth()->user()->id)
            ->with('chat', 'history')
            ->get();
        $allreports = Report::orderBy('created_at', 'desc')->get();
        $total = [
            'verifikasi' => History::whereHas('report', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->where('status', 'Verifikasi')->count(),
            'proses' => History::whereHas('report', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->where('status', 'Proses')->count(),
            'selesai' => History::whereHas('report', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->where('status', 'Selesai')->count(),
        ];
        return view('report')
            ->with('allreports', $allreports)
            ->with('myreports', $myreports)
            ->with('total', $total);
    }

    public function pengaduan(Request $request)
    {
        $categories = Category::all();
        $query = Report::query();

        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $reports = $query->where('jenis', 'Pengaduan')
            ->with('user', 'history', 'chat')
            ->orderBy('created_at', 'desc')
            ->get();

        $reports = $this->get_prioritas_dengan_spk($reports);

        return view('pages.pengaduan.pengaduan-data', compact('categories', 'reports'));
    }

    public function permintaan(Request $request)
    {
        $categories = Category::all();
        $query = Report::query();

        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $reports = $query->where('jenis', 'Permintaan')
            ->with('user', 'history', 'chat')
            ->orderBy('created_at', 'desc')
            ->get();

        $reports = $this->get_prioritas_dengan_spk($reports);

        return view('pages.permintaan.permintaan-data', compact('categories', 'reports'));
    }

    public function saran(Request $request)
    {
        $categories = Category::all();
        $query = Report::query();

        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $reports = $query->where('jenis', 'Saran')
            ->with('user', 'history', 'chat')
            ->orderBy('created_at', 'desc')
            ->get();

        $reports = $this->get_prioritas_dengan_spk($reports);

        return view('pages.saran.saran-data', compact('categories', 'reports'));
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
        $categories = Category::all();
        $report = Report::where('report_id', $reportId)
            ->with('user', 'history')
            ->get()[0];

        $teknisi2 = Teknisi::with('category')->get();
        return view('pages.pengaduan.pengaduan-edit')->with([
            'categories' => $categories,
            'report' => $report,
            'teknisi2' => $teknisi2,
        ]);
    }

    public function report_verified(Request $request, $id)
    {
        try {
            if ($request->status != 'Verifikasi Gagal') {
                $validator = Validator::make($request->all(), [
                    'category' => auth()->user()->role == 'ADMIN' ? 'required' : '',
                    'tanggapan' => 'required|string',
                    'status' => 'required',
                    'teknisi' => auth()->user()->role == 'KABID' ? 'required' : '',
                ]);

                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }
            }

            switch (Report::where('id', $id)->value('jenis')) {
                case 'Pengaduan':
                    $route = 'pengaduan';
                    break;

                case 'Permintaan':
                    $route = 'permintaan';
                    break;

                case 'Saran':
                    $route = 'saran';
                    break;

                default:
                    $route = 'dashboard';
                    break;
            }

            $message = 'Laporan ini telah ditolak!';
            if ($request->status == 'Verifikasi') {
                $message = 'Laporan ini telah diverifikasi!';
                foreach ($request->teknisi as $teknisi) {
                    Assignment::create([
                        'report_id' => $id,
                        'teknisi_id' => $teknisi,
                        'status' => 'NOT_WORKING'
                    ]);
                }
            }
            if ($request->status == 'Tulis Laporan') {
                $message = 'Laporan ini telah didisposisi!';
                Report::where('id', $id)->update(['kategori' => $request->category]);
            }
            History::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'status' => $request->status,
            ]);

            Chat::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'isi' => $request->tanggapan,
            ]);

            return redirect(route($route))
                ->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', $th->getMessage())
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function report_process(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggapan' => 'required|string',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                throw new Exception('Isi form dengan benar!');
            }

            switch (Report::where('id', $id)->value('jenis')) {
                case 'Pengaduan':
                    $route = 'pengaduan';
                    break;

                case 'Permintaan':
                    $route = 'permintaan';
                    break;

                case 'Saran':
                    $route = 'saran';
                    break;

                default:
                    $route = 'dashboard';
                    break;
            }

            $assignments = Assignment::where('report_id', $id)->get();

            if ($request->status == 'Proses') {
                $message = 'Pengaduan ini telah diproses!';
                // ubah status penugasan menjadi WORKING pada tabel assignments
                $assignments->each(function ($assignment) {
                    $assignment->update([
                        'status' => 'WORKING'
                    ]);
                });
            } elseif ($request->status == 'Proses Gagal') {
                $message = 'Pengaduan ini telah ditolak!';
                // ubah status penugasan menjadi UNDONE pada tabel assignments
                $assignments->each(function ($assignment) {
                    $assignment->update([
                        'status' => 'UNDONE'
                    ]);
                });
            } else {
                throw new Exception('Terjadi kesalahan!');
            }

            History::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'status' => $request->status,
            ]);


            Chat::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'isi' => $request->tanggapan,
            ]);

            return redirect(route($route))
                ->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', $th->getMessage())
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function report_finish(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'bukti' => 'required',
                'tanggapan' => 'required|string',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                throw new Exception('Isi form dengan benar!');
            }

            switch (Report::where('id', $id)->value('jenis')) {
                case 'Pengaduan':
                    $route = 'pengaduan';
                    break;

                case 'Permintaan':
                    $route = 'permintaan';
                    break;

                case 'Saran':
                    $route = 'saran';
                    break;

                default:
                    $route = 'dashboard';
                    break;
            }

            $assignments = Assignment::where('report_id', $id)->get();
            $message = 'Pengaduan ini telah selesai!';

            // upload bukti pengerjaan
            $filename = null;
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('bukti', $filename, 'public'); // Adjust the storage path as needed
            }

            // ubah status penugasan menjadi DONE pada tabel assignments
            $assignments->each(function ($assignment) {
                $assignment->update([
                    'status' => 'DONE'
                ]);
            });

            History::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'status' => 'Selesai',
            ]);

            Chat::create([
                'user_id' => auth()->user()->id,
                'report_id' => $id,
                'isi' => $request->tanggapan,
            ]);

            Report::where('id', $id)->update([
                'bukti' => $filename
            ]);

            return redirect(route($route))
                ->with('success', $message);
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
                'isi' => 'required|string',
                'tanggal' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        if ($value <= now()) {
                            $fail('Minimal deadline adalah 1 Hari');
                        }
                    },
                ],
                'lampiran' => $request->jenis == 'Permintaan' ? 'required' : '',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            if ($request->jenis == 'Pengaduan') {
                $report_id = 'PD' . now()->timestamp;
            } elseif ($request->jenis == 'Permintaan') {
                $report_id = 'PM' . now()->timestamp;
            } elseif ($request->jenis == 'Saran') {
                $report_id = 'SR' . now()->timestamp;
            } else {
                throw new Exception('Terjadi kesalahan, Report ID tidak bisa dibuat!');
            }

            // upload lampiran
            if ($request->hasFile('lampiran')) {
                $file = $request->file('lampiran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('lampiran', $filename, 'public'); // Adjust the storage path as needed
            }

            $report = Report::create([
                'report_id' => $report_id,
                'user_id' => auth()->user()->id,
                'judul' => $request->judul,
                'jenis' => $request->jenis,
                'kategori' => $request->kategori,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'lampiran' => $filename ?? null,
            ]);

            History::create([
                'report_id' => $report->id,
                'user_id' => auth()->user()->id
            ]);

            Chat::create([
                'user_id' => 1,
                'report_id' => $report->id,
                'isi' => 'Laporan anda akan ditinjau, mohon tunggu informasi berikutnya perihal laporan anda!',
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

    public function show(Report $report)
    {
        //
    }

    public function edit(Report $report)
    {
        //
    }

    public function update(Request $request, Report $report)
    {
        //
    }

    public function destroy(Report $report)
    {
        //
    }
}
