<?php

class Post {
    private $_post_id;
    private $_titre;
    private $_user;
    private $_message;

    public function getPost_id()
	{
		return $this->_post_id;
    }

    public function getTitre()
	{
		return $this->_titre;
    }

    public function getUser()
	{
		return $this->_user;
    }
    
    public function getMessage()
	{
		return $this->_message;
}

?>