<?php

namespace App\Http\Middleware;

use Closure;

class ValidateUrl
{
    public function handle($request, Closure $next)
    {
        $url = $request->input('url_image');

        
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            // Si la URL no es válida, redirige al usuario de vuelta con un error.
            return redirect('welcome')->withErrors(['url_image' => 'La URL de la imagen no es válida.']);
        }

        // Si la URL es válida, continua con la solicitud.
        return $next($request);
    }
}
