<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
}
