<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Group;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request  $request)
    {
        $groupId = $request->query('group_id');
        session(['group_id' => $groupId]);
        $userId = Auth::user()->id;
        session(['userId' => $userId]);
        $files = File::where('group_id', $groupId)->get();


        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupId = session('group_id');
        return view('files.create', compact('groupId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        // Retrieve the authenticated user's ID and the group ID from the request
        $userId = Auth::user()->id;
        $groupId = $request->input('group_id');
        session(['group_id' => $groupId]);
        // Create a new File instance
        $file = new File();

        // Fill the file attributes from the validated request data
        $file->fill($request->validated());

        // Set the status, user ID, and group ID
        $file->status = $userId;
        $file->group_id = $groupId;

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $destinationPath = public_path('uploads');
            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($destinationPath, $fileName);
            $file->path = $destinationPath . '/' . $fileName;
        }

        // Save the file
        $file->save();
        $files = File::where('group_id', $groupId)->get();
        // Redirect to the index page with a success message
        return redirect()->route('files.index', compact('files'))->with('success', 'File created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('files.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        // Retrieve the group_id from the session
        $groupId = session('group_id');
        // Retrieve the user ID from the session
        $userId = session('userId');

        // Check if the file's status is equal to the user's ID
        if ($file->status != $userId) {
            // If not, return a response indicating that the user doesn't have permission
            return redirect()->route('files.index')->with('error', 'You do not have permission to update this file.');
        }

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $destinationPath = public_path('uploads');
            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($destinationPath, $fileName);
            $file->path = $destinationPath . '/' . $fileName;
        }

        // Update the file attributes from the validated request data
        $file->fill($request->all());

        // Save the updated file
        $file->save();

        // Store the group_id in the session again
        session(['group_id' => $groupId]);

        $files = File::where('group_id', $groupId)->get();

        return view('files.index', ['group_id' => $groupId, 'files' => $files])->with('success', 'Selected files updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully');
    }
    public function bulkUpdate(Request $request)
    {
        $selectedFiles = $request->input('selected_files', []);

        foreach ($selectedFiles as $fileId) {
            // Ensure the file exists and has status 0 before updating
            $file = File::find($fileId);

            if ($file && $file->status == 0) {
                $file->update(['status' =>  Auth::user()->id]);
            }
        }

        $groupId = session('group_id');
        $files = File::where('group_id', $groupId)->get();

        return view('files.index', ['group_id' => $groupId, 'files' => $files])->with('success', 'Selected files updated successfully.');
    }

    public function finishFile(Request $request)
    {
        $fileId = $request->input('file_id');
        $file = File::find($fileId);

        if ($file) {
            $file->update(['status' => 0]);
        }

        $groupId = session('group_id');
        $files = File::where('group_id', $groupId)->get();

        return response()->json(['message' => 'File finished successfully', 'files' => $files, 'redirect' => route('files.index', ['group_id' => $groupId])]);
    }
}
