<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>RSS Feed Reader</title>
</head>

<body>
    <div class="hero">
        <h1>RSS Feed Reader</h1>
        <p>
            Get your real-time content updates from the web with this RSS feed reader.
        </p>
    </div>
    <main class="container ">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="url" name="url" placeholder="Your favorite RSS url" autofocus>
            <input type="submit" class="contrast" value="Feed">
        </form>
        <?php
        function isXML(string $url)
        {
            /* Explicitly return if url is valid XML */
            libxml_use_internal_errors(true);
            $Isxml = simplexml_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA);
            return $Isxml;
        }

        if (isset($_POST["url"])) {
            $url = $_POST["url"];
            $xml = isXML($url);
        }
        ?>
        <?php if ($xml) :
            $imageUrl = $xml->channel->image->url;
            require_once("./articles.php");
            foreach ($xml->channel->item as $item) {
                $articles = new articles($item, $imageUrl);
                $articles->display();
            }
        ?>
        <?php elseif (isset($_POST["url"])) : ?>
            <article>
                <p>This URL is not a valid RSS feed.😥 </p>
                <a href="https://rss.com/blog/popular-rss-feeds/" target="_blank" rel="noopener noreferrer">
                    Link to popular RSS Feed.
                </a>
                <br> <br>
                <i>
                    <a href="https://rss.com/blog/how-do-rss-feeds-work/" target="_blank" rel="noopener noreferrer">
                        What's a RSS Feed ?
                    </a> </i>
            </article>
        <?php else : ?>

        <?php endif ?>


    </main>
</body>

</html>