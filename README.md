PHP-Tiny-Observer
=================

PHP implementation and demonstration of a very simple "Observer Pattern". Does not use the built-in PHP SplObserver and SplSubject classes.

<style>
body{color:#000;background-color:#fff}.webhtml1-cssclassselector{color:purple}.webhtml1-csscomment{color:#ff8000}.webhtml1-csserror{color:red;text-decoration:underline}.webhtml1-cssidselector{color:purple}.webhtml1-cssnumbervalue{color:#00f}.webhtml1-cssproperty{color:#800040}.webhtml1-cssselector{color:purple;font-weight:bold}.webhtml1-cssstringvalue{color:#00f}.webhtml1-csssymbol{color:#00f}.webhtml1-cssundefinedproperty{color:red;text-decoration:underline}.webhtml1-cssundefinedselector{color:red}.webhtml1-cssundefinedvalue{color:red;text-decoration:underline}.webhtml1-cssvalue{color:#00f}.webhtml1-escomment{color:#ff8000}.webhtml1-eserror{color:red;font-weight:bold;text-decoration:underline}.webhtml1-esidentifier{color:#00f}.webhtml1-eskey{font-weight:bold}.webhtml1-esnumber{color:#008000}.webhtml1-esstring{color:red}.webhtml1-globalinactive{color:gray}.webhtml1-mlcomment{color:#ff8000}.webhtml1-mlerror{color:red;text-decoration:underline}.webhtml1-mlescapedamps{color:#ff8040}.webhtml1-mlkey{color:#2d8c58}.webhtml1-mltag{color:navy}.webhtml1-mltagname{color:#3e73ae}.webhtml1-mlundefinedkey{color:red;text-decoration:underline}.webhtml1-mlundefinedtagname{color:red;text-decoration:underline}.webhtml1-mlvalue{color:#f0f}.webhtml1-phpcomment{color:#a5a5a5}.webhtml1-phpconstant{color:#8000ff}.webhtml1-phpdoccomment{color:#ff8000}.webhtml1-phpdoccommenttag{color:#00f}.webhtml1-phperror{color:#a00;text-decoration:underline}.webhtml1-phpfunction{color:#008000;font-weight:bold}.webhtml1-phpidentifier{color:#008000}.webhtml1-phpkeyword{color:#00b}.webhtml1-phpmethod{color:#0080ff}.webhtml1-phpnumber{color:#00b}.webhtml1-phpstring{color:#d00}.webhtml1-phpstringspecial{color:#ff1c1c;font-weight:bold}.webhtml1-phpvariable{color:#06c}.webhtml1-specialphpmarker{color:#000;font-weight:bold}.webhtml1-specialphpvariableprefix{color:#06c}.webhtml1-specialscripttag{color:#000;font-weight:bold}.webhtml1-specialstyletag{color:#000;font-weight:bold}
</style>

<!--StartFragment--><pre><code><span class="webhtml1-specialphpmarker">&lt;?php

</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-phpcomment">#  Extend the Observer and Subject classes.

</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-phpcomment">#  A simple log class (Observer) which gets notified.
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-phpkeyword">class</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Log</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">extends</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Observer
</span><span class="webhtml1-phpwhitespace">  {
    </span><span class="webhtml1-phpkeyword">public</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">function</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">__construct</span><span class="webhtml1-phpwhitespace"> ()
    {
      </span><span class="webhtml1-phpidentifier">parent</span><span class="webhtml1-phpsymbol">::</span><span class="webhtml1-phpmethod">__construct</span><span class="webhtml1-phpwhitespace"> ();
    }
  }


  </span><span class="webhtml1-phpcomment">#  A simple visitor class (Subject) that notifies any
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-phpcomment">#  observers when some of its methods are called (login, logout, etc.).
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-phpkeyword">class</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Visitor</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">extends</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Subject
</span><span class="webhtml1-phpwhitespace">  {
    </span><span class="webhtml1-phpkeyword">public</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">function</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">__construct</span><span class="webhtml1-phpwhitespace"> ()
    {
      </span><span class="webhtml1-phpidentifier">parent</span><span class="webhtml1-phpsymbol">::</span><span class="webhtml1-phpmethod">__construct</span><span class="webhtml1-phpwhitespace"> ();
    }

    </span><span class="webhtml1-phpkeyword">public</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">function</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">login</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-specialphpvariableprefix">$username</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpstring">'guest'</span><span class="webhtml1-phpsymbol">, </span><span class="webhtml1-specialphpvariableprefix">$password</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpstring">'guest'</span><span class="webhtml1-phpsymbol">)
    {
      </span><span class="webhtml1-specialphpvariableprefix">$this</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">notifyAll</span><span class="webhtml1-phpwhitespace"> (
        </span><span class="webhtml1-phpstring">'login'</span><span class="webhtml1-phpsymbol">,
        [</span><span class="webhtml1-phpstring">'username'</span><span class="webhtml1-phpwhitespace"> =&gt; </span><span class="webhtml1-specialphpvariableprefix">$username</span><span class="webhtml1-phpsymbol">, </span><span class="webhtml1-phpstring">'password'</span><span class="webhtml1-phpwhitespace"> =&gt; </span><span class="webhtml1-specialphpvariableprefix">$password</span><span class="webhtml1-phpsymbol">]
      );

      </span><span class="webhtml1-phpkeyword">return</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-specialphpvariableprefix">$this</span><span class="webhtml1-phpsymbol">;
    }

    </span><span class="webhtml1-phpkeyword">public</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">function</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">logout</span><span class="webhtml1-phpwhitespace"> ()
    {
      </span><span class="webhtml1-specialphpvariableprefix">$this</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">notifyAll</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'logout'</span><span class="webhtml1-phpsymbol">);
      </span><span class="webhtml1-phpkeyword">return</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-specialphpvariableprefix">$this</span><span class="webhtml1-phpsymbol">;
    }

    </span><span class="webhtml1-phpkeyword">public</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpkeyword">function</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">navigate</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-specialphpvariableprefix">$url</span><span class="webhtml1-phpsymbol">)
    {
      </span><span class="webhtml1-specialphpvariableprefix">$this</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">notifyAll</span><span class="webhtml1-phpwhitespace"> (
        </span><span class="webhtml1-phpstring">'navigate'</span><span class="webhtml1-phpsymbol">,
        [</span><span class="webhtml1-phpstring">'url'</span><span class="webhtml1-phpwhitespace"> =&gt; </span><span class="webhtml1-specialphpvariableprefix">$url</span><span class="webhtml1-phpsymbol">]
      );
      </span><span class="webhtml1-phpkeyword">return</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-specialphpvariableprefix">$this</span><span class="webhtml1-phpsymbol">;
    }
  }


  </span><span class="webhtml1-phpcomment">#  1.  Create our test objects.
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$log</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpkeyword">new</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Log</span><span class="webhtml1-phpwhitespace"> ();
  </span><span class="webhtml1-specialphpvariableprefix">$visitor</span><span class="webhtml1-phpwhitespace"> = </span><span class="webhtml1-phpkeyword">new</span><span class="webhtml1-phpwhitespace"> </span><span class="webhtml1-phpidentifier">Visitor</span><span class="webhtml1-phpwhitespace"> ();

  </span><span class="webhtml1-phpcomment">#  2.  Attach the Observer to the Subject so it can be notified.
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$visitor</span><span class="webhtml1-phpsymbol">-&gt;</span><span class="webhtml1-phpmethod">attach</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-specialphpvariableprefix">$log</span><span class="webhtml1-phpsymbol">);

  </span><span class="webhtml1-phpcomment">#  3.  Call the functions and the $log object's update () method will be called
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-phpcomment">#      and passed the event name and data.
</span><span class="webhtml1-phpwhitespace">  </span><span class="webhtml1-specialphpvariableprefix">$visitor
</span><span class="webhtml1-phpwhitespace">    -&gt;</span><span class="webhtml1-phpmethod">login</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'user@email.com'</span><span class="webhtml1-phpsymbol">, </span><span class="webhtml1-phpstring">'#secret#'</span><span class="webhtml1-phpsymbol">)  </span><span class="webhtml1-phpcomment">#  Log gets notified of login with user/pass.
</span><span class="webhtml1-phpwhitespace">    -&gt;</span><span class="webhtml1-phpmethod">navigate</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'/account/home'</span><span class="webhtml1-phpsymbol">)            </span><span class="webhtml1-phpcomment">#  Log gets notified of navigate with URL.
</span><span class="webhtml1-phpwhitespace">    -&gt;</span><span class="webhtml1-phpmethod">navigate</span><span class="webhtml1-phpwhitespace"> (</span><span class="webhtml1-phpstring">'/profile/view'</span><span class="webhtml1-phpsymbol">)            </span><span class="webhtml1-phpcomment">#  ...
</span><span class="webhtml1-phpwhitespace">    -&gt;</span><span class="webhtml1-phpmethod">logout</span><span class="webhtml1-phpwhitespace"> ();

</span></code></pre><!--EndFragment-->