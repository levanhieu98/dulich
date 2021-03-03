<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{PublishBlog, Blog};
use Carbon\Carbon;

class ScheduleBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'queue blog';

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
        $openPublish = PublishBlog::where('published_at', '<=', Carbon::now('Asia/Ho_Chi_Minh'))->get();
        if ($openPublish->count() > 0) {
            $blogs =  Blog::whereIn('id', $openPublish->pluck('blog_id'))->get();
            foreach ($blogs as $blog) {
                $blog->publish_on =  true;
                $blog->save();
            }
            $openPublish->each->delete();
        }
    }
}
