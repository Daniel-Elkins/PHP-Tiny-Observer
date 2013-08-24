<?php

  #  Optional; you can pass anything as the event (array, string, etc.).
  require_once ('Event.php');

  #  The only two (2) files you need if putting this code into your own project.
  require_once ('Observer.php');
  require_once ('Subject.php');

  #  Log, Visitor, and System classes for testing the observer design.
  require_once ('demo-files/test-classes.php');

  #  Demo-related functions; irrelevant to implementation of observer pattern.
  require_once ('demo-files/misc.php');




  /*

    Not only do we want the Log object to be notified of events, we also want to
    be able to respond to events OUTSIDE of the log class.
  */
  function eventHandler (\Event $event, \Subject $subject = null)
  {
    $data = $event->getData ();

    switch (strtolower ($event->getName ())) :

      case 'error' :
        echo displayError ($event, $subject);
        break;

      #  Un-comment to do different things depending on the specific event type (name).
      /*
      case 'navigate' :
        break;

      case 'login' :
        break;

      case 'logout' :
        break;

      case 'initialize' :
        break;
      */

      default :
        echo displayEvent ($event, $subject);
        break;

    endswitch;
  }








  /*
    Begin relevant/important demo code.
  */


  $log = new Log ('eventHandler');
  $client = new Visitor ();
  $system = new System ();

  $client->attachObserver ($log);
  $system->attachObserver ($log);

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <style>
      @charset "utf-8 ";body{font-family:sans-serif;font-size:small;background-color:white;color:#444;margin:4em 6em;line-height:1.5em}a{text-decoration:none}a img{border:0}h1,h2,h3,h4,h5,h6{font-family:serif;font-weight:normal}body>header:first-child{border-bottom:2px solid #d0d0d0;padding-bottom:2em;margin-bottom:2em}div.event,div.error{display:block;border:1px solid #d7d7d7;border-radius:4px;box-shadow:2px 2px 1px #eee;padding:1em;margin-bottom:1em}div.event header h1,div.error header h1{margin-top:0}div.event p:last-child,div.event pre:last-child,div.error p:last-child,div.error pre:last-child{margin-bottom:0}div.event span.subject,div.error span.subject{color:#02b4ff}div.error h1{color:crimson}.webhtml1-cssclassselector{color:purple}.webhtml1-csscomment{color:#ff8000}.webhtml1-csserror{color:red;text-decoration:underline}.webhtml1-cssidselector{color:purple}.webhtml1-cssnumbervalue{color:#00f}.webhtml1-cssproperty{color:#800040}.webhtml1-cssselector{color:purple;font-weight:bold}.webhtml1-cssstringvalue{color:#00f}.webhtml1-csssymbol{color:#00f}.webhtml1-cssundefinedproperty{color:red;text-decoration:underline}.webhtml1-cssundefinedselector{color:red}.webhtml1-cssundefinedvalue{color:red;text-decoration:underline}.webhtml1-cssvalue{color:#00f}.webhtml1-escomment{color:#ff8000}.webhtml1-eserror{color:red;font-weight:bold;text-decoration:underline}.webhtml1-esidentifier{color:#00f}.webhtml1-eskey{font-weight:bold}.webhtml1-esnumber{color:#008000}.webhtml1-esstring{color:red}.webhtml1-globalinactive{color:gray}.webhtml1-mlcomment{color:#ff8000}.webhtml1-mlerror{color:red;text-decoration:underline}.webhtml1-mlescapedamps{color:#ff8040}.webhtml1-mlkey{color:#2d8c58}.webhtml1-mltag{color:navy}.webhtml1-mltagname{color:#3e73ae}.webhtml1-mlundefinedkey{color:red;text-decoration:underline}.webhtml1-mlundefinedtagname{color:red;text-decoration:underline}.webhtml1-mlvalue{color:#f0f}.webhtml1-phpcomment{color:#a5a5a5}.webhtml1-phpconstant{color:#8000ff}.webhtml1-phpdoccomment{color:#ff8000}.webhtml1-phpdoccommenttag{color:#00f}.webhtml1-phperror{color:#a00;text-decoration:underline}.webhtml1-phpfunction{color:#008000;font-weight:bold}.webhtml1-phpidentifier{color:#008000}.webhtml1-phpkeyword{color:#00b}.webhtml1-phpmethod{color:#0080ff}.webhtml1-phpnumber{color:#00b}.webhtml1-phpstring{color:#d00}.webhtml1-phpstringspecial{color:#ff1c1c;font-weight:bold}.webhtml1-phpvariable{color:#06c}.webhtml1-specialphpmarker{color:#000;font-weight:bold}.webhtml1-specialphpvariableprefix{color:#06c}.webhtml1-specialscripttag{color:#000;font-weight:bold}.webhtml1-specialstyletag{color:#000;font-weight:bold}
    </style>
    <title>
      Tiny Observer Demo
    </title>
  </head>
  <body>
    <header>
      <h1 class="title">
        Tiny Observer Demo
      </h1>
      <p class="subtitle"><small>
        Version 0.1.0
      </small></p>
    </header>

    <section class="body">

<!--StartFragment--><pre><code><span class="webhtml1-specialphpmarker">&lt;?php
</span><span class="webhtml1-phpwhitespace">
  </span><span class="webhtml1-phpcomment">/*
    Creat a new log which will receive all events
    from whatever attaches it.  Also give it a callback
    function so we can handle events OUTSIDE of the class too.
  */
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$log</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpkeyword">new</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Log</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'eventHandler'</span><span class="webhtml1-phpsymbol">);

  </span><span class="webhtml1-specialphpvariableprefix">$client</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpkeyword">new</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Visitor</span><span class="webhtml1-phpwhitespace"> ();
  </span><span class="webhtml1-specialphpvariableprefix">$system</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpkeyword">new</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">System</span><span class="webhtml1-phpwhitespace"> ();

  </span><span class="webhtml1-phpcomment">#  Attach the log to the visitor and system objects so we can receive updates from them.
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$client</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">attachObserver</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-specialphpvariableprefix">$log</span><span class="webhtml1-phpsymbol">);
  </span><span class="webhtml1-specialphpvariableprefix">$system</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">attachObserver</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-specialphpvariableprefix">$log</span><span class="webhtml1-phpsymbol">);

  </span><span class="webhtml1-phpcomment">#  Fake navigation (just raises a `Navigate` event).
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$client</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">navigate</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpidentifier">getRequestedUrl</span><span class="webhtml1-phpwhitespace"> ());

  </span><span class="webhtml1-phpcomment">/*
    In this demo, trying to logout without being
    logged in will raise an error.
  */
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$client</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">logout</span><span class="webhtml1-phpwhitespace"> ();
  </span><span class="webhtml1-specialphpvariableprefix">$client
</span><span class="webhtml1-phpwhitespace">    -&gt;</span><span class="webhtml1-phpmethod">login</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'SomeUser@email.com'</span><span class="webhtml1-phpsymbol">, </span><span class="webhtml1-phpstring">'#SecretPassword#'</span><span class="webhtml1-phpsymbol">)
    -&gt;</span><span class="webhtml1-phpmethod">navigate</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpidentifier">buildUriPath</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'my_account.php'</span><span class="webhtml1-phpsymbol">))-&gt;</span><span class="webhtml1-phpmethod">logout</span><span class="webhtml1-phpwhitespace"> ();

  </span><span class="webhtml1-specialphpvariableprefix">$system</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">initialize</span><span class="webhtml1-phpwhitespace"> ();

</span><span class="webhtml1-specialphpmarker">?&gt;
</span></code></pre><!--EndFragment-->
    </section>

    <?php
      #  Fake navigation (just raises a `Login` event).
      $client->navigate (getRequestedUrl ());

      #  Trying to logout without being logged in will raise an error.
      $client->logout ();
      $client->login ('SomeUser@email.com', '#SecretPassword#')->navigate (buildUriPath ('my_account.php'))->logout ();

      $system->initialize ();
    ?>
  </body>
</html>