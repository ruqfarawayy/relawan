<?php

namespace App\Http\Controllers;

use App\Models\FileEncryption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;
use SoareCostin\FileVault\Facades\FileVault;

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
            $filename = Storage::putFile('assets/encrypted', $request->file('document'));

            if ($filename) {
                FileVault::encrypt($filename);
            }
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_path'] = $filename;
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
    $data = FileEncryption::findOrFail($id);
    $validatedPassword = $request->validate([
        'encryption_key' => 'required|min:6',
    ]);
    $filename = $data->file_name;
    $filePath = $data->file_path;
    $isFileExist = Storage::has($filePath . '.enc');
    // Decrypt the encryption key
    $decryptedEncryptionKey = Crypt::decryptString($data->encryption_key);
    $isPasswordCorrect = $validatedPassword['encryption_key'] === $decryptedEncryptionKey;
    // If the password is correct, download the decrypted file
    if(!$isPasswordCorrect && $isFileExist){
        return redirect()->route('file_encryption.index')->with('error', 'Password salah');
    }
        return response()->streamDownload(function () use ($filePath) {
            FileVault::streamDecrypt($filePath . '.enc');
        }, $filename);
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
