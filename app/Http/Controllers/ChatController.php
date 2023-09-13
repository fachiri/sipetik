<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Report;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'report_id' => 'required',
                'user_id' => 'required',
                'isi' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            Chat::create([
                'user_id' => $request->user_id,
                'report_id' => $request->report_id,
                'isi' => $request->isi
            ]);

            return response()->json('Tanggapan berhasil dibuat!', 201);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function get_chats($reportId)
    {
        $report = Report::findOrFail($reportId); // Ganti dengan model dan kolom yang sesuai
        $chats = $report->chat;

        $response = new StreamedResponse(function () use ($chats) {
            foreach ($chats as $chat) {
                $data = [
                    'id' => $chat->id,
                    'user' => [
                        'profile_photo_url' => $chat->user->profile_photo_url,
                        'name' => $chat->user->name,
                        'role' => $chat->user->role,
                        'id' => $chat->user->id,
                    ],
                    'created_at' => Carbon::parse($chat->created_at)->diffForHumans(),
                    'isi' => $chat->isi,
                ];

                echo "event: chat\n";
                echo "data: " . json_encode($data) . "\n\n";
                ob_flush();
                flush();
                usleep(100000); // Jeda untuk mengatur frekuensi pengiriman
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }

    public function read_chats($reportId)
    {
        try {
            Chat::where('report_id', $reportId)->update([
                'read_status' => 1
            ]);
            return redirect()
                ->back()
                ->with('success', 'Pesan telah dibaca');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function get_total_chat($userId)
    {
        try {
            $reports = Report::where('user_id', $userId)->with('chat')->get();
            return response()
                ->json($reports, 200);
        } catch (\Exception $e) {
            return response()
                ->json($e->getMessage(), 500);
        }
    }
}
