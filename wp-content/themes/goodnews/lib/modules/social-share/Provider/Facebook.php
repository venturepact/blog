<?php

/**
 * Facebook
 *
 */
class Facebook
{
	const ID = 'facebook';
    const NAME = 'Facebook';
    const SHARE_URL = 'http://www.facebook.com/sharer/sharer.php?u=%s';
    const API_URL = 'http://graph.facebook.com/?id=%s';
    const COLOR = '#3b5998';

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
	    $data = xt_get_url_contents(sprintf(self::API_URL, $url));
	    
	    if(!empty($data)) {
       		$data = json_decode($data);
	   		return intval(isset($data->likes) ? $data->likes : $data->shares);
	   	}
	   	
	   	return 0;	
    }
}
