<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public function readFilms()
    {
        // Leer películas de la base de datos utilizando Query Builder
    
        $filmsFromDB = DB::table('films')->get()->toArray();
    
        // Leer películas del archivo JSON
        
        $filmsFromJson = json_decode(Storage::get('public/films.json'), true) ?? []; //lo utilizo para proporcionar un valor predeterminado en caso de que el valor a la izquierda sea null esto asegura que $filmsFromJson sea siempre un array 
    
        // Combinar los resultados del archivo JSON y la base de datos
        $allFilms = array_merge($filmsFromJson, $filmsFromDB);
    
        // Devolver los resultados combinados
        return $allFilms;
    }
    
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Lista TODAS las películas filtra x año.
     */
    public function listFilmsByYear($year = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis por año";
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year informed
        foreach ($films as $film) {
            if ($film['year'] == $year){
                $films_filtered[] = $film;            
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

     /**
     * Lista TODAS las películas filtra x categoria.
     */
    public function listFilmsByGenre($genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis por categoria";
        $films = FilmController::readFilms();

        //if genre is null
        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on genre informed
        foreach ($films as $film) {
            if ($film['genre'] == $genre){
                $films_filtered[] = $film;            
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Cuenta todas las peliculas
     */
    public function countFilms()
    {
        $title = "Contador de peliculas";
        $films = FilmController::readFilms();
        $counter =  count($films);

        return view('films.count', ["counter" => $counter, "title" => $title]);
        
    }

    /**
     * Lista todas las peliculas ordenadas de mas reciente a mas antigua
     */
    public function sortFilms()
    {
        $title = "Lista peliculas ordenadas por año descendiente";
        $films = FilmController::readFilms();
        // order by year descending
        usort($films, function ($a, $b) {return $a['year'] < $b['year'];});

        return view("films.list", ["films" => $films, "title" => $title]);        
    }
    /**
     * Añade una nueva pelicula
     */
    public function createFilm(Request $request)
    {
        // Flag para decidir dónde guardar los datos
        $saveToDB = $request->input('save_to_db', false);
    
        $newFilm = [
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'genre' => $request->input('genre'),
            'country' => $request->input('country'),
            'duration' => $request->input('duration'),
            'img_url' => $request->input('img_url')
        ];
    
        if(!FilmController::isFilm($newFilm['name'])){
            if($saveToDB) {
                // Opción para guardar en la base de datos
                DB::table('films')->insert($newFilm);
            } else {
                // Opción para guardar en el archivo JSON
                $films = FilmController::readFilms(); 
                $films[] = $newFilm; //nuevo film y guardo el array con la nueva pelicula
                $status = Storage::put('public/films.json', json_encode($films)); 
                if (!$status) {
                    return view("welcome", ["status" => "Error al añadir pelicula"]);
                }
            }
            // Redirigir a la lista de películas después de la inserción exitosa
            return redirect()->action('App\Http\Controllers\FilmController@listFilms');
        } else {
            // Manejar el caso en que la película ya existe
            return view("welcome", ["status" => "Error, pelicula ya existe"]);
        }
    }
    
    /**
     * Ver si film ya existe
     */
    public function isFilm($name): bool
    {
        $films = FilmController::readFilms();

        $isInArray = in_array($name, array_column($films, 'name'));
        
        return $isInArray;
    }
}
