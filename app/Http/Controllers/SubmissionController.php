<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\Submission;
use App\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $data = Session::get('data');
        
        $querySubmission = Submission::query();
        $querySubmission->where('organization_id', Account::where('email', Auth::user()->email)->get()[0]->organization_id);
        
        return view('submission/index', ['submissions' => $querySubmission->paginate(5), 'data' => $data]);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        
        $querySubmission = Submission::with('organization');
        $querySubmission->where('organization_id', Account::where('email', Auth::user()->email)->get()[0]->organization_id);
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
        
        return view('submission/index', [
                                        'submissions' => $querySubmission->paginate(5),
                                        ]);
    }


    public function create()
    {
        $organization = Account::where('email', Auth::user()->email)->get()[0]->organization->name;
        return view('submission/create', ['organization' => $organization]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
                'organization' => 'required',
                'year' => 'required|uniqueYearAndMonth:'.$data['month'].', '.Account::where('email', Auth::user()->email)->get()[0]->organization_id,
                'month' => 'required',
                'file' => 'required',
            ],
            [
                'unique_year_and_month' => 'Submission cannot be duplicate.'
            ]
        );
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validator($input)->validate();
        
        $submission = new Submission;
        $submission->organization_id = Account::where('email', Auth::user()->email)->get()[0]->organization_id;
        $submission->year = $input['year'];
        $submission->month = $input['month'];
        $submission->status = "Submitted";
        $submission->file = $request->file('file')->store('files');
        $submission->save();
        return redirect()->route('submission.index')->with('data', 'create');
    }

    public function download($id)
    {
        $submission = Submission::find($id);
        $file = $submission->file;
        return Storage::download($file);
    }

    public function show($id)
    {
        $submission = Submission::find($id);
        $organization = Account::where('email', Auth::user()->email)->get()[0]->organization->name;
        return view('submission/show', ['organization' => $organization, 'submission' => $submission]);
    }


    public function edit($id)
    {
        $submission = Submission::find($id);
        $organization = Account::where('email', Auth::user()->email)->get()[0]->organization->name;
        return view('submission/edit', ['organization' => $organization, 'submission' => $submission]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        Validator::make($input, [
                'file' => 'required']
        )->validate();
        
        Submission::find($id)->delete();
        Submission::where('year', $input['year'])->where('month', $input['month'])->delete();
        $submission = new Submission;
        $submission->organization_id = Account::where('email', Auth::user()->email)->get()[0]->organization_id;
        $submission->year = $input['year'];
        $submission->month = $input['month'];
        $submission->status = "Submitted";
        $submission->file = $request->file('file')->store('files');
        $submission->save();

        return redirect(route('submission.index'));
    }


    public function destroy($id)
    {
        //
    }
}
