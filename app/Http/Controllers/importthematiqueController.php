<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class importthematiqueController extends Controller
{
   
    public function import(Request $request)
    {
        if (!$request->hasFile('file')) {
            return back()->with('error', 'Aucun fichier n\'a été téléchargé.');
        }
    
        $file = $request->file('file');
    
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, ['csv', 'xls', 'xlsx'])) {
            return back()->with('error', 'Format de fichier non valide.');
        }
    
        $path = $file->getRealPath();
        $data = [];
    
        if (($handle = fopen($path, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
    
        foreach ($data as $key => $row) {
          
            if ($key === 0) {
                continue;
            }
                \DB::table('thematiques')->insert([
                    'thematique' => $row[0] ?? null,
                    'image'      => $row[1] ?? null,
                    'type'       => $row[2] ?? null,
                    'theme'      => $row[6] ?? null,
                ]);
        }
        return back()->with('success', 'Fichier importé avec succès.');
    }
    
}
