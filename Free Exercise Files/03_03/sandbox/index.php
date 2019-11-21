<?php
/**
 * @file
 * Simple HTML Template; sets up debugging tools, if enabled.
 */

// Enable or disable debugging tools.
$tools = array(
  'chromephp' => TRUE,
  'firephp' => FALSE,
  'phpdebug' => FALSE,
);

// ChromePHP.
if ($tools['chromephp']) {
  // See http://www.chromephp.org for more details.
  require_once 'chromephp/ChromePhp.php';
  ob_start();
}

// FirePHP.
if ($tools['firephp']) {
  // See http://www.firephp.org/HQ/Learn.htm for more details.
  require_once 'FirePHPCore/FirePHP.class.php';
  ob_start();
}

// PHP_Debug.
if ($tools['phpdebug']) {
  // Set paths, configuration.
  $php_debug_options = array(
    'HTML_DIV_images_path' => 'PHP_Debug/images',
    'HTML_DIV_css_path' => 'PHP_Debug/css',
    'HTML_DIV_js_path' => 'PHP_Debug/js',
    'HTML_DIV_view_source_script_path' => 'PHP_Debug',
    'replace_errorhandler' => TRUE,
  );
  set_include_path(get_include_path() . PATH_SEPARATOR . 'PHP_Debug');
  require_once 'PHP_Debug/PHP/Debug.php';
  global $PHP_Debug;
  $PHP_Debug = new PHP_Debug($php_debug_options);
}

?><!doctype html>
  <!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]-->
  <!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
  <!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js" lang="en"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Debugging PHP Advanced Techniques</title>
    <meta name="description" content="Debug your PHP code efficiently a variety of client and server-side tools.">
    <meta name="author" content="Jon Peck">
    <meta name="viewport" content="width=device-width">
    <?php
      // PHP_Debug.
      if ($tools['phpdebug']): ?>
      <script type="text/javascript" src="<?php echo $php_debug_options['HTML_DIV_js_path']; ?>/html_div.js"></script>
      <link rel="stylesheet" href="<?php echo $php_debug_options['HTML_DIV_css_path']; ?>/html_div.css"/>
    <?php endif; ?>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div id="header-container">
      <header class="wrapper clearfix">
        <h1 id="title">Debugging PHP Advanced Techniques</h1>
      </header>
    </div>
    <div id="main-container">
      <div id="main" class="wrapper clearfix">
        <article><?php require_once 'demo.php'; ?></article>
      </div> <!-- #main -->
    </div> <!-- #main-container -->
    <div id="footer-container">
      <footer class="wrapper">
        <h3></h3>
      </footer>
    </div>
    <?php if ($tools['phpdebug']) $PHP_Debug->display(); ?>
  </body>
</html>
