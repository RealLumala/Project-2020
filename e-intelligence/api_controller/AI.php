<?php
require_once('AI_Library/DatumboxAPI.php');
$api_key='d9558c5918dd3b5dfe19cdd285cb0037'; 
$DatumboxAPI = new DatumboxAPI($api_key);
//Example of using Document Classification API Functions
$text="This Sentiment analysis api is good!";
$DocumentClassification=array();
$DocumentClassification['SentimentAnalysis']=$DatumboxAPI->SentimentAnalysis($text);
$DocumentClassification['LanguageDetection']=$DatumboxAPI->LanguageDetection($text);
unset($DatumboxAPI);

$x = $DocumentClassification['SentimentAnalysis'];
$l = $DocumentClassification['LanguageDetection'];
if($x != null){
	echo $x.' Language '.$l;
}else{
	echo 'AI not functioning';
}