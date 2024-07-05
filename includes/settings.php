<?php

function dc_register_settings() {
  
  // create a settings section
  add_settings_section( 'dc', 'Settings for Depth and Complexity Plugin', 'dc_section_text', 'dc_settings' );
  
  // create new setting object: DC Collection post ID
  register_setting( 'dc_options', 'dc_collection_post', 'dc_collection_post_validate' );
  add_settings_field( 'dc_collection_post', 'The Collection Post Id', 'dc_collection_post_callback', 'dc_settings', 'dc' );

  // create new setting object: DC Collection Product Category ID
  register_setting( 'dc_options', 'dc_collection_cat', 'dc_collection_cat_validate' );
  add_settings_field( 'dc_collection_cat', 'The Collection Product Category Id', 'dc_collection_cat_callback', 'dc_settings', 'dc' );

  // create new setting object: Graphic Org Post ID
  register_setting( 'dc_options', 'dc_go_post', 'dc_go_post_validate' );
  add_settings_field( 'dc_go_post', 'Graphic Organizers Post Id', 'dc_go_post_callback', 'dc_settings', 'dc' );

  // create new setting object: Async Courses Post ID
  register_setting( 'dc_options', 'dc_async_post', 'dc_async_post_validate' );
  add_settings_field( 'dc_async_post', 'Async Courses Post Id', 'dc_async_post_callback', 'dc_settings', 'dc' );

  // create new setting object: Software Suite Post ID
  register_setting( 'dc_options', 'dc_suite_post', 'dc_suite_post_validate' );
  add_settings_field( 'dc_suite_post', 'Software Suite Post Id', 'dc_suite_post_callback', 'dc_settings', 'dc' );

  // create new setting object: Deep Dive Post ID
  register_setting( 'dc_options', 'dc_dives_post', 'dc_dives_post_validate' );
  add_settings_field( 'dc_dives_post', 'Software Deep Dives Post Id', 'dc_dives_post_callback', 'dc_settings', 'dc' );

  // create new setting object: 2023 Summit Post ID
  register_setting( 'dc_options', 'dc_summit_post', 'dc_summit_post_validate' );
  add_settings_field( 'dc_summit_post', '2023 Summit Post Id', 'dc_summit_post_callback', 'dc_settings', 'dc' );

  // create new setting object: Spanish Post ID
  register_setting( 'dc_options', 'dc_spanish_post', 'dc_spanish_post_validate' );
  add_settings_field( 'dc_spanish_post', 'Spanish Post Id', 'dc_spanish_post_callback', 'dc_settings', 'dc' );
}
add_action( 'admin_init', 'dc_register_settings' );

function dc_collection_post_validate( $value ) {
  return $value;
}

function dc_cat_post_validate( $value ) {
  return $value;
}

function dc_go_post_validate( $value ) {
  return $value;
}

function dc_async_post_validate( $value ) {
  return $value;
}

function dc_suite_post_validate( $value ) {
  return $value;
}

function dc_dives_post_validate( $value ) {
  return $value;
}

function dc_summit_post_validate( $value ) {
  return $value;
}

function dc_spanish_post_validate( $value ) {
  return $value;
}

function dc_collection_post_callback() {
  $dc_collection_post = get_option( 'dc_collection_post' );
  echo '<input id="dc_collection_post" name="dc_collection_post" title="The post used to check if user is autorized to access to the DC Collection downloads" type="text" value="' . $dc_collection_post . '" />';
}

function dc_collection_cat_callback() {
  $dc_collection_cat = get_option( 'dc_collection_cat' );
  echo '<input id="dc_collection_cat" name="dc_collection_cat" title="The Product category for The Collection items" type="text" value="' . $dc_collection_cat . '" />';
}

function dc_go_post_callback() {
  $dc_go_post = get_option( 'dc_go_post' );
  echo '<input id="dc_go_post" name="dc_go_post" title="The post used to check if user is authorized to access Graphic Organizers" type="text" value="' . $dc_go_post . '" />';
}

function dc_async_post_callback() {
  $dc_async_post = get_option( 'dc_async_post' );
  echo '<input id="dc_async_post" name="dc_async_post" title="The post used to check if user is authorized to access Async Courses" type="text" value="' . $dc_async_post . '" />';
}

function dc_suite_post_callback() {
  $dc_suite_post = get_option( 'dc_suite_post' );
  echo '<input id="dc_suite_post" name="dc_suite_post" title="The post used to check if user is authorized to access the Software Suite" type="text" value="' . $dc_suite_post . '" />';
}

function dc_dives_post_callback() {
  $dc_dives_post = get_option( 'dc_dives_post' );
  echo '<input id="dc_dives_post" name="dc_dives_post" title="The post used to check if user is authorized to access the Deep Dives" type="text" value="' . $dc_dives_post . '" />';
}

function dc_summit_post_callback() {
  $dc_summit_post = get_option( 'dc_summit_post' );
  echo '<input id="dc_summit_post" name="dc_summit_post" title="The post used to check if user is authorized to access the 2023 Summit" type="text" value="' . $dc_summit_post . '" />';
}

function dc_spanish_post_callback() {
  $dc_spanish_post = get_option( 'dc_spanish_post' );
  echo '<input id="dc_spanish_post" name="dc_spanish_post" title="The post used to check if user is authorized to access DC Spanish" type="text" value="' . $dc_spanish_post . '" />';
}

function dc_section_text() {
  echo '';
}

function dc_register_options_page() {
  add_options_page('Depth and Complexity Settings', 'Depth and Complexity', 'manage_options', 'dc', 'dc_options_page');
}

add_action( 'admin_menu', 'dc_register_options_page' );

function dc_options_page()
{
?>

<table style="width: 100%">
  <tr valign="top">
    <td style="width: 50%;">
      <h1>Run User Report</h1>
      <br/>
      <form style="width: 40%">
        <div>
          <label for="dc_report_days"><strong>Number of Days:</strong></label>
          <input id="dc_report_days" name="dc_report_days" type="number" placeholder="30" min="1" style="float: right"/>
        </div>
        <br/>
        <div>
          <label for="dc_report_email_domain"><strong>Email Domain:</strong></label>
          <input id="dc_report_email_domain" name="dc_report_email_domain" placeholder="abcschool.edu" type="text" style="float: right"/>
        </div>
        <br/><br/>
        <button class="button report-btn" type="button" onclick="triggerReport()">Run Report</button>
      </form>
      <br/><br/>
      <div id="reportContainer" style="border: 1px solid gray; width: 80%; padding: 20px; background-color: #ffffff; border-radius: 5px"></div>
    </td>
    <td style="width: 50%">
      <h1>Depth and Complexity Settings</h1>
      <form action="options.php" method="post">
        <?php
          settings_fields( 'dc_options' );
          do_settings_sections( 'dc_settings' );
        ?>
        <br/>
        <input name="submit" class="button" type="submit" value="<?php esc_attr_e( 'Save Settings' ); ?>" />
      </form>
    </td>
  </tr>
</table>

<script>
  function triggerReport() {
    var button = document.querySelector('.report-btn');
    button.disabled = true;
    button.innerHTML = 'Generating...'

    var days = document.getElementById('dc_report_days').value;
    var emailDomain = document.getElementById('dc_report_email_domain').value;

    if (!days || !emailDomain) {
      alert('Please enter both number of days and email domain.');
      button.disabled = false;
      button.innerHTML = 'Run Report';
      return;
    }

    var data = {
      action: 'trigger_monthly_report',
      days: days,
      email_domain: emailDomain,
    };

    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: data,
      success: function(response) {
        jQuery('#reportContainer').html(response.data.data.message);
        if(response.data.data.hasData){
          alert('Report Generated and emailed to: info@jtayloreducation.com');
        };
      },
      error: function(error) {
        console.error('Error generating monthly report: ', error);
      },
      complete: function() {
        button.disabled = false;
        button.innerHTML = 'Run Report';
      }
    });
  }
</script>

<?php
}