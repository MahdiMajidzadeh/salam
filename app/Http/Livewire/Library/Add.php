<?php

namespace App\Http\Livewire\Library;

use App\Services\BookCrawler;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $isbn;
    public $book;
    public $cover;

    public function search()
    {
        $crawler = new BookCrawler($this->isbn);

        if ($crawler->crawl() === false) {
            session()->flash('error', 'یافت نشد');
            return;
        }

        $this->book = $crawler->book();
        $this->book['authors_line'] = implode('|', $this->book['authors']);
    }

    public function render()
    {
        return view('livewire.library.add');
    }
}
