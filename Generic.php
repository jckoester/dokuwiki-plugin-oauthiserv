<?php

namespace dokuwiki\plugin\oauthiserv;

use dokuwiki\plugin\oauth\Service\AbstractOAuth2Base;
use OAuth\Common\Http\Uri\Uri;

/**
 * Custom Service for Generic oAuth
 */
class Generic extends AbstractOAuth2Base
{

    /** @inheritdoc */
    public function getAuthorizationEndpoint()
    {
        $plugin = plugin_load('helper', 'oauthiserv');
        return new Uri($plugin->getConf('authurl'));
    }

    /** @inheritdoc */
    public function getAccessTokenEndpoint()
    {
        $plugin = plugin_load('helper', 'oauthiserv');
        return new Uri($plugin->getConf('tokenurl'));
    }

    /**
     * @inheritdoc
     */
    protected function getAuthorizationMethod()
    {
        $plugin = plugin_load('helper', 'oauthiserv');

        return (int) $plugin->getConf('authmethod');
    }
}
