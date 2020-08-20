<?php

class User {
    private $_user_id;
    private $_pseudo;
    private $_email;
    private $_mdp;

    public function getUser_id()
	{
		return $this->_user_id;
    }

    public function getPseudo()
	{
		return $this->_pseudo;
    }

    public function getEmail()
	{
		return $this->_email;
    }

    public function getMdp()
	{
		return $this->_mdp;
    }
    
    public function setPseudo($pseudo)
	{
		if (is_string($pseudo))
		{
			$this->_pseudo = $pseudo;
		}	
    }
    
    public function setEmail($email)
	{
		if (is_string($email))
		{
			$this->_email = $email;
		}	
    }
    
    public function setMdp($mdp)
	{
		if (is_string($mdp))
		{
			$this->_mdp = $mdp;
		}	
	}
}
?>