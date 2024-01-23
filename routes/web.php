    <?php

    use App\Http\Controllers\FilmController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/films/createForm', [FilmController::class, 'showCreateForm'])->name('showCreateForm');
    Route::post('/films/createFilm', [FilmController::class, 'createFilm'])->name('createFilm');

    Route::prefix('filmout')->group(function () {
        Route::get('oldFilms/{year?}', [FilmController::class, 'listOldFilms'])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, 'listNewFilms'])->name('newFilms');
        Route::get('films/{year?}/{genre?}', [FilmController::class, 'listFilms'])->name('listFilms');
    });
