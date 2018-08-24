<?php
/**
 * Register widget areas.
 *
 * Additional areas can be added by using register_sidebar().
 */

namespace Theme\WidgetAreas;

function setup_widget_areas() {
  $config = [
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
  ];
  register_sidebar([
      'name'          => __('Footer', 'pixels-text-domain'),
      'id'            => 'site-footer-widgets'
  ] + $config);
  register_sidebar([
      'name'          => __('Footer Media', 'pixels-text-domain'),
      'id'            => 'site-footer-some'
  ] + $config);
}
add_action('widgets_init', __NAMESPACE__ . '\\setup_widget_areas');

class SoMe_Widget extends \WP_Widget {
  public function __construct() {
    $widget_options = array(
      'classname' => 'social_media_widget',
      'description' => 'Constructed social media links',
    );
    parent::__construct( 'social_media_widget', 'Social Media Links Widget', $widget_options );
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $social['Facebook'] = $instance[ 'facebook_url' ];
    $social['LinkedIn'] = $instance[ 'linkedin_url' ];
    $social['Twitter'] = $instance[ 'twitter_url' ];
    $social['YouTube'] = $instance[ 'youtube_url' ];
    $facebook_url = $instance[ 'facebook_url' ];
    $linkedin_url = $instance[ 'linkedin_url' ];
    $twitter_url = $instance[ 'twitter_url' ];
    $youtube_url = $instance[ 'youtube_url' ];

    if ($title) {
      echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
    }

      $templates = ['components/social/social.twig'];
      $context = \Timber::get_context();
      $context['social'] = $social;
      \Timber::render( $templates, $context );

    echo $args['after_widget'];
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $facebook_url = ! empty( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
    $linkedin_url = ! empty( $instance['linkedin_url'] ) ? $instance['linkedin_url'] : '';
    $twitter_url = ! empty( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
    $youtube_url = ! empty( $instance['youtube_url'] ) ? $instance['youtube_url'] : '';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>">Facebook URL:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" value="<?php echo esc_attr( $facebook_url ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'linkedin_url' ); ?>">Linkedin URL:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'linkedin_url' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_url' ); ?>" value="<?php echo esc_attr( $linkedin_url ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'twitter_url' ); ?>">Twitter URL:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'twitter_url' ); ?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" value="<?php echo esc_attr( $twitter_url ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'youtube_url' ); ?>">Youtube URL:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'youtube_url' ); ?>" name="<?php echo $this->get_field_name( 'youtube_url' ); ?>" value="<?php echo esc_attr( $youtube_url ); ?>" />
    </p>
  <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'facebook_url' ] = strip_tags( $new_instance[ 'facebook_url' ] );
    $instance[ 'linkedin_url' ] = strip_tags( $new_instance[ 'linkedin_url' ] );
    $instance[ 'twitter_url' ] = strip_tags( $new_instance[ 'twitter_url' ] );
    $instance[ 'youtube_url' ] = strip_tags( $new_instance[ 'youtube_url' ] );

    return $instance;
  }
}

function register_some_widget() {
  register_widget( __NAMESPACE__ . '\\SoMe_Widget' );
}
add_action( 'widgets_init', __NAMESPACE__ . '\\register_some_widget' );
