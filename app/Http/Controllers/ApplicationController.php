<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

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
            $fileUrl = '/storage/' . $filePath;
        }

        $application = new Application();
        $application->user_id = auth()->id();
        $application->subject = $validated['subject'];
        $application->message = $validated['message'];
        $application->file_url = $fileUrl;
        $application->save();

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}
