<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Organization;
use App\Submission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $querySubmission = Submission::query();
        $querySubmission->orderBy('organization_id');
        
        return view('admin.submission.index', ['submissions' => $querySubmission->paginate(4)]);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        
        $querySubmission = Submission::with('organization');
        if (!empty($input['organization']))
        {
            $querySubmission->whereHas('organization', function($query) use ($input){
                return $query->where('name', 'like', '%' . $input['organization'] . '%');
            });
        }
        if (!empty($input['year']))
        {
            $querySubmission->where('year', $input['year']);
        }
        if (!empty($input['month']))
        {
            $querySubmission->where('month', $input['month']);
        }
        if (!empty($input['keyword']))
        {
            $querySubmission->whereHas('organization', function($query) use ($input){
                return $query->where('name', 'like', '%' . $input['keyword'] . '%');
            });
        }
        $querySubmission->orderBy('organization_id');
        
        return view('admin.submission/index', [
                                        'submissions' => $querySubmission->paginate(4),
                                        ]);
    }

    public function create()
    {
        $organizations = Organization::all()->pluck('name', 'id');
        return view('admin.submission.create', ['organizations' => $organizations]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'organization' => 'required',
            'year' => 'required|uniqueYearAndMonth:'.$data['month'].', '.$data['organization'],
            'month' => 'required',
            'file' => 'required',
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validator($input)->validate();

        $submission = new Submission;
        $submission->organization_id = $input['organization'];
        $submission->year = $input['year'];
        $submission->month = $input['month'];
        $submission->status = "Submitted";
        $submission->file = $request->file('file')->store('files');
        $submission->save();
        return redirect(route('admin.submission.index'));
    }

    public function show($id)
    {
        $submission = Submission::find($id);
        $organizations = Organization::all()->pluck('name', 'id');
        return view('admin.submission.show', ['organizations' => $organizations, 'submission' => $submission]);
    }

    public function download($id)
    {
        $submission = Submission::find($id);
        $file = $submission->file;
        $submission->download_status = "Downloaded";
        $submission->download_date = date("Y-m-d h:i:s a", time());
        $submission->save();
        return Storage::download($file);
    }

    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $submission = Submission::find($id);
        $submission->organization_id = $input['organization'];
        $submission->year = $input['year'];
        $submission->month = $input['month'];
        // $submission->month = $request->file('file')->store('files');
        $submission->save();
        return redirect(route('admin.submission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
