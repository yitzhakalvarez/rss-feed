
<?php

class Articles

{
    public string $title;
    public string $fullDescription;
    public string $short_description;
    public $date;
    public string $imageURL;
    public string $link;


    private function buildShortDesc(string $fullDescription)
    {
        $possibleEndTag = ["</p>", "</ol>", "</ul>"];
        foreach ($possibleEndTag as $tag) {
            $tagPosition = stripos($fullDescription, $tag);
            if (!$tagPosition != "False") {
                break;
            } else {
                $tagPosition = 500;
            }
        }
        $shortDesc = substr($fullDescription, 0, $tagPosition);
        return $shortDesc;
    }

    public function __construct(object $item, $imageURL)
    {
        $this->title =  $item->title;
        $this->fullDescription = $item->description;
        $this->short_description = $this->buildShortDesc($this->fullDescription);
        $this->date = date('l, F d, o', strtotime($item->pubDate));
        $this->imageURL =  empty($imageURL) ? "./images/newspaper.jpg" : $imageURL;
        $this->link = $item->link;
    }

    public function display()
    {
        print("
        <article>
            <hgroup>
                <h3> $this->title </h3>
                <h5> $this->date </h5>
            </hgroup>
            <div class='grid'>
                <img src='$this->imageURL' height='500' width='500'>
                <div>
                    <p>$this->short_description</p>
                    <a href=$this->link> Read More </a>    
                </div>
            </div>
        </article>
        ");
    }
}
