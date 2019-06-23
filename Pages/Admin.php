<?php

namespace IdnoPlugins\OAuth2Client\Pages;

use Idno\Core\Idno;

class Admin extends \Idno\Common\Page {

    function getContent() {
        $this->adminGatekeeper(); // Admins only
	
        $t = Idno::site()->template();
        $body = $t->draw('admin/oauth2client');
	
        $t->__(['title' => Idno::site()->language()->_('OAuth2 Client Config'), 'body' => $body])->drawPage();
    }

    function postContent() {
        $this->adminGatekeeper(); // Admins only
	
	if (!empty($this->arguments[0])) {
	    $object = \Idno\Common\Entity::getByID($this->arguments[0]);    
	} else {
	    $object = new \IdnoPlugins\OAuth2Client\Entities\OAuth2Client();
	}
	
	$object->saveDataFromInput();
	
        \Idno\Core\site()->session()->addMessage(Idno::site()->language()->_('Your OAuth 2 client settings were saved.'));

        $this->forward(Idno::site()->config()->getDisplayURL() . 'admin/oauth2client/');
    }

}
