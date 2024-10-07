<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    // get joke
    public function joke()
    {
        return $this->belongsTo(Joke::class);
    }

    // save rate
    public function saveRate($request){
        $rate = (new Rate());
        $rate->joke_id = $request->id;
        $rate->rate = $request->rate;
        $rate->save();
    }
}
