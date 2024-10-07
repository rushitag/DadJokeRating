<?php

namespace App\Console\Commands;

use App\Models\Joke;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class importJokes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-jokes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        for($i=0;$i<15;$i++){
            $joke = Http::acceptJson()->get('https://icanhazdadjoke.com/')->json();
            $data = new Joke();
            $data->joke_id = $joke['id'];
            $data->joke = $joke['joke'];
            $data->average_rate = 0;
            $data->total_rates = 0;
            $data->save();
        }
    }
}
