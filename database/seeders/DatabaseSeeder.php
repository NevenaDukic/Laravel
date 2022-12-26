<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Theatre;
use App\Models\Performance;
use App\Models\Ticket;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theatre::truncate();

       

        $th = Theatre::factory()->create(["name"=>"Atelje 212"]);
        $u = User::factory()->create();
        $p = Performance::factory()->create([
            'theatre_id' => $th->id,
        ]);


        Ticket::factory(2)->create([
            'user_id' => $u->id,
            'performance_id'  =>$p->id,
        ]);


        $u1 = User::factory()->create();
        Ticket::factory(2)->create([
            'user_id' => $u1->id,
            'performance_id'  =>$p->id,
        ]);
        














         //User::factory(1)->create();

        // $theatre = Theatre::create(['name'=>'Atelje 212']);

        // $performance1 = Performance::create(['name' =>'Greatest Showman','genre'=>'Musical','number_of_roles'=>50,'theatre_id' =>1]);
        // $performance2= Performance::create(['name' =>'Mamma mia','genre'=>'Musical','number_of_roles'=>20,'theatre_id' =>1]);
        // $performance3 = Performance::create(['name' =>'Jadnici','genre'=>'Drama','number_of_roles'=>30,'theatre_id' =>1]);

        // $ticket1 = Ticket::create(['user_id'=>1,'theatrical_performance_id' => $performance1->id]);
        // $ticket2 = Ticket::create(['user_id'=>2,'theatrical_performance_id' => $performance2->id]);
        // $ticket3 = Ticket::create(['user_id'=>2,'theatrical_performance_id' => $performance3->id]);

    }
}
