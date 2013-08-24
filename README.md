PHP-Tiny-Observer
=================

PHP implementation and demonstration of a very simple "Observer Pattern". Does not use the built-in PHP SplObserver and SplSubject classes.


<pre>
&lt;?php

  #  Extend the Observer and Subject classes.

  #  A simple log class (Observer) which gets notified.
  class Log extends Observer
  {
    public function __construct ()
    {
      parent::__construct ();
    }
  }


  #  A simple visitor class (Subject) that notifies any
  #  observers when some of its methods are called (login, logout, etc.).
  class Visitor extends Subject
  {
    public function __construct ()
    {
      parent::__construct ();
    }

    public function login ($username = 'guest', $password = 'guest')
    {
      $this->notifyAll (
        'login',
        ['username' => $username, 'password' => $password]
      );

      return $this;
    }

    public function logout ()
    {
      $this->notifyAll ('logout');
      return $this;
    }

    public function navigate ($url)
    {
      $this->notifyAll (
        'navigate',
        ['url' => $url]
      );
      return $this;
    }
  }


  #  1.  Create our test objects.
  $log = new Log ();
  $visitor = new Visitor ();

  #  2.  Attach the Observer to the Subject so it can be notified.
  $visitor->attach ($log);

  #  3.  Call the functions and the $log object's update () method will be called
  #      and passed the event name and data.
  $visitor
    ->login ('user@email.com', '#secret#')  #  Log gets notified of login with user/pass.
    ->navigate ('/account/home')            #  Log gets notified of navigate with URL.
    ->navigate ('/profile/view')            #  ...
    ->logout ();

</pre>
