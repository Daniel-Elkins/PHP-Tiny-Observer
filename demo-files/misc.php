<?php

  /*
    Demo-related functions; irrelevant to implementation.
    -----------------------------------------------------------------------
  */

  #  A shortcut for displaying text or a default value if the text is empty.
  function text ($text, $default = null, $return = true, $charset = 'utf-8')
  {
    $which = (strlen ($text) > 0) ? 'text' : 'default';

    if (strlen ($$which) > 0)

      if (true === $return)
        return htmlspecialchars ($$which, ENT_QUOTES, 'utf-8');
      else
        echo htmlspecialchars ($$which, ENT_QUOTES, 'utf-8');
  }


  #  Just a shorter way of displaying an error event.
  function displayError (\Event $errorEvent, \Subject $subject = null)
  {
    $data = $errorEvent->getData ();
    $subjectName = is_null ($subject) ?
      '<span class="subject"></span> '
      :
      ' - <span class="subject">' . text (basename (get_class ($subject))) . '</span>';

    if (array_key_exists ('timestamp', $data)) :
      $time = $data['time'];
    else :
      $time = strtotime ('now');
    endif;

    $displayTime = date ('g:i:s A (T)', $time);
    $datetime = date ('h:i', $time);
    $tz = date ('P', $time);

    return
      '<div class="error"><header><h1>Error' . $subjectName . '</h1>' .
      '<p class="time-occurred"><time datetime="' . text ($datetime) . '">' .//. 'T' . text ($tz) . '">' .
      $displayTime . '</time></p></header><p class="message">' .
      text ($data['message'], '[no error message is available]') . '</p></div>';
  }


  #  A short and central way to handle the displaying of an event occurring.
  function displayEvent (\Event $event, \Subject $subject = null)
  {
    $subjectName = is_null ($subject) ?
      '<span class="subject"></span> '
      :
      ' - <span class="subject">' . text (basename (get_class ($subject))) . '</span>.';

    return
      '<div class="event"><header><h1>Event' . $subjectName . '<span class="name">' . text ($event->getName ()) . '()</span></h1></header>' .
      '<pre class="data">' . PHP_EOL . print_r ($event->getData (), true) . PHP_EOL . '</pre></div>';
  }


  function getRequestedUrl ()
  {
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }


  function buildUriPath ($uri)
  {
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . ltrim ($uri, '/');
  }

