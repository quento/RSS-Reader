# Wk6-PracticeExercise
The Challenge
The challenge for this project was to create PHP script that showcases HTML, PHP and JavaScript working together.

I chose to create a project that pulls rss feed data from different news websites.
The basic process is as follows:

1. The newsfeed.php file loads when first visited.
2. A querystring variable is passed to JavaScript. 
   NOTE: In no querystring is present, a default value is used.
3. Processing on the client-side is then passed to app.js.
4. App.js uses AJAX to make a request to getNews.php and passes the news-source querystring value.
5. getNews.php in turn checks if a querystring is present.
6. Then tries to match the querystring provided with available news sources.
    NOTE: fos simplicity, an associative array was coded in getNew.php
7. If a valid source is found a NewsFeed object is created and used to return the RSS content.
8. Essentially getNews.php writes the headers and content to return as the rss xml data.
9. When complete. The .done() promise of the AJAX call is executed.
10. The loading message is hidden.
11. The displayNewsFeed() method is called. The data returned by the getNews.php file is passed to the function.
12. displayNewsFeed() retrieves the different xml nodes and uses the JavaScript helper functions.
13. The HTML formatted RSS content is then div#news container using its innerHTML property.
