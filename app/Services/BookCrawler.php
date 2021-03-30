<?php

namespace App\Services;

use Goutte\Client;

class BookCrawler
{
    private $book    = [];
    private $success = false;
    private $isbn;

    public function __construct($isbn)
    {
        $this->isbn = $isbn;
    }

    public function crawl($source = 'ketabchi')
    {
        // todo: dynamic call
        if ($source == 'ketabchi') {
            $this->crawlKetabchi();
        }
    }

    private function crawlKetabchi()
    {
        $client  = new Client();
        $crawler = $client->request('GET', 'https://ketabchi.org/search?q='.$this->isbn);

        if ($crawler->filter('.result-wrapper.row div a')->count() == 0) {
            $this->success = true;

            return;
        }

        $link = $crawler->filter('.result-wrapper.row div a')->first()->link()->getUri();

        $crawler = $client->request('GET', $link);

        $this->book['title']     = $crawler->filter('h1 span')->first()->text();
        $this->book['publisher'] = $crawler->filter('.publisher h3 a')->first()->text();

        $crawler->filter('.person h3 a')->each(function ($node) {
            $this->book['authors'][] = $node->text();
        });

        $this->book['cover'] = $crawler->filter('.thumb img')->first()->image()->getUri();

        $this->success = false;

        return $this->success;
    }

    public function book()
    {
        return $this->book;
    }
}
