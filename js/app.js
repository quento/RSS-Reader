

$(function(){
    /* DESCRIPTION: 
     * AJAX call to retrieve news from rss/xml. 
     * Content is parsed and displayed by displayNewsFeed().
     *  
     */

    $.ajax({
        url: "getNews.php?news-source=" + news_src,
        context: document.body,
        beforeSend: function() { $('#wait').show(); },
    })
    .done(function(data){  
        $('#wait').hide();      
        displayNewsFeed(data);
        //console.log(data);
    });

    // highlighter
    navHighlighter();

    // NOTE: Used JS below to meet requirements. Would have used JQuery instead because of the shorter helper methods.
    function displayNewsFeed(data) {
        // Get the different top level nodes in the rss xml doc.
        var channelHeading = data.getElementsByTagName("title"),
            channelDescription = data.getElementsByTagName("description"),
            channelLink = data.getElementsByTagName("link"),
            channelImage = data.getElementsByTagName("image"),
            channelImageUrl = channelImage[0].getElementsByTagName('url')[0];
            item = data.getElementsByTagName("item");

        var headline, link, pubDate, desc, image, newsitem;

        // Display title info
        getByTag(0,"h1").innerHTML = getNodeValue(channelHeading[0]).trim();
        getById("description").innerHTML += getNodeValue(channelDescription[0]);
        getById("description").innerHTML = "<img src=" + getNodeValue(channelImageUrl) + ">";

        // Display items only if they exist
        if (item.length > 0) {
            for(var i = 0; i < item.length; i++ ) {
                headline = getNodeValue(item[i].getElementsByTagName("title")[0]).trim();
                link = getNodeValue(item[i].getElementsByTagName("link")[0]);
                pubDate = getNodeValue(item[i].getElementsByTagName("pubDate")[0]);
                desc =  getNodeValue(item[i].getElementsByTagName("description")[0]);
                // Show image if available
                if (item[i].getElementsByTagName("media:thumbnail")[0]) {
                    imageUrl = item[i].getElementsByTagName("media:thumbnail")[0].attributes[2].value;	
                    image = '<p><img src="' + imageUrl + '" />';
                } else {
                    image = "";
                }
                

                newsitem = htmlTemplate(image, link, headline, pubDate, desc);
            
                // Append story item to news area
                getById("news").innerHTML += newsitem;
            }            
        }
    }

    /***********************************************************************************/
    /****************************** HELPER FUNCTIONS: **********************************/
    /***********************************************************************************/
    function htmlTemplate(image, link, headline, pubDate, desc) {
        // DESCRIPTION: Htmp template
        return '<div class="news">' + 
                    image + 
                    '<h3><a href="' + link + '" target="_blank">' + headline + '</a></h3>\n' +
                    '<p class="date">' + pubDate.toLocaleString() + '</p>\n' +									 
                    '<p>' + desc + '</p>\n' + 
                '</div>';
    }

	function getById(ElementId) {
		// DESCRIPTION: Retrieve element object based on element id attribute param.
		return document.getElementById(ElementId);
    }
    
    function getByTag(num, ElementName) {
        // DESCRIPTION: Retrieve element object based on element tag nam attribute param.        
        return document.getElementsByTagName(ElementName)[num];        
    }

    function getNodeValue(obj) {
        // DESCRIPTION: Traverse xml nodes and childNode to retrieve value.
        return obj.childNodes[0].nodeValue;
    }

    function navHighlighter(){
        // DESCRIPTION: add active class to link that matches current url querystring.

        var curr_qrystring = document.location.search;

        $('nav ul li a').each(function(){
            if ($(this).attr('href') == curr_qrystring) {
                $(this).addClass('active');
            }
            else if (curr_qrystring.length == 0){
                $('nav ul li a').first().addClass('active');
            }
            //TROUBLESHOOTING
            //console.log($(this).attr('href'));
        });


        // TROUBLESHOOTING
        //console.log(curr_qrystring);
    }
});