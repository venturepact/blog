<?php
$output = $font_color = $el_class = $width = $offset = $is_sticky = $is_sidebar = $css_animation = '';
extract(shortcode_atts(array(
	'font_color'      => '',
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
	'offset' => '',
	'is_sticky' => '',
	'is_sidebar' => '',
	'css_animation' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
$el_class .= ' wpb_column vc_column_container';
$style = $this->buildStyle( $font_color );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if(!empty($css_animation))
	$css_class .= ' '.$css_animation;

$data = '';	
if($is_sticky == 'yes') {
	$css_class .= ' has-sticky-sidebar';
	$data .= ' data-margin_top="50" data-margin_bottom="50"';
}

$output .= "\n\t".'<div class="'.$css_class.'"'.$style.''.$data.'>';

if(!empty($is_sidebar) && $is_sidebar != "no" && $is_sidebar != "") {
	$output .= "\n\t\t".'<div class="sidebar vc_sidebar position-'.$is_sidebar.' widget-area">';
}
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');

if(!empty($is_sidebar) && $is_sidebar != "no" && $is_sidebar != "") {
	$output .= "\n\t\t".'</div> '.$this->endBlockComment($is_sidebar);
}	

$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;