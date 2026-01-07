<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{
    public function create(Application $application, Request $request)
    {
        if (! Gate::allows('answer-application', $application)) {

            abort(403);

        }
        return view('answers.create', [ 'application' => $application]);
    }

    public function store(Application $application, Request $request)
    {

        if (! Gate::allows('answer-application', $application)) {

            abort(403);

        }

        $request->validate(['body' => 'required',]);

        $application->answers()->create([
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard')->with('success', 'Answer submitted successfully.');
    }
}
