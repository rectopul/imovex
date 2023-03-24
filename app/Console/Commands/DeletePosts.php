<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Console\Command;

class DeletePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove todos os posts do banco de dados';

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
     * @return int
     */
    public function handle()
    {

        $posts = Post::all();

        foreach($posts as $post) {
            PostService::delete($post);
        }

        $this->info('Todos os posts foram removidos do banco de dados');
    }
}
