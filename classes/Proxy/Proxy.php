<?php

class Proxy
{
    private $list = null;

    public function __construct()
    {
        return 'hello';
    }

    public function getListCount()
    {
        if (null === $this->list) {
            $this->makeList();
        }

        return $this->list->getListCount();
    }

    public function addList($book)
    {
        if (null === $this->list) {
            $this->makeList();
        }
        return $this->list->addList($book);
    }

    public function getList($bookNum)
    {
        if (NULL === $this->list) {
            $this->makeList();
        }
        return $this->list->getList($bookNum);
    }

    public function removeList($book)
    {
        if (NULL === $this->list) {
            $this->makeList();
        }
        return $this->list->removeList($book);
    }

    //Create
    public function makeList()
    {
        $this->list = new SomeList();
    }
}

class SomeList
{
    private $lists = [];
    private $count = 0;

    public function __construct()
    {
    }

    public function getListCount()
    {
        return $this->count;
    }

    private function setListCount($newCount)
    {
        $this->count = $newCount;
    }

    public function getList($listNumberToGet)
    {
        if ((is_numeric($listNumberToGet)) && ($listNumberToGet <= $this->getListCount())) {
            return $this->lists[$listNumberToGet];
        } else {
            return null;
        }
    }

    public function addList(Book $book)
    {
        $this->setListCount($this->getListCount() + 1);
        $this->lists[$this->getListCount()] = $book;
        return $this->getListCount();
    }

    public function removeList(Book $book_in)
    {
        $counter = 0;
        while (++$counter <= $this->getListCount()) {
            if ($book_in->getAuthorAndTitle() == $this->lists[$counter]->getAuthorAndTitle()) {
                for ($x = $counter; $x < $this->getListCount(); $x++) {
                    $this->lists[$x] = $this->lists[$x + 1];
                }
                $this->setListCount($this->getListCount() - 1);
            }
        }
        return $this->getListCount();
    }
}

class Book
{
    private $author;
    private $title;

    public function __construct($title, $author)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthorAndTitle()
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}

writeln('BEGIN TESTING PROXY PATTERN');
writeln('');

$proxyBookList = new Proxy();
$inBook = new Book('PHP for Cats', 'Larry Truett');
$proxyBookList->addList($inBook);

writeln('test 1 - show the book count after a book is added');
writeln($proxyBookList->getListCount());
writeln('');

writeln('test 2 - show the book');
$outBook = $proxyBookList->getList(1);
writeln($outBook->getAuthorAndTitle());
writeln('');

$proxyBookList->removeList($outBook);

writeln('test 3 - show the book count after a book is removed');
writeln($proxyBookList->getListCount());
writeln('');

writeln('END TESTING PROXY PATTERN');

function writeln($line)
{
    echo $line . "<br/>";
}