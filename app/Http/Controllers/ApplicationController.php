<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $fileUrl = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('applications', 'public');
            $fileUrl = $filePath;
        }

        $application = new Application();
        $application->user_id = auth()->id();
        $application->subject = $validated['subject'];
        $application->message = $validated['message'];
        $application->file_url = $fileUrl;
        $application->save();

        dispatch(new SendEmailJob($application));


        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}
