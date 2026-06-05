# Project Agents.md Guide for OpenAI Codex

This Agents.md file provides comprehensive guidance for OpenAI Codex and other AI agents working with this codebase.
It outlines the structure, purpose, and key components of the project to facilitate effective code generation, modification, and understanding.

# Development Environment & Preferences

## Debugging

-  **Use xdebug for debugging** - avoid adding debug output code to files, except in the case of JS
-  Set breakpoints and inspect variables directly instead of echo/var_dump

## WordPress Environment

-  VVV (Varying Vagrant Vagrants) local development
-  Site URL: https://localhost:3002/
-  WordPress multisite setup

## Custom Post Types & Taxonomies

-  **curriculum** post type with archive at `/learning-goals/`
-  Framework taxonomies with prefix "framework-" (framework-grade, framework-domain, framework-path, etc.)
-  Serial numbers: 3-part format (e.g., "1.2.3"), sometimes with A-E suffix (e.g., "1.2.3A")

## File Structure

-  **Theme**: `/wp-content/themes/middle-way-theme/`
-  **Plugin**: `/wp-content/plugins/mwe-curriculum/`
-  **Helper functions**: Always go in `inc/helpers/helpers.php`
-  **Templates**: Theme templates in `inc/templates/`

## Code Standards

-  PHP opening tags: Use single `<?php` (never double)
-  Function naming: Use `bd324_` prefix for custom functions
-  WordPress coding standards
-  ACF (Advanced Custom Fields) for meta fields
-  Don't add PHP opening tag when suggesting code snippets
-  Don't add placeholder text like `// ... rest of existing code stays the same ...` in the middle of code snippets

## Key Functions & Patterns

-  `bd324_get_serial_without_letters($serial)` - Removes A-E suffix from serial numbers
-  `bd324_convert_asterisks_to_italics($text)` - Converts asterisks to italic formatting
-  Template parts use `get_template_part()` with query vars for data passing
-  Custom queries use WP_Query with proper cleanup (`wp_reset_postdata()`)

## Sorting & Archives

-  Archive pages support custom sorting (title_asc, title_desc, serial_asc, etc.)
-  Title sorting ignores asterisks for proper alphabetical order
-  Pagination must be applied after custom sorting for correct results

## Build Tools

-  Grunt for asset compilation
-  SCSS for styling
-  Asset files in `assets/css/dev/` and `assets/js/`

## Testing Notes

-  Test on curriculum archives: `/learning-goals/`
-  Test shortcode: `[mwe-learning-goals]`
-  Use `?sort_debug=1` for archive sorting debug (when needed)
-  Use `?header_debug=1` for template debug (when needed)
