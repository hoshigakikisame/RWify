<?php

namespace App\View\Components\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardItem extends Component
{
    public $pengumuman; // Deklarasi properti pengumuman

    /**
     * Create a new component instance.
     *
     * @param  mixed  $pengumuman
     * @return void
     */
    public function __construct($pengumuman)
    {
        $this->pengumuman = $pengumuman; // Inisialisasi properti pengumuman
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.card.card-item');
    }
}
