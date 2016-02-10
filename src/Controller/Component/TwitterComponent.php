<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Twitter component
 */
class TwitterComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    protected $key = "nwv2GVV7Z173Ib3pjl8MRyiAX";
    protected $secret = "CNTVNv2DjkYDxPEKk01BOddykbmFCBxU2n5uexMNMZoTvXUfdl";

    public function Oauth(){

        $oauth = new TwitterOAuth($this->key, $this->secret);
        $accessToken = $oauth->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);

        $twitter = new TwitterOAuth($this->key, $this->secret, null, $accessToken->access_token);
        return $twitter;
    }

}
