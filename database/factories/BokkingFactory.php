<?php

namespace Database\Factories;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Paymenth;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

class BokkingFactory extends Factory
{
    public function definition(): array
    {     
        $entrada = fake()->dateTimeBetween('now', '+1 year');
        $salida = fake()->dateTimeBetween($entrada, $entrada->format('Y-m-d') . ' +7 days');
        
        $tipos = [
            1 => ['Reuniones y conferencias', 'Relax y bien estar', 'Premium'],
            2 => ['Viajeros', 'Premium'],
            3 => ['Viaje Familiar', 'Premium'],
            4 => ['Suite', 'Dobles']
        ];

        do {
            $amount = fake()->numberBetween(1, 4);
            $tipo = $tipos[$amount][array_rand($tipos[$amount])];
            $paquete = Room::where('name', $tipo)->where('status', 'disponible')->inRandomOrder()->first();
        } while (!$paquete);
    
        $entrada = Carbon::parse($entrada);
        $salida = Carbon::parse($salida);        
        $diferenciaEnDias = $entrada->diffInDays($salida);
    
        $costo = $paquete->price;
        $total = $costo * ($diferenciaEnDias + 1);
        
        // Verifica que el total no sea 0 por el metodo de dias 
        if ($total === 0) {
            return $this->definition(); // Regenera las fechas y devuelve dias mayor a 1
        }

        // Cambia el estado de la habitación a "ocupada"
        $paquete->update(['status' => 'ocupada']);
        
        return [
            'entry' => $entrada,
            'departure' => $salida,
            'user_id' => User::all()->random()->id,
            'room_id' => $paquete->id,
            'amount' => $amount,
            'costo' => $total,
            'paymenth_id' => Paymenth::all()->random()->id,
        ];
    }
}