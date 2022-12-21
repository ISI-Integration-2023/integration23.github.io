<?php
class eventdata_model
{
 public $eventid = 0;
 public $eventname  = null;
 public $catid = 0;
 public $catname = null;
 public $description  = null;
 public $timevenue  = null;
 public $cmscontent  = null;
 public $imagepath  = null;
 public $eventhead  = null;
 public $fees = null;
 public $isactive = true;    
}

/// eventdata isactive means that it is offline event. If not active, then it is online event.