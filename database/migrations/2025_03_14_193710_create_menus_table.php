<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('ingredients');
            $table->integer('price');
            $table->string('size');
            $table->string('type');
            $table->timestamps();
        });
        
        DB::table('menus')->insert([
    [
        'name' => 'Hawajska',
        'description' => 'Egzotyczna mieszanka szynki i ananasa na klasycznym cieście.',
        'ingredients' => 'Mozzarella, Cheddar, Szynka, Ananas, Sos pomidorowy',
        'price' => 31,
        'size' => 'Średnia',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Formaggio Quattro',
        'description' => 'Cztery wyśmienite sery dla prawdziwych seromaniaków.',
        'ingredients' => 'Mozzarella, Gorgonzola, Parmezan, Ricotta, Sos śmietanowy',
        'price' => 40,
        'size' => 'Duża',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Vegano Verde',
        'description' => 'Zielona wegańska rozkosz z warzywami i pesto.',
        'ingredients' => 'Cukinia, Bakłażan, Papryka, Wegański ser, Rukola, Pesto',
        'price' => 36,
        'size' => 'Średnia',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Spicy Diablo',
        'description' => 'Dla odważnych – pikantna uczta z kiełbasą i chili.',
        'ingredients' => 'Kiełbasa, Ostro papryczki, Mozzarella, Sos pomidorowy',
        'price' => 32,
        'size' => 'Średnia',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Di Mare',
        'description' => 'Pizza inspirowana smakami morza i świeżością owoców morza.',
        'ingredients' => 'Krewetki, Kalmary, Czarne oliwki, Czosnek, Mozzarella, Sos pomidorowy',
        'price' => 44,
        'size' => 'Średnia',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Cztery Sery',
        'description' => 'Bogactwo serów z nutą klasyki.',
        'ingredients' => 'Mozzarella, Cheddar, Parmezan, Ricotta, Sos pomidorowy',
        'price' => 38,
        'size' => 'Mała',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Kurczak Buffalo',
        'description' => 'Pikantna pizza z kurczakiem buffalo i łagodnym sosem ranch.',
        'ingredients' => 'Kurczak, Sos buffalo, Mozzarella, Sos ranch',
        'price' => 35,
        'size' => 'Duża',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Margarita Classico',
        'description' => 'Prosta klasyka z sosem pomidorowym i świeżą bazylią.',
        'ingredients' => 'Sos pomidorowy, Mozzarella, Świeża bazylia',
        'price' => 28,
        'size' => 'Mała',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Pizza Warzywna',
        'description' => 'Kolorowa, lekka i pełna warzyw dla wegetarian.',
        'ingredients' => 'Papryka, Cebula, Pieczarki, Mozzarella, Sos pomidorowy',
        'price' => 30,
        'size' => 'Średnia',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Spinaci Freschi',
        'description' => 'Lekka pizza z młodym szpinakiem i fetą.',
        'ingredients' => 'Szpinak, Feta, Czosnek, Mozzarella, Oliwa, Sos śmietanowy',
        'price' => 33,
        'size' => 'Mała',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Pomodoro Fresco',
        'description' => 'Soczyste pomidory i świeże zioła na cienkim cieście.',
        'ingredients' => 'Pomidory cherry, Mozzarella, Bazylia, Oliwa, Sos pomidorowy',
        'price' => 30,
        'size' => 'Mała',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Inferno di Napoli',
        'description' => 'Piekielna mieszanka ostrego salami i jalapeño.',
        'ingredients' => 'Salami pikantne, Mozzarella, Jalapeño, Sos pomidorowy, Bazylia, Sos chili',
        'price' => 36,
        'size' => 'Średnia',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Wegańska Rozkosz',
        'description' => 'Roślinna propozycja z kurczakiem roślinnym i kremowym sosem.',
        'ingredients' => 'Roślinny kurczak, Sos alfredo, Mozzarella roślinna',
        'price' => 42,
        'size' => 'Mała',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Ziołowy Raj',
        'description' => 'Zielona pizza z pesto i świeżymi ziołami.',
        'ingredients' => 'Pesto, Oliwki, Pomidory, Mozzarella',
        'price' => 32,
        'size' => 'Mała',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Wolina',
        'description' => 'Legendarna pizza inspirowana smakiem wyspy Wolin.',
        'ingredients' => 'Dojrzewająca szynka, Ser burrata, Rukola, Pomidory konfitowane, Czosnek niedźwiedzi, Sos śmietanowy',
        'price' => 52,
        'size' => 'Duża',
        'type' => 'pizza',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Zapiexy Klasyk',
        'description' => 'Tradycyjna zapiekanka jak za dawnych lat.',
        'ingredients' => 'Bagietka, Pieczarki, Ser żółty, Ketchup, Szczypiorek',
        'price' => 15,
        'size' => 'Mała',
        'type' => 'zapiekanka',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Mięsny Jeż',
        'description' => 'Mięsna uczta w formie zapiekanki.',
        'ingredients' => 'Bagietka, Mięso mielone, Cebula, Ser, Sos BBQ',
        'price' => 18,
        'size' => 'Duża',
        'type' => 'zapiekanka',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Wegański Power',
        'description' => 'Zapiekanka dla roślinożerców – lekko i smacznie.',
        'ingredients' => 'Bagietka, Tofu, Cukinia, Papryka, Wegański ser, Pesto',
        'price' => 19,
        'size' => 'Średnia',
        'type' => 'zapiekanka',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Carbonara Classica',
        'description' => 'Włoska klasyka z boczkiem i parmezanem.',
        'ingredients' => 'Makaron spaghetti, Boczek, Jajko, Parmezan, Pieprz',
        'price' => 32,
        'size' => 'Średnia',
        'type' => 'makaron',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Bolognese Rustico',
        'description' => 'Domowy makaron z mięsnym sosem pomidorowym.',
        'ingredients' => 'Makaron tagliatelle, Mielona wołowina, Sos pomidorowy, Cebula, Czosnek',
        'price' => 34,
        'size' => 'Duża',
        'type' => 'makaron',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Spinaci e Ricotta',
        'description' => 'Makaron z delikatną ricottą i świeżym szpinakiem.',
        'ingredients' => 'Makaron ravioli, Ricotta, Szpinak, Masło, Parmezan',
        'price' => 36,
        'size' => 'Mała',
        'type' => 'makaron',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
