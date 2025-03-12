<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use config;
use App\Models\Job;
use DataTables;
use Exception;

class JobController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $headOfFamily = Job::select('*')->latest();
                return Datatables::of($headOfFamily)
                  ->addIndexColumn()
                  
                ->rawColumns([])->make(true);
           }else{
              return view('jobs.index');
           }
    }

    public function fetchJobs(Request $request)
    {
        $query = $request->query('query', '');
        $location = $request->query('location', '');

        // Fetch API credentials from config
        $app_id = config('services.job_api.app_id');
        $app_key = config('services.job_api.app_key');
        $base_url = config('services.job_api.base_url');

        if (!$app_id || !$app_key || !$base_url) {
            return response()->json(['error' => 'API credentials not configured'], 500);
        }

        // Construct API request URL dynamically
        $api_url = "{$base_url}?app_id={$app_id}&app_key={$app_key}&what={$query}&where={$location}";

        // Make the API request
        $response = Http::get($api_url);

        // Handle API failure
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch jobs'], $response->status());
        }

        $jobData = $response->json();

        // Extract relevant job details and store in the database
        foreach ($jobData['results'] as $job) {
            Job::updateOrCreate(
                ['url' => $job['redirect_url']], // Prevent duplicate jobs
                [
                    'title' => $job['title'],
                    'company' => $job['company']['display_name'] ?? 'Unknown',
                    'category' => $job['category']['label'] ?? 'General',
                    'location' => $job['location']['display_name'] ?? 'Unknown',
                    'description' => strip_tags($job['description']),
                    'salary_min' => $job['salary_min'] ?? null,
                    'salary_max' => $job['salary_max'] ?? null,
                    'latitude' => $job['latitude'] ?? null,
                    'longitude' => $job['longitude'] ?? null,
                    'contract_time' => $job['contract_time'] ?? 'Not specified'                ]
            );
        }

        return response()->json([
            'message' => 'Jobs fetched and stored successfully',
            'data' => Job::latest()->take(10)->get() // Return latest 10 jobs
        ]);
    }

    public function searchJobs(Request $request){

        $query = Job::query();

        if ($request->filled('title') && !empty($request->title)) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->filled('location') && !empty($request->location)) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->filled('category') && !empty($request->category)) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        $jobs = $query->paginate(10); // Paginate results

        return response()->json($jobs);
    }
      
}
