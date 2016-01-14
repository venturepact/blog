<?php

/**
 * Google
 *
 */
class Google
{
    const ID = 'google';
    const NAME = 'Google';
    const SHARE_URL = 'http://plus.google.com/share?url=%s';
    const IFRAME_URL = 'http://plusone.google.com/_/+1/fastbutton?url=%s';
    const COLOR = '#dd4b39';

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return self::ID;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function getColor()
    {
        return self::COLOR;
    }

    /**
     * {@inheritDoc}
     */
    public function getLink($url, array $options = array())
    {
        return sprintf(self::SHARE_URL, urlencode($url));
    }

    /**
     * {@inheritDoc}
     */
    public function getShares($url)
    {
        $html = xt_get_url_contents(sprintf(self::IFRAME_URL, $url));

		if(!empty($html)) {
			
	        // Disable libxml errors
	        libxml_use_internal_errors(true);
	        $document = new \DOMDocument();
	        $document->loadHTML($html);
	        $aggregateCount = $document->getElementById('aggregateCount');
	
	        // Restore libxml errors
	        libxml_use_internal_errors();
	
	        // Instead of big numbers, Google returns strings like >10K
	        if (preg_match('/>([0-9]+)K/', $aggregateCount->nodeValue, $matches)) {
	           return $matches[1] * 1000;
	        }
	
	        return intval($aggregateCount->nodeValue);
	    }
	    
	    return 0;    
    }
}
