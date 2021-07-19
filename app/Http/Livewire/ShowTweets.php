<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;

    public $content = 'Olá Bem Vindo!';

    protected $rules = [
        'content' => 'required|min:3|max:200'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('livewire.show-tweets', compact('tweets'));
    }

    public function create()
    {
        $this->validate();

        auth()->user()->tweets()->create([
            'content' => $this->content,
        ]);

        /* Tweet::create([
            'content' => $this->content,
            'user_id' => 1,
        ]); */

        $this->content = '';
    }
}
