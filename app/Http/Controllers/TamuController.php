<?php


namespace App\Http\Controllers;

use App\Models\akun_tujuan;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamus = Tamu::all();
        return view('form.index', compact('tamus'));

    }
    public function index2()
    {
        
        $akunTujuans = akun_tujuan::all();

        // Pass data to the view
        return view('form.form', compact('akunTujuans'));
    }

    public function create()
    {
        return view('form.form');
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_tamu' => 'required|string',
            'jenis_kelamin' => 'required|in:male,female',
            'nohp' => 'required|string',
            'asal' => 'required|string',
            'tujuan' => 'required|string',
            'keterangan' => 'required|string',
            'gambar' => 'required|string', // Assuming 'gambar' is the name of the field for storing image data
            
            
        ]);
        $img = $request->gambar;
$folderPath = "uploads/";

$image_parts = explode(";base64,", $img);

// Check if the key exists before accessing it
if (isset($image_parts[0])) {
    $image_type_aux = explode("gambar/", $image_parts[0]);

    // Check if the key exists before accessing it
    if (isset($image_type_aux[1])) {
        $image_type = $image_type_aux[1];
    } else {
        // Handle the case where the key doesn't exist
        // You might want to set a default value or throw an exception
        $image_type = 'default_image_type';
    }
} else {
    // Handle the case where the key doesn't exist
    // You might want to set a default value or throw an exception
    $image_type = 'default_image_type';
}

$image_base64 = base64_decode($image_parts[1]);
$fileName = uniqid() . '.png';

$file = $folderPath . $fileName;
Storage::put($file, $image_base64);

// Now, you can create the Tamu record after processing the image
Tamu::create(array_merge($validatedData, ['gambar' => $fileName]));

return redirect()->route('tamu.index')->with('success', 'Record created successfully');
    }

    public function show($id)
    {
        $tamu = Tamu::find($id);
        return view('tamus.show', compact('tamu'));
    }

    public function edit($id)
    {
        $tamu = Tamu::find($id);
        return view('tamus.edit', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // Tambahkan validasi sesuai kebutuhan
        ]);

        Tamu::find($id)->update($request->all());

        return redirect()->route('tamu.index')->with('success', 'Tamu berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tamu = Tamu::findOrFail($id);

        // Delete the Tamu record
        $tamu->delete();

        // Redirect back with a success message
        return redirect()->route('dasboard.ondex')->with('success', 'Tamu deleted successfully');
    }
    }



