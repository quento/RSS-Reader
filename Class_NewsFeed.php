<?php 
/* Class Name:  News
 * DESCRIPTION: News is a class that retrieves RSS feed data for use on your own website.
 * PARAMETERS:
 *   @agency:         name of the news agency
 *   @agency_rss_url: Url to the agency rss feed
 *   @rss_file:       The xml file generated from the rss feed retrieved fron the @agency_rss_url.
 */

 class NewsFeed
 {
    protected $_agency;
    protected $_agency_rss_url;
    protected $_rss_file;

    public function getAgency()
    {
        return $this->_agency;
    }

    public function setAgency($agency)
    {
        $this->_agency = $agency;
        return $this;
    }

    public function getAgencyRssUrl()
    {
        return $this->_agency_rss_url;
    }

    public function setAgencyRssUrl($agency_rss_url)
    {
        $this->_agency_rss_url = $agency_rss_url;
        return $this;
    }

    public function getRssFile()
    {
        return $this->_rss_file;
    }

    // get xml file from url provided
    public function setRssFile($url)
    {
        try {
            $this->_rss_file = file_get_contents($url);
            return $this;
        }
        catch(Exception$e) {
            echo 'ERROR! - ' . $e.getMessage();
        }
        
    }
    
    // read contents of the xml file
    public function readRSS($rss_url) 
    {
        try {
            readfile($rss_url);
        }
        catch(Exception $e) {
            echo 'ERROR! - ' . $e.getMessage();
        }
    }

 }


?>