<?php

namespace dokuwiki\plugin\oauthiserv;

use dokuwiki\plugin\oauth\Service\AbstractOAuth2Base;
use OAuth\Common\Http\Uri\Uri;

/**
 * Custom Service for Generic oAuth
 */
class IServ extends AbstractOAuth2Base
{

    /** @inheritdoc */
    public function getAuthorizationEndpoint()
    {
        $plugin = plugin_load('helper', 'oauthiserv');
        return new Uri($plugin->getConf('baseurl').'/iserv/oauth/v2/auth');
    }

    /** @inheritdoc */
    public function getAccessTokenEndpoint()
    {
        $plugin = plugin_load('helper', 'oauthiserv');
        return new Uri($plugin->getConf('baseurl').'/iserv/oauth/v2/token');
    }

    /**
     * @inheritdoc
     */
    protected function getAuthorizationMethod()
    {
        $plugin = plugin_load('helper', 'oauthiserv');

        return (int) 2;
    }
}
