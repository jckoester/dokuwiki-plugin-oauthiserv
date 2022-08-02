<?php

use dokuwiki\plugin\oauth\Adapter;
#use dokuwiki\plugin\oauthgeneric\DotAccess;
use dokuwiki\plugin\oauthiserv\IServ;

/**
 * Service Implementation for oAuth Doorkeeper authentication
 */
class action_plugin_oauthiserv extends Adapter
{

    /** @inheritdoc */
    public function registerServiceClass()
    {
        return IServ::class;
    }

    /** * @inheritDoc */
    public function getUser()
    {
        $oauth = $this->getOAuthService();
        $data = array();

        $url = $this->getConf('baseurl');
        $raw = $oauth->request($url.'/iserv/public/oauth/userinfo');

        if (!$raw) throw new OAuthException('Failed to fetch data from userurl');
        $result = json_decode($raw, true);
        if (!$result) throw new OAuthException('Failed to parse data from userurl');

        $user = $result['preferred_username'];
        $name = $result['name'];
        $mail = $result['email'];
        $grps = array();
        foreach($result['groups'] as $group){
            array_push($grps, $group['act']);
        }
        
        return compact('user', 'name', 'mail', 'grps');
    }

    /** @inheritdoc */
    public function getScopes()
    {
        return $this->getConf('scopes');
    }

    /** @inheritDoc */
    public function getLabel()
    {
        return $this->getConf('label');
    }

    /** @inheritDoc */
    public function getColor()
    {
        return $this->getConf('color');
    }
}
