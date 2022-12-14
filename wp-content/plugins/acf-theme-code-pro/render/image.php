<?php
// Image field

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( "postmeta" == ACFTCP_Core::$db_table ) { // ACF
	$return_format = isset( $this->settings['save_format'] ) ? $this->settings['save_format'] : '';
} elseif ( "posts" == ACFTCP_Core::$db_table ) { // ACF PRO
	$return_format = isset( $this->settings['return_format'] ) ? $this->settings['return_format'] : '';
}

// If image is returned as an array (postmeta / v5) or an object (posts / v4)
if ( $return_format == 'array' || $return_format == 'object'  ) {
	echo $this->indent . htmlspecialchars("<?php \$".$this->var_name." = " . $this->get_field_method . "( '".$this->name."' ); ?>")."\n";
	echo $this->indent . htmlspecialchars("<?php if ( \$".$this->var_name." ) { ?>")."\n";
	echo $this->indent . htmlspecialchars("	<img src=\"<?php echo \$".$this->var_name."['url']; ?>\" alt=\"<?php echo \$".$this->var_name."['alt']; ?>\" />")."\n";
	echo $this->indent . htmlspecialchars("<?php } ?>\n");
}

// If image is returned as a URL
if ( $return_format == 'url' ) {
	echo $this->indent . htmlspecialchars("<?php if ( " . $this->get_field_method . "( '" . $this->name . "') ) { ?>\n");
	echo $this->indent . htmlspecialchars("	<img src=\"<?php " . $this->the_field_method . "( '" . $this->name . "' ); ?>\" />\n");
	echo $this->indent . htmlspecialchars("<?php } ?>\n");
}

// If image is returned as an ID
if ( $return_format == 'id' ) {
	echo $this->indent . htmlspecialchars("<?php \$".$this->var_name." = " . $this->get_field_method . "( '".$this->name."' ); ?>")."\n";
	echo $this->indent . htmlspecialchars("<?php if ( \$".$this->var_name." ) { ?>")."\n";
	echo $this->indent . htmlspecialchars("	<?php echo wp_get_attachment_image( \$".$this->var_name.", 'full' ); ?>")."\n";
	echo $this->indent . htmlspecialchars("<?php } ?>\n");
}
