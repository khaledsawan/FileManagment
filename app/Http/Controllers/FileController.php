<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Group;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request  $request)
    {
        $groupId = $request->query('group_id');

        $files = File::where('group_id', $groupId)->get();

        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $file = new File();

        $file->fill($request->validated());

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');

            $destinationPath = public_path('uploads');

            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();

            $uploadedFile->move($destinationPath, $fileName);

            $file->path = $destinationPath . '/' . $fileName;
        }

        $file->save();

        return redirect()->route('files.index')->with('success', 'File created successfully');
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
    public function edit(File $file)
    {
        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {

        $file->update($request->validated());

        return redirect()->route('files.index')->with('success', 'File updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully');
    }
}
