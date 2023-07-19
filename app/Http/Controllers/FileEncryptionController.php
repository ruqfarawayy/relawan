<?php

namespace App\Http\Controllers;

use App\Models\FileEncryption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;

class FileEncryptionController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        $file_encryption = FileEncryption::all();
        return view('pages.admin.file-encryption.index', [
            'file_encryptions' => $file_encryption
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function create()
    {
        return view('pages.admin.file-encryption.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'document' => 'required',
            'encryption_key' => 'required|min:6',
            'information' => 'required'
        ]);
        if ($request->hasFile('document')) {
            $data = $request->all();
            $data['encryption_key'] = Crypt::encryptString($validatedData['encryption_key']);
            $data['information'] = $validatedData['information'];

            $file = $request->file('document');
            $filePath = $file->store('assets/encrypted', 'public');
            $encryptedFile = Crypt::encryptString(file_get_contents(storage_path('app/public/' . $filePath)));

            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_path'] = $filePath;
            $data['document'] = $encryptedFile;
            $data['status'] = 1;
            FileEncryption::create($data);
            return redirect()->route('file_encryption.index')->with('create', 'Data berhasil ditambahkan');
        } else{
            return redirect()->route('file_encryption.index')->with('create', 'Gagal ditambahkan');
        }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\FileEncryption  $fileEncryption
    //  * @return \Illuminate\Http\Response
    //  */
    public function show(FileEncryption $fileEncryption)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\FileEncryption  $fileEncryption
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {

    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\FileEncryption  $fileEncryption
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, FileEncryption $file_encryption)
{
    $id = $file_encryption->id;
    $data = FileEncryption::findOrfail($id);
    // dd($data);
    $validatedPassword = $request->validate([
        'encryption_key' => 'required|min:6',
    ]);

    try {
        $decryptedEncryptionKey = Crypt::decryptString($data->encryption_key);

        if ($validatedPassword['encryption_key'] !== $decryptedEncryptionKey) {
            return redirect()->route('file_encryption.index')->with('error', 'Password yang Anda masukkan salah');
        }
        $encryptedContents = Storage::disk('public')->get($data->file_path);
        // dd($encryptedContents);
        $decryptedContents = Crypt::decryptString($encryptedContents);
        dd($decryptedContents);
        $tempFilePath = 'storage/' . $data->file_name;
        Storage::disk('public')->put($tempFilePath, $decryptedContents);

        $decryptedFilePath = Storage::disk('public')->path($tempFilePath);

        $headers = [
            'Content-Type' => Storage::disk('public/assets/encrypted')->mimeType($data->file_path),
        ];

        return response()->download($decryptedFilePath, $data->file_name, $headers)->deleteFileAfterSend(true);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return redirect()->route('file_encryption.index')->with('error', 'Gagal mendekripsi file. Pastikan password yang Anda masukkan benar.');
    }
}


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\FileEncryption  $fileEncryption
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        FileEncryption::findOrFail($id)->delete();
        return redirect()->route('file_encryption.index')->with('delete', 'Data berhasil dihapus');
    }

}
