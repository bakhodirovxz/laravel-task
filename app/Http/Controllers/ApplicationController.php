<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{

    public function index(){
        return view('applications.index')->with([
            'applications' => auth()->user()->applications()->latest()  ->paginate(5),
        ]);
    }


    public function store(Request $request)
    {
        if ($this->checkDate()) {
            return redirect()->back()->withErrors(['limit' => 'You have already submitted an application today. Please try again tomorrow.']);
        }



        $validated = $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $fileUrl = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            $filePath = $file->storeAs('applications', $originalName, 'public');

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

    protected function checkDate()
    {
        $alreadySubmitted = Application::where('user_id', auth()->id())->whereDate('created_at', Carbon::today())->exists();
        if ($alreadySubmitted) {
            return true;
        }
    }
}
