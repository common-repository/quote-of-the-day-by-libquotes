<?php
/*
Plugin Name:  Quote of the Day by LibQuotes
Plugin URI:   https://libquotes.com/Quote-JS-WordPress
Description:  Each day a new hand-picked quote will show up on your blog. 
Version:      1.2
Author:       LibQuotes
Author URI:   https://libquotes.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/
class LibQuotes_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'lib_widget',
			__('LibQuotes Widget', 'text_domain'),
			array( 'description' => __( 'Add the Quote of the Day widget to your site', 'text_domain' ), )
		);
	}
	public function widget( $args, $instance ) {
		$qtype = apply_filters( 'widget_title', $instance['qtype'] );

                $title_hash = array(
                     "qotd" => "Quote of the Day",
                     "qotdf" => "Funny Quote of the Day",
                 );

		echo $args['before_widget'];
		if ( ! empty( $qtype) )
			echo $args['before_title'] . $title_hash[$qtype]. $args['after_title'];

		echo __( '<script type="text/javascript" src="https://libquotes.com/widget/qotd.js?wp=1&qt=' . $qtype. '"></script>', 'text_domain' );
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'qtype' ] ) ) {
			$qtype = $instance[ 'qtype' ];
		}
		else {
			$qtype = "qotd";
		}
		?>
	         <p>
			<label for="<?php echo $this->get_field_id( 'qtype' ); ?>">Choose a type:</label> 
			<select id="<?php echo $this->get_field_id( 'qtype' ); ?>" name="<?php echo $this->get_field_name( 'qtype' ); ?>" class="widefat" style="width:100%;">
				<option value="qotd" <?php if ( 'qotd' == $qtype ) echo 'selected="selected"'; ?>>Quote of the Day</option>
				<option value="qotdf" <?php if ( 'qotdf' == $qtype ) echo 'selected="selected"'; ?>>Funny Quote of the Day</option>				
			</select>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['qtype'] = ( ! empty( $new_instance['qtype'] ) ) ? strip_tags( $new_instance['qtype'] ) : '';

		return $instance;
	}

}
function register_lib_widget() {
    register_widget( 'LibQuotes_Widget' );
}
add_action( 'widgets_init', 'register_lib_widget' );
?>
