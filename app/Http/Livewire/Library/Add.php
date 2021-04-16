<?php

namespace App\Http\Livewire\Library;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Services\BookCrawler;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $isbn;
    public $code;
    public $book;
    public $cover;

    public function search()
    {
        $crawler = new BookCrawler($this->isbn);

        if ($crawler->crawl() === false) {
            session()->flash('msg-error', 'یافت نشد');
            return;
        }

        $this->book                 = $crawler->book();
        $this->book['authors_line'] = implode('|', $this->book['authors']);
    }

    public function render()
    {
        return view('livewire.library.add');
    }

    public function save()
    {
//        $this->cover->store('photos');
        $book               = new Book();
        $book->code         = $this->code;
        $book->title        = $this->book['title'];
        $book->publisher_id = $this->getPublisher();

        if (is_null($this->cover)) {
            Image::make('https://cdn.ketabchi.org/products/33950/images/ketab-general-book-2i6mp.jpg')
                ->save('book_cover/' . $this->code . '.jpg');
            $book->cover = 'book_cover/' . $this->code . '.jpg';
        }

        $book->save();

        $book->authors()->sync($this->getAuthors());

        return $this->redirect('admin/shelves');
    }

    private function getPublisher()
    {
        $publisher = Publisher::firstOrCreate(
            ['name' => $this->book['publisher']]
        );

        return $publisher->id;
    }

    private function getAuthors()
    {
        $authors = explode('|', $this->book['authors_line']);
        $ids     = [];

        foreach ($authors as $author) {
            $authorModel = Author::firstOrCreate(
                ['name' => $author]
            );

            $ids[] = $authorModel->id;
        }
        
        return $ids;
    }
}
