<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

require_once 'bd324_get_learning_goal_subheader.php';
require_once 'convert-asterisks-to-italics.php';
require_once 'convert-data.php';
require_once 'get-goal-by-serial.php';
require_once 'get-icon.php';
require_once 'print-goal.php';
require_once 'goal-feedback.php';
require_once 'template-goal-meta-list-item.php';
require_once 'get-hierarchical-terms.php';
require_once 'get-resources-internal.php';
require_once 'get-resources-external.php';
require_once 'sort-resources-array.php';