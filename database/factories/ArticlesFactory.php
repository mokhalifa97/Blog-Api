<?php

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    protected $model=Articles::class;

    public function definition()
    {
        return [
        'author'=>$this->faker->name(),
        'title' =>$this->faker->text(10),
        'category'=>$this->faker->text(5),
        'content'=>$this->faker->text(500),
        'status'=> "Published"
        ];
    }
}
