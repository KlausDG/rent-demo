<?php

use Illuminate\Database\Seeder;

class FilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filials')->insert(array(
            array(
                'title' => 'Loja 1',
                'phone' => '55999999991',
                'rua' => '1',
                'bairro' => '1',
                'numero' => '1',
                'cidade' => '1',
                'uf' => '1',
                'país' => '1',
                'cep' => '1',
                'complemento' => '1',
                'referencia' => '1',
            ),
            array(
                'title' => 'Loja 2',
                'phone' => '55999999992',
                'rua' => '2',
                'bairro' => '2',
                'numero' => '2',
                'cidade' => '2',
                'uf' => '2',
                'país' => '2',
                'cep' => '2',
                'complemento' => '2',
                'referencia' => '2',
            ),
            array(
                'title' => 'Loja 3',
                'phone' => '55999999993',
                'rua' => '3',
                'bairro' => '3',
                'numero' => '3',
                'cidade' => '3',
                'uf' => '3',
                'país' => '3',
                'cep' => '3',
                'complemento' => '3',
                'referencia' => '3',
            ),
            array(
                'title' => 'Loja 4',
                'phone' => '55999999994',
                'rua' => '4',
                'bairro' => '4',
                'numero' => '4',
                'cidade' => '4',
                'uf' => '4',
                'país' => '4',
                'cep' => '4',
                'complemento' => '4',
                'referencia' => '4',
            ),
        ));

        // factory(App\Filial::class, 4)->create();
    }
}
