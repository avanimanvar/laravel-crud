<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->paginate(5);
        return view('index', compact('data'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'gender' => 'required',
            'avatar' => 'required|image|max:2048'
        ]);
        //Upload image
        $avatar = $request->file('avatar');
        $avatarRanName = rand() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('images'), $avatarRanName);

        //Store user
        $data = $request->all();
        $data['avatar'] = $avatarRanName;
        $data['education'] = implode(',', $data['education']);
        $data['password'] = bcrypt($data['password']);

        if (User::create($data)) {
            return redirect('user')->with('success', 'User added successfully.');
        }

        return redirect('user/create')->with('error', 'Something went wrong.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('edit', compact('data'));
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
        $data = $request->all();
        $avatar = $request->old_avatar;
        $image = $request->file('avatar');
        if ($image != '') { //Store new image
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'avatar' => 'image|max:2048',
                'gender' => 'required'
            ]);
            @unlink(public_path('images') . '/' . $avatar); //unlink previous one
            $avatar = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $avatar);
        } else {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'gender' => 'required'
            ]);
        }

        $form_data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'avatar' => $avatar,
            'education' => implode(',', $data['education'])
        ];

        User::whereId($id)->update($form_data); //Update user data

        return redirect('user')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect('user')->with('success', 'User is successfully deleted');
    }
}
