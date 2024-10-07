<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joke extends Model
{
    use HasFactory;
    // get rates from rates table
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
    // for save data
    public function saveJoke($joke)
    {
        $data = new Rate();
        $data->joke_id = $joke['id'];
        $data->joke = $joke['joke'];
        $data->average_rate = 0;
        $data->total_rates = 0;
        $data->save();
    }
    public function getRate()
    {
        // get jokes with
        $jokes = Joke::with('rates')->orderBy('average_rate','desc')->get();

        // Calculate average ratings
        foreach ($jokes as $joke) {
            $joke->average_rating = $this->calculateAverage( $joke->rates);
            $joke->rating_count = $joke->rates()->count();
        }
        // Sort jokes by average rating
        $jokes = $jokes->sortByDesc('average_rate');

        return $jokes;
    }

    // validation
    public function calculateAverage($rates)
    {
        // Extract ratings from the collection
        $ratingValues = $rates->pluck('rate')->toArray();

        return count($ratingValues) ? array_sum($ratingValues) / count($ratingValues) : 0;
    }
}
