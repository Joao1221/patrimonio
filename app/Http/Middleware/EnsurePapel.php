<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePapel
{
    private array $hierarquia = [
        'master'  => 3,
        'admin'   => 2,
        'usuario' => 1,
    ];

    public function handle(Request $request, Closure $next, string $papelMinimo): Response
    {
        $user         = $request->user();
        $nivelUsuario = $this->hierarquia[$user->papel->value] ?? 0;
        $nivelExigido = $this->hierarquia[$papelMinimo] ?? 0;

        if ($nivelUsuario < $nivelExigido) {
            return redirect()->route('dashboard')
                ->with('error', 'Você não tem permissão para acessar esta página.');
        }

        return $next($request);
    }
}
