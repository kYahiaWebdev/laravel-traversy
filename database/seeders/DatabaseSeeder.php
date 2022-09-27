<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\TagsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'yahia',
            'email' => 'yahia@gmail.com',
            'password' => bcrypt('123456')
        ]);
        
        
        $web = Category::factory()->create([ 'name' => 'Web Dev' ]);
        $infra = Category::factory()->create([ 'name' => 'Infrastructure' ]);
        $iot = Category::factory()->create([ 'name' => 'IOT' ]);
        $train = Category::factory()->create([ 'name' => 'Training' ]);
        
        Listing::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $web->id
        ]);
        Listing::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $infra->id
        ]);
        Listing::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $iot->id
        ]);
        Listing::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $train->id
        ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developper',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email@email.com',
        //     'website'=> 'https://www.acmes.com',
        //     'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum aliquid repellat facere 
        //     magni veniam atque laborum sed ex temporibus ea fugit itaque, ratione nobis asperiores debitis ad natus 
        //     optio. Consequatur.'
        // ]);

        // Listing::create([
        //     'title' => 'Laravel Junior Developper',
        //     'tags' => 'laravel, backend, api',
        //     'company' => 'Starck Industries',
        //     'location' => 'New York, NY',
        //     'email' => 'mail@mail.com',
        //     'website'=> 'https://www.starckindustries.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint perspiciatis temporibus 
        //     possimus unde eum tempora ipsam quis eos officiis sapiente. Veniam maiores tempora debitis error.'
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            TagsSeeder::class
        ]);
    }
}
