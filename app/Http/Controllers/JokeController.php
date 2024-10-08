<?php

namespace App\Http\Controllers;

use App\Models\Joke;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JokeController extends Controller
{
    // fetch joke from api
    public function setJoke()
    {
        $joke = Http::acceptJson()->get('https://icanhazdadjoke.com/')->json();

        // save on database
        (new Joke())->saveJoke($joke);


        return response('successfully');
    }
    // get jokes
    public function getJoke()
    {

        //get filter rate
        $data = (new Joke)->getRate();

        // Best and worst jokes set first
        $best_joke = $data->first();
        $worst_joke = $data->last();

        return view('jokes/list', compact('data', 'best_joke', 'worst_joke'));
    }
    // save joke rate
    public function saveJokeRate(Request $request)
    {
        // validation
        $request->validate([
            'id' => 'required|numeric',
            'rate' => 'required|numeric|min:1|max:5'
        ]);

        // save rate
        (new Rate())->saveRate($request);

        // find joke by id
        $joke = Joke::with('rates')->find($request->id);

        // save average
        $joke->average_rate = (new Joke())->calculateAverage($joke->rates);
        $joke->total_rates = $joke->rates()->count();
        $joke->save();

        // redirect
        return redirect()->route('get.joke');
    }
}
