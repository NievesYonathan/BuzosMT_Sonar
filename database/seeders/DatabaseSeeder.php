<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            TipoDocSeeder::class,
            EstadosSeeder::class,
            CargosSeeder::class,
            UsuariosSeeder::class,
            SeguridadSeeder::class,
            CargosHasUsuariosSeeder::class,
            EtapasSeeder::class,
            ProduccionSeeder::class,
        ]);
    }
}
