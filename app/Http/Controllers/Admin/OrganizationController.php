<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Organization;
use App\Account;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $organizations = Organization::paginate(4);
        return view('admin.organization.index', ['organizations' => $organizations]);
    }
    
    public function search(Request $request)
    {
        $input = $request->all();
        
        $organization = Organization::query();
        if (!empty($input['keyword']))
        {
            $organization->where('name', 'like', '%' . $input['keyword'] . '%');
        }
        
        return view('admin.organization.index', ['organizations' => $organization->paginate(4)]);
    }

    public function create()
    {
        return view('admin.organization.create');
    }

    protected function validator(array $data)
    {
        $data['email'] = $data['emails'][0];
        return Validator::make($data, [
                'name' => 'required|string|min:6|max:255',
                'emails.*' => 'email|nullable|distinct',
                'emails.0' => 'required|email',
                'email' => 'unique:users',
                'passwords.*' => 'string|min:6|nullable',
                'passwords.0' => 'required',
            ],
            [
                'emails.0.required' => 'Email Required',
                'passwords.0.required' => 'Password Required',
            ]
        );
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validator($input)->validate();

        $organization = new Organization;
        $organization->name = $input['name'];
        $organization->save();

        $i = 0;
        foreach ($input['emails'] as $email) {
            if ($i == 0)
            {
                $user = new User(['email' => $input['emails'][$i], 'password' => bcrypt($input['passwords'][$i])]);
                $user->save();
                $i ++;
            }
            $account = new Account(['email' => $email, 'password' => $input['passwords'][$i]]);
            $organization->accounts()->save($account);
        }

        return redirect(route('admin.organization.index'));
    }

    public function show($id)
    {
        $organization = Organization::find($id);
        return view('admin.organization.show', ['organization' => $organization]);
    }

    public function edit($id)
    {
        $organization = Organization::find($id);
        return view('admin.organization.edit', ['organization' => $organization]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->validator($input)->validate();

        
        $organization = Organization::find($id);
        $organization->name = $input['name'];
        $organization->save();

        $i = 0;
        $organization->accounts()->delete();
        foreach ($input['emails'] as $email) {
            if ($i == 0)
            {
                $user = User::where('email', $input['emails'][$i])->first();
                if ($user == null)
                {
                    $user = new User(['email' => $input['emails'][$i], 'password' => bcrypt($input['passwords'][$i])]);
                }
                else
                {
                    $user->password = bcrypt($input['passwords'][$i]);
                }
                $user->save();
                $i ++;
            }
            $account = Account::where('email', $email)->first();
            if ($account == null)
            {
                $account = new Account(['email' => $email, 'password' => bcrypt($input['passwords'][$i])]);
            }
            else
            {
                $account->password = bcrypt($input['passwords'][$i]);
            }
            $organization->accounts()->save($account);
        }

        return redirect(route('admin.organization.index'));
    }

    public function destroy($id)
    {
    }
}
