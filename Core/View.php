<?php

namespace Core;

class View
{
  // public static function render($view, $args = [])
  // {
  //   extract($args, EXTR_SKIP);

  //   $file = "../App/View/$view";

  //   if (is_readable($file)) {
  //     require $file;
  //   } else {
  //     echo "$file not found";
  //   }
  // }

  public static function renderTemplate($template, $args = [])
  {
    static $twig = null;

    if ($twig === null) {
      $loader = new \Twig\Loader\FilesystemLoader('../App/View');
      $twig = new \Twig_Environment($loader);
    }
    echo $twig->render($template, $args);
  }
}