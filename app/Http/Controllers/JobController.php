<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
   function addJob(Request $request){
        $validated = $request->validate([
            'job_name' => 'required',
        ]);

        $job = new Job;
        $doc_id = $request->doc_id;
        $job->doc_id = $doc_id;
        $job->job_name = $request->job_name;
        $job->job_deadline = $request->job_deadline;
        $job->save();
    
        return redirect("home/$doc_id");
    } 


    function deleteJob($id){
        $job = Job::find($id);
        $pathCurrent = str_replace(url('/'), '', url()->previous());
        $job->delete();
        return redirect($pathCurrent);
    }
}