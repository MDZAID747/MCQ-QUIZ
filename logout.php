<?php
session_start();  // creates a session or resumes the current one based on a session identifier passed via a GET or POST request
session_destroy(); //destroys all of the data associated with the current session. It does not unset any of the global variables associated with the session
header('location:login.php');    // control data sent to the client or browser by the Web server before some other output has been sent
  ?>