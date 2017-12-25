<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Category;
class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Item::truncate();
        Category::truncate();
        
        $faker = \Faker\Factory::create();

        // $table->increments('id');
        // $table->string('name');
        // $table->boolean('home');
        // $table->boolean('hasChild');
        // $table->string('iconUrl');
        // $table->integer('parent');

        Category::create([
            'name'=>'Elektronik',
            'home' => false,
            'hasChild' => true,
            'iconUrl' => 'https://firebasestorage.googleapis.com/v0/b/event-98569.appspot.com/o/kategory%2Ficon_elektronik.png?alt=media&token=d8fc0b2c-e5b4-42f5-8c6c-6dc6e49d2629',
            'parent' => 0,
        ]);

        Category::create([
            'name'=>'Handphone Tablet',
            'home' => true,
            'hasChild' => false,
            'iconUrl' => 'https://firebasestorage.googleapis.com/v0/b/event-98569.appspot.com/o/kategory%2Ficon_hp.png?alt=media&token=4eddfa71-dcd9-43df-a7ea-09dd4559463c',
            'parent' => 1,
        ]);

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Item::create([
                'name'=>$faker->name,
                'body' => $faker->paragraph,
                'price' => $faker->randomNumber(5),
                'profilePics' => json_encode(['https://firebasestorage.googleapis.com/v0/b/event-98569.appspot.com/o/images%2F1512319444.jpg?alt=media&token=d636aeb4-1953-4256-9f82-ee5b920c7a33']),
                'category_id' => $i < 5 ? 2 : 3,
                'user_id' => $faker->numberBetween(1,10)
            ]);
        }
    }
}
