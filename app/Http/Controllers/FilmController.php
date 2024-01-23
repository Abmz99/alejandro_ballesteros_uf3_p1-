<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    /**
     * Read films from storage.
     */
    public function readFilms(): array {
        $json = Storage::disk('local')->get('public/films.json');
        return json_decode($json, true);
    }

    /**
     * Show the form for creating a new film.
     */
    public function showCreateForm()
    {
        return view('create');
       
    }

    /**
     * Store a newly created film in storage.
     */
    public function createFilm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'year' => 'required|numeric',
            'genre' => 'required',
            'country' => 'required',
            'duration' => 'required|numeric',
            'url_image' => 'required|url'
        ]);

        // Verifica si la película ya existe antes de crearla
        if ($this->isFilm($validatedData['name'])) {
            return redirect('/')->with('error', 'La película ya existe.');
        }

        // Si la película no existe, crea una nueva
        $films = $this->readFilms();
        $films[] = $validatedData;

        // Guarda el array actualizado de películas de vuelta en el archivo JSON
        Storage::disk('local')->put('public/films.json', json_encode($films, JSON_PRETTY_PRINT));

        return redirect('/')->with('success', 'Película creada correctamente.');

    }

    /**
     * Check if a film with the given name exists.
     */
    private function isFilm($name)
    {
        $films = $this->readFilms();
        foreach ($films as $film) {
            if ($film['name'] === $name) {
                return true;
            }
        }
        return false;
    }
    public function listOldFilms($year = 2000)
    {
        $films = $this->readFilms();
        $oldFilms = array_filter($films, function ($film) use ($year) {
            return $film['year'] < $year;
        });

        return view('films.list', [
            'films' => $oldFilms,
            'title' => "Películas antiguas (antes de $year)"
        ]);
    }

    /**
     * List films younger than input year.
     */
  public function listNewFilms($year = 2000)
{
    $films = $this->readFilms();
    $newFilms = array_values(array_filter($films, function ($film) use ($year) {
        return $film['year'] >= $year;
    }));

    return view('films.list', [
        'films' => $newFilms,
        'title' => "Películas nuevas (después de $year)"
    ]);
}

    /**
     * List films by a given year.
     */
    public function listFilmsByYear($year)
    {
        $films = $this->readFilms();
        $filmsByYear = array_filter($films, function ($film) use ($year) {
            return $film['year'] == $year;
        });

        return view('films.list', [
            'films' => $filmsByYear,
            'title' => "Películas del año $year"
        ]);
    }

    /**
     * List films by a given genre.
     */
    public function listFilmsByGenre($genre)
    {
        $films = $this->readFilms();
        $filmsByGenre = array_filter($films, function ($film) use ($genre) {
            return strtolower($film['genre']) == strtolower($genre);
        });

        return view('films.list', [
            'films' => $filmsByGenre,
            'title' => "Películas de género $genre"
        ]);
    }

    /**
     * List all films, or filter by year or genre.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films = $this->readFilms();
        $filteredFilms = $films;

        if ($year !== null) {
            $filteredFilms = array_filter($filteredFilms, function ($film) use ($year) {
                return $film['year'] == $year;
            });
        }

        if ($genre !== null) {
            $filteredFilms = array_filter($filteredFilms, function ($film) use ($genre) {
                return strtolower($film['genre']) == strtolower($genre);
            });
        }

        return view('films.list', [
            'films' => $filteredFilms,
            'title' => "Listado de Películas" . ($year ? " del año $year" : '') . ($genre ? " de género $genre" : '')
        ]);
    }
}
