<?php
    /* 
     * SWDC 620 - Web Applications - Palmer
     * Week 6 - Exercise
     * Quentin Ochieng
     * 
     */ 


    // Retrieve querystring value using php
    if (isset($_GET["news-source"])) {
        $news_src = $_GET["news-source"];
    } else {
        $news_src = "bbc";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>News Feed Display</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <!-- Include JQuery Library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    
	
    <script>
        // Pass php querystring vallye to javascript. news_source is used in app.js 
        var news_src = '<?php echo $news_src; ?>';
    </script>
    <script src="js/app.js"></script>
</head>
<body>
    <nav>
        <div class="container">            
            <ul class="nav">
                <li><a href="?news-source=bbc">BBC</a></li>                
                <li><a href="?news-source=cnn">CNN</a></li>
                <li><a href="?news-source=cnn-top">CNN - Top Stories</a></li>
                <li><a href="?news-source=cnn-world">CNN World</a></li>
            </ul>
        </div>
    </nav>
    <section id="news-section">
        <div class="container">
            <h1></h1>
            <h2 id="description"></h2>
            <div id="wait"><img src="images/loading.gif" alt="Loading ...."></div>
            <div id="news"></div>
        </div>    
    </section>
    <footer>
        <div class="container">
            <p>Copyright &copy; 2018 Quentin Ochieng</p>
        </div>
    </footer>
</body>
</html>