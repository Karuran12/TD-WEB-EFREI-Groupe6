<?php
require(__DIR__."/vendor/autoload.php");
use Algolia\AlgoliaSearch\Api\SearchClient;

// Fetch sample dataset
$url = "https://dashboard.algolia.com/sample_datasets/movie.json";
$response = file_get_contents($url);
$movies = json_decode($response, true);

// Connect and authenticate with your Algolia app
$client = SearchClient::create('SV8S2YS5ZG', '732f5ce4b4008f2b105751f55c9c4b7b');

// Save records in Algolia index
$client->saveObjects(
  "movies_index",

  movies
)

print('Done!');