<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documento>
 */
class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

         
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'resumen' => $this->faker->text(200),
            'autor' => $this->faker->name(),
            'formato' => 'pdf',
            'idioma' => 'ES',
            'url' => 'pdfs/default.pdf',
            'fecha' => $this->faker->date(),
            'user_id' => '1',
            'departamento_id' => $this->faker->randomElement(['1','2','3','4']),
            'categoria_id' => $this->faker->randomElement(['1','2','3','4']),
        ];
    }
}
