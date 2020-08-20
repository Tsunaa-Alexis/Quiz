<?php 

class Message {
    private $_mess_id;
    private $_contenu;
    private $_date;
    private $_user_id;

    public function getMess_id()
	{
		return $this->_mess_id;
    }

    public function getContenu()
	{
		return $this->_contenu;
    }

    public function getDate()
	{
		return $this->_date;
    }

    public function getUser_id()
	{
		return $this->_user_id;
    }

    public function setContenu($contenu)
	{
		if (is_string($contenu))
		{
			$this->_contenu = $contenu;
		}	
    }

    public function setUser_id($user_id)
	{
		$user_id = (int) $user_id;
		$this->_user_id = $user_id;
	}


}
?>