<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Role;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    function index(){
        $documents = Document::orderBy('created_at', 'DESC')->get(); 
        return view('home', compact('documents'));   
    }

    function getDocument(Request $request, $id){
        $documents = Document::orderBy('created_at', 'DESC')->get(); 
        $jobs = Job::where('doc_id', $id)->get();
        return view('home', compact('jobs', 'documents'));
    }

    // Funtion add file 
    public static function getAndStoreFileSingle($files){
        $fileNameSave='';
        $fileName=pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'_'.'.'.$files->getClientOriginalExtension();
        $fileNameSave.=str_replace(' ','',$fileName);
        $fileName=str_replace(' ','',$fileName);
        $path = $files->storeAs('public/documents', $fileName);
        return $fileNameSave;
    }

    function addDocumentForRole($request, $userId){
        $role = new Role;
        $role->user_id = $userId;
        $role->doc_id = Document::all()->last()->id;
        $role->sharer_code = $userId;
        
        $role->save();
    }

    function addDocument(Request $request){
        $userId =  Auth::user()->id;
        $document = new Document;
            $document->user_id = $userId;
            $document->doc_symbol = $request->doc_symbol;
            $document->doc_abstract = $request->doc_abstract;

            $fileValidated =  $request->validate([
                'doc_file' => 'mimes:pdf,doc,docx',
            ]);
            if ($request->hasFile('doc_file')) {
                $document->doc_file = $this->getAndStoreFileSingle($request->file('doc_file'));
            }
            $document->save();

            $this->addDocumentForRole($request, $userId);
        return redirect('home');
    }

    function deleteDocument($id){
        $job = Job::where('doc_id', $id)->delete();
        $role = Role::where('user_id', Auth::user()->id)->where('doc_id', $id)->delete();

        $document = Document::find($id);
        $document->delete();

        // Delete file in storage/app/public/document
        $file_name = $document->doc_file;
        if (file_exists(storage_path('app/public/documents/'.$file_name))) {
            $file_path = storage_path('app/public/documents/'.$file_name);
            unlink($file_path);
        }

        return redirect('home');
    }

    
}