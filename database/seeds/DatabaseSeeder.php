<?php

use App\Models\Task;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = factory(User::class)->create();
        $tasks = [
            [
                'user_id' => $user->id,
                'name' => 'Agregar subtareas al kanban',
                'stage' => Task::STAGE_BUFFER,
                'estimation_at' => now()->addDay(7)->toDateString()
            ],
            [
                'user_id' => $user->id,
                'name' => 'Testing Kanban',
                'stage' => Task::STAGE_WORKING,
                'estimation_at' => now()->addDay(7)->toDateString()
            ]
        ];
        $user->tasks()->insert($tasks);
    }
}
