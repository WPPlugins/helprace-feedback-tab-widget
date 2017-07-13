<?php 
/**
 * The Template for displaying Helprace Feedback settings form in admin 
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Helprace Feedback 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Get feedback settings in option table exists else default settings
$settings = (array)get_option( 'helprace_options', helprace_feedback_default_settings() );

if( !isset( $settings['hfbw_display'] ) ) 
$settings['hfbw_display'] = 'disable';

if( !isset( $settings['hfbw_openew_tab'] ) )
$settings['hfbw_openew_tab'] = 'false';
?>
<div class="wrap">
  <h2>
    <?php _e( 'Helprace Feedback Tab Settings', 'helprace' ); ?>
  </h2>
  <p>
    <?php _e( 'Helprace Feedback Tab allows you to gather feedback anywhere on your website and understand how customers feel about your product and brand.', 'helprace' ); ?>
    <br>
    <?php printf( __ ( "You'll need to %screate a Helprace account%s in order to use this plugin.", 'helprace' ), '<a href="http://helprace.com/signup" target="_blank">', '</a>');?>
  </p> 
  <form method="post" action="options.php" style="margin-top:20px;">
    <?php settings_fields( self::$page_slug );	?>
    <table class="form-table">
      <tr>
        <th><label for="feedback_widget_enable">
            <?php _e( 'Feedback Widget', 'helprace' ); ?>
          </label></th>
        <td>
           <fieldset>
            <label>
              <input type="checkbox" name="helprace_options[hfbw_display]" value="enable" <?php checked( $settings['hfbw_display'], 'enable' ); ?> />
              <span class="description"><?php _e( 'Enable feedback widget on your site.', 'helprace' ); ?></span>
            </label>
           </fieldset>
          </td>
      </tr>
      <tr>
        <th><label for="domain_name">
            <?php _e( 'Helprace Subdomain', 'helprace' ) ?>
            <span class="required">*</span></label></th>
        <td><input type="text" name="helprace_options[hfbw_name]" id="hfbw_name" value="<?php echo esc_attr( $settings['hfbw_name'] ); ?>"/>
          <input type="text" id="subdomaintwo" value=".helprace.com" disabled/>
          <?php if( $settings['hfbw_name'] ): ?>
          <span><a href="<?php echo esc_url( set_url_scheme( $settings['hfbw_name'].'.helprace.com' ) ); ?>" class="button-secondary" target="_blank">
          <?php _e( 'Visit Website', 'helprace' ); ?>
          </a></span>
          <?php endif; ?>
          <p class="description">
            <?php printf( __( 'Enter your Helprace account name (same as your subdomain). E.g.: %s', 'helprace' ), '<strong>acme</strong>.helprace.com' ); ?>
            <br />
            <?php printf( __( '%sSign up here%s is you do not have a Helprace account yet. ', 'helprace' ), '<a href="http://helprace.com/signup" target="_blank">', '</a>'); ?>
          </p></td>
      </tr>
      <tr>
        <th><label for="display">
            <?php _e( 'Intergration Type', 'helprace' ); ?>
          </label></th>
        <td><fieldset>
            <label>
              <input type="radio" value="tab" name="helprace_options[hfbw_type]" class="hfbw_type" <?php checked( $settings['hfbw_type'], 'tab' ); ?>>
              <span>
              <?php _e( 'Tab', 'helprace' ) ?>
              </span></label>
            &nbsp;&nbsp;
            <label>
              <input type="radio" value="link" name="helprace_options[hfbw_type]" class="hfbw_type" <?php checked( $settings['hfbw_type'], 'link' ); ?>>
              <span>
              <?php _e( 'Own Link', 'helprace' ) ?>
              </span></label>
          </fieldset>
          <p class="description type-tab">
            <?php _e( 'Display the feedback tab on your site. ', 'helprace' ) ?>
          </p>
          <p class="description type-link">
            <?php _e( 'Display feedback widget when user clicks on your link. You might need basic JavaScript knowledge. ', 'helprace' ); ?>
            <br />
            <?php _e( 'Sample code: ', 'helprace' ) ?>
            <br />
            <code>&lt;a href="#" onClick="ChdFeedbackWidget.show();return false;"&gt;
            <?php _e( 'Feedback and Support', 'helprace' ); ?>
            &lt;/a&gt;</code> </p></td>
      </tr>
    </table>
    <h2 class="tab-setting">
      <?php _e( 'Tab Design', 'helprace' ); ?>
    </h2>
    <table class="form-table">
      <tr>
        <th><label for="title">
            <?php _e( 'Title', 'helprace' ); ?>
          </label></th>
        <td><input type="text" name="helprace_options[hfbw_title]" value="<?php echo esc_attr($settings['hfbw_title']); ?>" class="regular-text"/></td>
      </tr>
      <tr>
        <th><label for="position">
            <?php _e( 'Position', 'helprace' ); ?>
          </label></th>
        <td><select name="helprace_options[hfbw_position]" id="hfbw_position">
            <option value="left" <?php selected( $settings['hfbw_position'], 'left' ); ?>>
            <?php _e( 'Left', 'helprace' ); ?>
            </option>
            <option value="right" <?php selected( $settings['hfbw_position'], 'right' ); ?>>
            <?php _e( 'Right', 'helprace' ); ?>
            </option>
            <option value="top-left" <?php selected( $settings['hfbw_position'], 'top-left' ); ?>>
            <?php _e( 'Top-Left', 'helprace' ); ?>
            </option>
            <option value="top-right" <?php selected( $settings['hfbw_position'], 'top-right' ); ?>>
            <?php _e( 'Top-Right', 'helprace' ); ?>
            </option>
            <option value="bottom-left" <?php selected( $settings['hfbw_position'], 'bottom-left' ); ?>>
            <?php _e( 'Bottom-Left', 'helprace' ); ?>
            </option>
            <option value="bottom-right" <?php selected( $settings['hfbw_position'], 'bottom-right' ); ?>>
            <?php _e( 'Bottom-Right', 'helprace' ); ?>
            </option>
          </select></td>
      </tr>
      <tr>
        <th><label for="background_color">
            <?php _e( 'Background Color', 'helprace' ); ?>
          </label></th>
        <td><input type="text" name="helprace_options[hfbw_bgcolor]" id="hfbw_bgcolor" value="<?php echo $settings['hfbw_bgcolor']; ?>" /></td>
      </tr>
      <tr>
        <th><label for="text_color">
            <?php _e( 'Text Color', 'helprace' ); ?>
          </label></th>
        <td><input type="text" name="helprace_options[hfbw_textcolor]" id="hfbw_textcolor" value="<?php echo $settings['hfbw_textcolor']; ?>" /></td>
      </tr>
      <tr>
        <th><label for="open_tab">
            <?php _e( 'Open in a New Tab', 'helprace' ); ?>
          </label></th>
        <td><fieldset>
            <label>
              <input type="checkbox" name="helprace_options[hfbw_openew_tab]" value="true" <?php checked( $settings['hfbw_openew_tab'], 'true' ); ?> />
              <span class="description">
              <?php _e( 'Open Feedback Widget in a new window or tab.', 'helprace' ); ?>
              </span> </label>
          </fieldset></td>
      </tr>
    </table>
    <?php do_settings_sections( self::$page_slug ); ?>
    <?php submit_button(); ?>
  </form>
</div>
