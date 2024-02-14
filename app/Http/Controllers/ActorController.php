<?php
// Dentro de app/Http/Controllers/ActorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function countActors()
    {
        
        $count = DB::table('actors')->count(); 

        // Retornar la vista con el conteo de actores
        return view('actors.count', ['count' => $count]);
    }

    public function listActors()
    {
        $actors = DB::table('actors')->get();

        return view('actors.list', ['actors' => $actors]);
    }

    public function listActorsByDecade(Request $request)
    {
        // Obtiene el valor del año del query string
        $year = $request->query('year');
        
        if ($year) {
            $startYear = $year;
            $endYear = $year + 9;

            // Filtra los actores nacidos entre el año de inicio y fin de la década
            $actors = DB::table('actors')
                        ->whereBetween('birthdate', [$startYear . '-01-01', $endYear . '-12-31'])
                        ->get();
        } else {
            // Si no hay un año proporcionado, simplemente obtiene todos los actores
            $actors = DB::table('actors')->get();
        }

        // Devuelve la vista con los actores obtenidos
        return view('actors.list', ['actors' => $actors]);
    }

    public function deleteActor($id)
    {
        // Intenta eliminar el actor y guarda el resultado de la operación
        $success = DB::table('actors')->where('id', $id)->delete() > 0;

        // Retorna una respuesta JSON con la acción y el estado del resultado
        return response()->json([
            'action' => 'delete',
            'status' => $success
        ]);
    }
}


