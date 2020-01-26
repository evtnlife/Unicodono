<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('endereco')->insert([
            'rua' => "Moacir jose de oliveira souza",
            'numero' => 30,
            'complemento' => 'casa',
            'bairro' => 'Santo Agostinho',
            'cidade_id' => 10
        ]);
        DB::table('plano')->insert([
            'nome' => 'Plano Iniciante',
            'duracao' => 30,
            'valor' => 49.99,
        ]);
        DB::table('users')->insert([
            'name' => 'teste',
            'email' => 'teste@gmail.com',
            'password' => bcrypt('teste'),
            'endereco_id' => 1,
            'plano_id' => 1,
            'documento' => '32333333333',
            'doc_tipo' => 0
        ]);
    }
}
