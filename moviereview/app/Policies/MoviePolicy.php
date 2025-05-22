<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;

class MoviePolicy
{
    public function create(User $user): bool
    {
        return true; // Qualquer usuário logado pode criar filmes
    }

    public function update(User $user, Movie $movie): bool
    {
        return true; // Para simplificar, qualquer usuário pode editar
    }

    public function delete(User $user, Movie $movie): bool
    {
        return true; // Para simplificar, qualquer usuário pode deletar
    }
}