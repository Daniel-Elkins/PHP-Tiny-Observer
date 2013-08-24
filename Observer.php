<?php
  
  abstract class Observer
  {
    public abstract function update (/* \Event */ $event, \Subject $subject = null);
  }
  
  