<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Report;

class FeedbackController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $feedbacks = Feedback::class;
        return view('pages.feedback.feedback-data', compact('feedbacks', 'categories'));
    }

    public function create()
    {
        //
    }

    public function store(StoreFeedbackRequest $request)
    {
        try {
            Feedback::create([
                'user_id' => auth()->user()->id,
                'rate' => $request->rate,
                'report_id' => $request->report_id
            ]);

            Report::where('id', $request->report_id)->update([
                'feedback_status' => 'SUBMITTED'
            ]);

            return response()->json('Feedback berhasil dikirim!', 201);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function show(Feedback $feedback)
    {
        //
    }

    public function edit(Feedback $feedback)
    {
        //
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    public function destroy(Feedback $feedback)
    {
        //
    }
}
