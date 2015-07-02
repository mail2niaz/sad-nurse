<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function chmod_R($path, $filemode) {
 if ( !is_dir($path) ) {
  return chmod($path, $filemode);
 }
 $dh = opendir($path);
 while ( $file = readdir($dh) ) {
  if ( $file != '.' && $file != '..' ) {
   $fullpath = $path.'/'.$file;
   if( !is_dir($fullpath) ) {
    if ( !chmod($fullpath, $filemode) ){
     return false;
    }
   } else {
    if ( !chmod_R($fullpath, $filemode) ) {
     return false;
    }
   }
  }
 }

 closedir($dh);

 if ( chmod($path, $filemode) ) {
  return true;
 } else {
  return false;
 }
}