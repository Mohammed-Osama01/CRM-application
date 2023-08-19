<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class UserController extends Controller
{
    public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}

    public function index()
    {
        $user = Auth::user();
        $clients = $user->clients;
        return view('users.index', compact('clients'));
    }
    public function create()
    {
        $client = new Client();
        return view('users.create', compact('client'));
    }

    //edit&updated
    public function edit($id)
    {
        $client = Client::find($id);
        return view('users.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            // 'image' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        // Uploads Files
        $clients = Client::find($id);
        $img_name = $clients->image;
        // Uploads Files
        if($request->hasFile('image')) {
            File::delete(public_path('uploads/clients/'.$img_name));
            $img = $request->file('image');
            $img_name = time().rand().$img->getClientOriginalName();
            $img->move(public_path('uploads/posts'), $img_name);
        }
        // Store data to database
        $clients->update([
            'name' => $request->name,
            'image' => $img_name,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        // Redirect the user
        return redirect()->route('dashboard.index')->with('msg', 'Post Updated successfully');
    }


    //Actions
    public function show($id)
    {
        $client = Client::find($id);
        if(!$client) {
            return redirect()->route('dashboard.index');
        }
        // dd($Client->name);
        return view('users.show', compact('client'));

    }
    public function destroy($id)
    {
        Client::destroy($id);
        return redirect()->route('dashboard.index')->with('msg', 'Client deleted successfully');
        // return redirect()->back();
    }

    public function trash()
    {
        $clients = Client::onlyTrashed()->orderByDesc('id')->get();
        return view('users.trash', compact('clients'));
    }

    public function restore($id)
    {
        Client::onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('msg','Client restored successfully');
    }

    public function forcedelete($id)
    {
        Client::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('msg','Client Deleted successfully');
    }


    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            // 'image' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        // Uploads Files
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $img_name = time() . rand() . $img->getClientOriginalName();
            $img->move(public_path('uploads/clients'), $img_name);
        } else {
            $img_name = 'no-image.jpg';
        }
        // Store data to database
        Client::create([
            'name' => $request->name,
            'image' => $img_name,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        // Redirect the user
        return redirect()->route('dashboard.index')->with('msg', 'Client created successfully');
    }


}
