<?php

function flash($message, $level = 'information')
{
    Session::flash('flash_notification.message', $message);
    Session::flash('flash_notification.level', $level);
}
