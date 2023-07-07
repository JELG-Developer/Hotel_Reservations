<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement(['Premium', 'Reuniones y conferencias', 'Viajeros', 'Relax y bien estar', 'Viaje Familiar']);
        $category_id = $this->getCategoryId($name);
       // $image_id = $this->setImageId($name);

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(2),
            'price' => $this->getPriceByCategory($name),
            'number' => $this->faker->numberBetween(100, 999),
            'status' => $this->faker->randomElement(['disponible']),
            'ubication' => $this->faker->paragraph(2),
            'category_id' => $category_id,

        ];
    }

    private function getCategoryId($name)
    {
        switch ($name) {
            case 'Viaje Familiar':
                return 5;
            case 'Premium':
                return 4;
            case 'Reuniones y conferencias':
                return 3;
            case 'Viajeros':
                return 2;
            case 'Relax y bien estar':
                return 1;
            default:
                return null;
        }
    }

    private function getPriceByCategory($name)
    {
        switch ($name) {
            case 'Viaje Familiar':
                return 280;
            case 'Premium':
                return 300;
            case 'Reuniones y conferencias':
                return 250;
            case 'Viajeros':
                return 200;
            case 'Relax y bien estar':
                return 150;
            default:
                return null;
        }
    }

}

