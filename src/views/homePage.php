<?php
use Model\Tweet;
require_once "./bootstrap.php";

$tweets = $entityManager->getRepository("Model\Tweet")->findAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="./src/style.css">
</head>

<body>
    <div class="container">
        <h1 class="heading">Basic Tweet managing System</h1>
        <header class="nav">
            <nav>
                <ul>
                    <?php
                    foreach ($tweets as $tweet) {
                        $IdRef = null;
                        if ($tweet->getId() === 1) {
                            $IdRef = './';
                        } else {
                            $IdRef = '?tweetId=' . $tweet->getId();
                        }
                        print('| <a href="' . $IdRef . '">' . $tweet->getUserName() . '</a> |');
                    }
                    ?>
                </ul>
            </nav>
        </header>
        <div class="tweet">
        <?php

        if ($_SERVER['REQUEST_URI'] === ($rootDir . '/')) {
            $content = $entityManager->find('Model\Tweet', 1);
            print('<h4>' . $content->getUserName() . '</h4><br>' . '<p>' .$content->getContent() . '</p>');
        } else if (isset($_GET['tweetId'])) {
            $content = $entityManager->find('Model\Tweet', $_GET['tweetId']);
            print('<h4>' . $content->getUserName() . '</h4><br>');
            print($content->getContent());
        }
        ?>
        </div>
    </div>
</body>

</html>