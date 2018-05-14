<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use App\Events\ScoreUpdated;

class CardController extends Controller
{
    public function show(Card $card) {
    	$user = auth()->user();
    	$user->score = $user->score + $card->value;
    	$user->save();

    	event(new ScoreUpdated($user)); //broadcast 'scoreupdate' event

    	return redirect()->back()->withValue($card->value);
    }
}
