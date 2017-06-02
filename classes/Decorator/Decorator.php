<?php

/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 018 18.04.17
 * Time: 15:23
 */
class RenderText
{
    private $title;
    private $context;

    public function __construct($title, $contex)
    {
        $this->context = $contex;
        $this->title = $title;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTitleAndContext()
    {
        return $this->getTitle() . ' by ' . $this->getContext();
    }
}

class MainDecorator
{
    protected $title;
    protected $list;

    public function __construct(RenderText $list)
    {
        $this->list = $list;
        $this->resetTitle();
    }

    public function resetTitle()
    {
        $this->title = $this->list->getTitle();
    }

    public function showTitle()
    {
        return $this->title;
    }
}

class ColorDecorator extends MainDecorator
{
    private $mainDecorator;

    public function __construct(MainDecorator $mainDecorator)
    {
        $this->mainDecorator = $mainDecorator;
    }

    public function exclaimTitle()
    {
        $this->mainDecorator->title = "<p style='color: cadetblue'>" . $this->mainDecorator->title . "</p>";
    }
}

class WeightDecorator extends MainDecorator
{
    private $mainDecorator;

    public function __construct(MainDecorator $mainDecorator)
    {
        $this->mainDecorator = $mainDecorator;
    }

    public function starTitle()
    {
        $this->mainDecorator->title = "<p style='font-weight: bolder'>" . $this->mainDecorator->title . "</p>";
    }
}

writeln('BEGIN TESTING DECORATOR PATTERN');
writeln('');

$render = new RenderText("I love Patterns ", 'Patterns of OOP');

$decorator = new MainDecorator($render);
$starDecorator = new WeightDecorator($decorator);
$exclaimDecorator = new ColorDecorator($decorator);

writeln('showing title : ');
writeln($decorator->showTitle());
writeln('');

writeln('showing title after added color : ');
$exclaimDecorator->exclaimTitle();
$exclaimDecorator->exclaimTitle();
writeln($decorator->showTitle());
writeln('');

writeln('showing title after reset: ');
writeln($decorator->resetTitle());
writeln($decorator->showTitle());
writeln('');

writeln('showing title after added weight : ');
$starDecorator->starTitle();
writeln($decorator->showTitle());
writeln('');

writeln('showing title after reset: ');
writeln($decorator->resetTitle());
writeln($decorator->showTitle());
writeln('');

writeln('END TESTING DECORATOR PATTERN');

function writeln($text)
{
    echo $text . "<br/>";
}
