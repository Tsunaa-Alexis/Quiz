<?php

class Post {
    private $_post_id;
    private $_titre;
    private User $_user;
    private Message $_message;

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
    
    public function getMessage($id)
	{
		return $this->_message;
}
?>