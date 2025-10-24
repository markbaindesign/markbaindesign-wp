<?php // 

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}


/**
 * Converts text wrapped in asterisks (*) to HTML <em> (italic) tags.
 *
 * This function searches the given content for any text enclosed in single asterisks
 * (e.g., *italic text*) and replaces it with the corresponding <em> HTML tag for italics.
 *
 * @param string $content The content to be processed.
 * @return string The content with asterisks-converted-to-italics.
 */
if(!function_exists('bd324_convert_asterisks_to_italics')):
function bd324_convert_asterisks_to_italics($content)
   {
      $content = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $content);
      return $content;
   }
endif;