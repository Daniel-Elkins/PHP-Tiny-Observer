<?php
  
  #  Create some sample classes that will use the observer design.
  class Log extends \Observer
  {
    protected
      $_cbEventHandler = null;  #  Optional event handler to pass stuff to.
    
    public function __construct (callable $eventHandler = null)
    {
      $this->setEventHandler ($eventHandler);
    }
    
    #  One of the Subjects has notified us of an event.
    public function update (/* \Event */ $event, \Subject $subject = null)
    {
      if ((is_object ($event)) AND ($event instanceof \Event))
        //echo $event;  #  Call Event's __toString () function.
        call_user_func_array ($this->_cbEventHandler, [$event, $subject]);
      else
        #  If you want to accept multiple event types you could just echo the event here.
        trigger_error (__METHOD__ . ': unexpected event received.', E_USER_WARNING);
    }
    
    public function getEventHandler ()
    {
      return $this->_cbEventHandler;
    }
    
    public function setEventHandler (callable $eventHandler = null)
    {
      $this->_cbEventHandler = $eventHandler;
      return $this;
    }
  }
  
  
  class Visitor extends \Subject
  {
    protected
      $_loggedIn = false;
      
    public function __construct ()
    {
      parent::__construct ();
    }
    
    public function navigate ($url)
    {
      $this->notifyAll (new \Event ('Navigate', ['url' => $url, 'timestamp' => time ()]));
      return $this;
    }
    
    public function login ($username, $password)
    {
      if (true !== $this->_loggedIn) :
        $this->_loggedIn = true;
        $this->notifyAll (new \Event ('Login', ['usernam' => $username, 'password' => $password, 'timestamp' => time ()]));
      else :
        #  You could have a "notifyErrorHandler" for just raising errors.
        $this->notifyAll (new \Event ('Error', ['message' => 'Unable to login; visitor is already logged in. Please logout first.', 'timestamp' => time()]));
      endif;
      
      return $this;
    }
    
    public function logout ()
    {
      if (true === $this->_loggedIn) :
        $this->_loggedIn = false;
        $this->notifyAll (new \Event ('Logout', ['timestamp' => time ()]));
      else :
        $this->notifyAll (new \Event ('Error', ['message' => 'Unable to logout; visitor is not currently logged in.', 'timestamp' => time()]));
      endif;
      
      return $this;
    }
    
    public function getIP ()
    {
      return ip2long ($_SERVER['REMOTE_ADDR']);
    }
    
    public function getIPDotted ()
    {
      #  Could also check $_SERVER['HTTP_X_FORWARDED_FOR'] for transparent proxy.
      return $_SERVER['REMOTE_ADDR'];
    }
  }
  
  
  class System extends \Subject
  {
    public function __construct ()
    {
      parent::__construct ();
    }
    
    public function initialize ()
    {
      $this->notifyAll (
        new \Event (
          'Initialize',
          [
            'php_version' => phpversion (),
            'zend_version' => zend_version (),
            'time_initialized' => time (),
            'server_name' => isset ($_SERVER['COMPUTERNAME']) ? $_SERVER['COMPUTERNAME'] : '[n/a]',
            'operating_system' => ((isset ($_SERVER['OS'])) ? $_SERVER['OS'] : '[n/a]'),
            'requested_url' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
          ]
        )
      );
      
      return $this;
    }
  }
  
  