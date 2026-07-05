<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::insert([
            [
                'name' => 'Bronze',
                'description' => '
                    <ul>
                        <li>Lavagem externa simples</li>
                        <li>Enxágue com água pressurizada</li>
                        <li>Aplicação de shampoo automotivo</li>
                        <li>Remoção de sujeira superficial</li>
                        <li>Secagem manual</li>
                        <li>Limpeza básica de rodas</li>
                        <li>Finalização externa rápida</li>
                    </ul>
                ',
            ],
            [
                'name' => 'Prata',
                'description' => '
                    <ul>
                        <li>Lavagem externa completa</li>
                        <li>Lavagem interna básica</li>
                        <li>Aspiração de bancos e carpetes</li>
                        <li>Limpeza de painel e portas</li>
                        <li>Limpeza de rodas e pneus</li>
                        <li>Secagem manual</li>
                        <li>Finalização geral</li>
                    </ul>
                ',
            ],
            [
                'name' => 'Ouro',
                'description' => '
                    <ul>
                        <li>Lavagem externa detalhada</li>
                        <li>Lavagem interna completa</li>
                        <li>Aspiração profunda de bancos e carpetes</li>
                        <li>Limpeza detalhada de painel, portas e console</li>
                        <li>Hidratação de plásticos internos</li>
                        <li>Limpeza completa de rodas e pneus</li>
                        <li>Finalização premium</li>
                    </ul>
                ',
            ],
            [
                'name' => 'Limpeza Interna Detalhada',
                'description' => '
                    <ul>
                        <li>Aspiração completa do interior</li>
                        <li>Limpeza profunda de bancos</li>
                        <li>Higienização de carpetes</li>
                        <li>Limpeza detalhada de painel</li>
                        <li>Limpeza de portas e laterais</li>
                        <li>Eliminação de odores</li>
                        <li>Finalização interna</li>
                    </ul>
                ',
            ],
            [
                'name' => 'Polimento de Faróis',
                'description' => '
                    <ul>
                        <li>Limpeza inicial dos faróis</li>
                        <li>Lixamento técnico controlado</li>
                        <li>Remoção de amarelado</li>
                        <li>Polimento especializado</li>
                        <li>Aplicação de proteção UV</li>
                        <li>Restauração da transparência</li>
                        <li>Finalização e inspeção</li>
                    </ul>
                ',
            ],
        ]);
    }
}
