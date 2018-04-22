<?php
/* 
 * <FileName>
 *      getNews.php
 * </FileName>
 * <Description>
 *      Retrieves data from rss news feed and returns it to the calling statement.
 * </Description>
 * <return>
 *      returns an xml file based on the rss data.
 * </return>
 */

include 'Class_NewsFeed.php';

 // Simulate data store using an array
 $news_source = array(
        "cnn" => "http://rss.cnn.com/rss/cnn_us.rss",     
        "cnn-top" => "http://rss.cnn.com/rss/cnn_topstories.rss",
        "cnn-world" => "http://rss.cnn.com/rss/cnn_world.rss",
        "bbc" => "http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/front_page/rss.xml",
               
 );
 
$valid_source = -1;
$news_source_name = "";
$news_source_url = "";

// Only display rss/xml if news-source querystring is provided.
if (isset($_GET["news-source"])) {

    $provided_source = strtolower($_GET['news-source']);

    foreach ($news_source as $news_name => $news_value) {

        if ($provided_source == $news_name) {
            $news_source_name = $news_name;
            $news_source_url = $news_value;
            $valid_source = true;
        }                
    }

    if ($valid_source) {
        // 1. Create news feed class
        $newsObject = new NewsFeed();

        // 2. Set the news source name
        $newsObject->setAgency($news_source_name);

        // 3. Set the news source url
        $newsObject->setAgencyRssUrl($news_source_url);

        // 4. Get the xml from the url
        $newsObject->setRssFile($newsObject->getAgencyRssUrl());
        
        // 5. Create the page header
        header("Content-Type: text/xml");
        header("Content-Length: " . strlen($newsObject->getRssFile()));
        header("Cache-Control: no-cache");

        // 6. Read contents of the file aka generates the xml returned to calling JS.        
        $newsObject->readRSS($newsObject->getAgencyRssUrl());

        // TROUBLESHOOTING
        // echo $newsObject->setAgency($news_source_name) . "<br>";
        // echo $newsObject->setAgency($news_source_url) . "<br>";          
    } 
    else {
        echo "ERROR: News data source for \"{$provided_source}\" was not found!";  
    }

 } else {
    echo "ERROR: News data source was not provided!";
 }

