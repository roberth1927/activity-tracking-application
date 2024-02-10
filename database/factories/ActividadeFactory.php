<?php

namespace Database\Factories;

use App\Models\Actividade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActividadeFactory extends Factory
{
    protected $model = Actividade::class;

    public function definition()
    {
        return [
			'user_id' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
