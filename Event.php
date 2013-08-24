<?php
  
  trait Printable
  {
    private function printText ($text, $default = null, $charset = 'utf-8')
    {
      $which = (strlen ($text) > 0) ? 'text' : 'default';
      
      if (strlen ($$which) > 0)
        return htmlspecialchars ($$which, ENT_QUOTES, $charset);
      
      return '';
    }
  }
  
  class Event
  {
    use \Printable;
    
    protected
      //$_charset = 'utf-8',
      $_name = '',
      $_data = [];
    
    public function __construct ($name, array $data = null)//, $charset = 'utf-8')
    {
      $this->setName ($name)->setData ($data);//->setCharset ($charset);
    }
    
    public function __toString ()
    {
      return
        '<div class="event"><p>Event <span class="name">' .
        $this->printText ($this->_name) . '</span>:</p>' .
        '<pre>' . PHP_EOL . print_r ($this->_data, true) . PHP_EOL . '</pre></div>';
    }
    
    public function getName ()
    {
      return $this->_name;
    }
    
    public function setName ($name)
    {
      $this->_name = (string) $name;
      return $this;
    }
    
    public function getData ()
    {
      return $this->_data;
    }
    
    public function setData (array $data = null)
    {
      $this->_data = is_array ($data) ? $data : [];
      return $this;
    }
    
    /*
    public function getCharset ()
    {
      return $this->_charset;
    }
    
    public function setCharset ($charset = 'utf-8')
    {
      $this->_charset = (string) $charset;
      return $this;
    }
    */
  }
  
  