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
        <form action="index.php" method="post">
            <label for="url">URL:</label>
            <input type="text" name="url" id="url" placeholder="Enter URL">
            <input type="submit" value="Submit">
        </form>
        <?php
        if (isset($_POST['url'])) {
            $url = $_POST['url'];
            $xml = simplexml_load_file($url);
            echo "<h2>" . $xml->channel->title . "</h2>";
            echo "<p>" . $xml->channel->description . "</p>";
            echo "<ul>";
            foreach ($xml->channel->item as $item) {
                echo "<li><a href='" . $item->link . "'>" . $item->title . "</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
</body>

</html>