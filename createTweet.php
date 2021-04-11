<?php
use Model\Tweet;
require_once 'bootstrap.php';
require 'src/Models/Tweet.php';

    $newUserName = $argv[1];
    $newTweetContent = $argv[2];

    $tweet = new Tweet();
    $tweet->setUserName($newUserName);
    $tweet->setContent($newTweetContent);
    $entityManager->persist($tweet); 
    $entityManager->flush(); 

    echo "Created Tweet with ID " . $tweet->getId() . "\n";