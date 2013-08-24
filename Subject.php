<?php
  
  abstract class Subject
  {
    protected
      $_storage = null;
    
    public function __construct ()
    {
      $this->_storage = new \SplObjectStorage ();
    }
    
    public function attachObserver (\Observer $observer)
    {
      //die ('<pre>' . PHP_EOL . var_export ($this->_storage, true) . PHP_EOL . '</pre>');
      
      $this->_storage->attach ($observer);
      return $this;
    }
    
    public function detachObserver (\Observer $observer)
    {
      $this->_storage->detach ($observer);
      return $this;
    }
    
    public function notifyObserver (\Observer $observer, /* \Event */ $event)
    {
      $observer->update ($event, $this);
      return $this;
    }
    
    public function notifyAll (/* \Event */ $event)
    {
      foreach ($this->_storage as $observer)
        $observer->update ($event, $this);
      
      return $this;
    }
  }
  
  