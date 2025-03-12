<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use App\Models\Job;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use DataTables;
use Exception;

class SavedJobController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $headOfFamily = SavedJob::where('user_id',auth()->user()->id)->select('*')->latest();
                return Datatables::of($headOfFamily)
                  ->addIndexColumn()
                  ->addColumn('title',function($row){
                    return $row->job?->title??'N/A';
                  })
                  ->addColumn('company',function($row){
                    return $row->job?->company??'N/A';
                  })
                  ->addColumn('category',function($row){
                    return $row->job?->category??'N/A';
                  })
                  
                ->rawColumns(['title','company','category'])->make(true);
           }else{
              return view('saved_job.index');
           }
    }

    // Save a job
    public function saveJob(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'job_id' => 'required|exists:jobs,id'
        ]);

        // Prevent duplicate entries
        $savedJob = SavedJob::firstOrCreate([
            'user_id' => $user->id,
            'job_id' => $request->job_id,
        ]);

        return response()->json(['message' => 'Job saved successfully', 'saved_job' => $savedJob]);
    }

    // Delete a saved job
    public function deleteJob($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $savedJob = SavedJob::where('id', $id)->where('user_id', $user->id)->first();

        if (!$savedJob) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $savedJob->delete();
        return response()->json(['message' => 'Job removed from saved jobs']);
    }

    // Get all saved jobs for the user
    public function savedJobs()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $savedJobs = SavedJob::where('user_id', $user->id)->with('job')->get();

        return response()->json($savedJobs);
    }
}
