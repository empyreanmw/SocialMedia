<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateWorld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates 50 users, posts and replies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        factory('App\Post', 50)->create()->each(function($post){
            factory('App\Replies',  5)->create(['replied_id' => $post->id]);
        });
    }
}
