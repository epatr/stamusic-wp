<?php
/**
 * Display for Event Custom Post Types
 */
global $post, $ecwd_options;
$post_id = $post->ID;
$meta = get_post_meta($post_id);

// Load up all post meta data
$ecwd_event_venue = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_venue', true);
$ecwd_event_location = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_location', true);
$ecwd_event_show_map = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_show_map', true);
$ecwd_map_zoom = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_map_zoom', true);

$ecwd_lat_long = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_lat_long', true);
$ecwd_event_date_from = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_date_from', true);
$ecwd_event_date_to = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_date_to', true);
$ecwd_event_url = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_url', true);
$ecwd_event_repeat_event = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_event', true);
$ecwd_event_repeat_how = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_how', true);
$ecwd_event_repeat_repeat_until = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_repeat_until', true);
$ecwd_all_day_event = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_all_day_event', true);
$ecwd_event_day = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_day', true);
if (!is_array($ecwd_event_day)) {
  $ecwd_event_day = array();
}
$ecwd_venue_meta_phone = $ecwd_venue_meta_website = $venue_meta_show_map = "";
$venue_title = $venue_content = "";

$venues_meta_data = array();

$venue_meta_keys = array(
  'ecwd_venue_meta_phone',
  'ecwd_venue_meta_website',
  'ecwd_venue_show_map',
  'ecwd_venue_location',
  'ecwd_venue_lat_long',
  'ecwd_map_zoom'
);
$has_selected_venue = false;
if (!empty($venues)) {

  foreach ($venues as $venue) {
    $venues_meta_data[$venue->ID] = array();

    foreach ($venue_meta_keys as $venue_meta_key) {
      $venues_meta_data[$venue->ID][$venue_meta_key] = get_post_meta($venue->ID, $venue_meta_key, true);
    }

    if ($venue->ID == $ecwd_event_venue) {
      $has_selected_venue = true;
      $venue_meta_show_map = $venues_meta_data[$ecwd_event_venue]['ecwd_venue_show_map'];
    }

//    if ($venue->ID == $ecwd_event_venue) {
//      $ecwd_venue_meta_phone = $venues_meta_data[$ecwd_event_venue]['ecwd_venue_meta_phone'];
//      $ecwd_venue_meta_website = $venues_meta_data[$ecwd_event_venue]['ecwd_venue_meta_website'];

//      $venue_title = $venue->post_title;
//      $venue_content = $venue->post_content;
//    }
  }
}
$ecwd_event_repeat_month_on_days = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_month_on_days', true);
if (!$ecwd_event_repeat_month_on_days) {
  $ecwd_event_repeat_month_on_days = 1;
}
$ecwd_event_repeat_year_on_days = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_year_on_days', true);

if (!$ecwd_event_repeat_year_on_days) {
  $ecwd_event_repeat_year_on_days = 1;
}
$ecwd_event_repeat_on_the_m = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_on_the_m', true);
$ecwd_event_repeat_on_the_y = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_repeat_on_the_y', true);


$ecwd_monthly_list_monthly = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_monthly_list_monthly', true);
$ecwd_monthly_week_monthly = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_monthly_week_monthly', true);

$ecwd_monthly_list_yearly = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_monthly_list_yearly', true);
$ecwd_monthly_week_yearly = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_monthly_week_yearly', true);
$ecwd_event_year_month = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_year_month', true);
$ecwd_event_video = get_post_meta($post->ID, ECWD_PLUGIN_PREFIX . '_event_video', true);
?>


<table class="form-table">
  <tr id="ecwd_event_dates">
    <th scope="row"><?php _e('Event Dates', 'ecwd'); ?></th>
    <td>
      <?php _e('From', 'ecwd'); ?>
      <input type="text" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_date_from"
             id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_date_from"
             class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_date"
             value="<?php echo $ecwd_event_date_from; ?>"/>
      <!-- <p class="description">
       </p>-->
      <?php _e('To', 'ecwd'); ?>
      <input type="text" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_date_to"
             id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_date_to"
             class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_date"
             value="<?php echo $ecwd_event_date_to; ?>"/>

      <!--            <div id="-->
      <?php //echo ECWD_PLUGIN_PREFIX; ?><!--_event_pickup_date" class="button" value="">Days</div>-->
      <!--            <div id="-->
      <?php //echo ECWD_PLUGIN_PREFIX; ?><!--_event_pickup_time" class="button" value="">Time</div>-->
      <div class="checkbox-div">
        <input type='checkbox' class='ecwd_all_day_event' id='ecwd_all_day_event'
               name='ecwd_all_day_event' value="1" <?php checked($ecwd_all_day_event, '1'); ?>/>
        <label for="ecwd_all_day_event"></label>
      </div>
      <label for="ecwd_all_day_event"><?php _e('All day', 'ecwd'); ?></label>
      <!--<p class="description">
      </p>-->


      <p class="description ecwd_all_day_event_description">
        <?php _e('Fill in the starting and ending dates and time of the event. If the event lasts entire day, check the box on the right.', 'ecwd'); ?>
      </p>

    </td>
  </tr>
  <?php if ($is_ !== false) { ?>
    <tr id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeats_div">
      <th scope="row"><label class="repeat_format"><?php _e('Repeat rate', 'ecwd'); ?></label></th>
      <td>
        <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_repeat">
          <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_repeat_type_list">
            <!-- dont repeat -->
            <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_div">
              <p>
                <label>
                  <input checked='checked'
                         id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_dont_repeat_radio"
                         class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_radio"
                         type="radio"
                         name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event"
                         value="no_repeat" <?php checked($ecwd_event_repeat_event, 'no_repeat') ?>/>
                  <?php _e('Don\'t repeat', 'ecwd'); ?>
                </label>
              </p>
            </div>
            <!-- daily -->
            <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_div">
              <label>
                <input class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_radio" type="radio"
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event"
                       value="daily" <?php checked($ecwd_event_repeat_event, 'daily') ?>/>
                <?php _e('Daily', 'ecwd'); ?>
              </label>


            </div>

            <!-- weekly -->
            <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_div">
              <label>
                <input class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_radio" type="radio"
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event"
                       value="weekly" <?php checked($ecwd_event_repeat_event, 'weekly') ?>/>
                <?php _e('Weekly', 'ecwd'); ?>
              </label>

              <p class="description">

              </p>
            </div>

            <!-- monthly -->
            <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_div">
              <label>
                <input class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_radio"
                       id="<?php echo ECWD_PLUGIN_PREFIX; ?>_repeat_event_monthly" type="radio"
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event"
                       value="monthly" <?php checked($ecwd_event_repeat_event, 'monthly') ?> />
                <?php _e('Monthly', 'ecwd'); ?>
              </label>

              <p class="description"></p>


            </div>
            <!-- yearly -->
            <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_div">
              <label>
                <input class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_radio" type="radio"
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event"
                       value="yearly" <?php checked($ecwd_event_repeat_event, 'yearly') ?>/>
                <?php _e('Yearly', 'ecwd'); ?>
              </label>
            </div>
          </div>
          <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_repeat_advanced ">
            <div id="ecwd_daily" class="hidden">
              <label class="repeat_format"><?php _e('Repeat every', 'ecwd'); ?></label>
              <input type="text" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how"
                     value="<?php echo $ecwd_event_repeat_how ?>"/>

                        <span id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label_daily"
                              class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label hidden">
                            <?php _e('day(s)', 'ecwd'); ?>
                        </span>    

                        <span id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label_weekly"
                              class=" <?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label hidden">
                            <?php _e('weeks(s)', 'ecwd'); ?>
                          <?php _e('on ', 'ecwd'); ?>:
                        </span>
                        <span id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label_monthly"
                              class=" <?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label hidden">
                            <?php _e('month(s)', 'ecwd'); ?>
                        </span>
                        <span id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label_yearly"
                              class=" <?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_how_label hidden">
                            <?php _e('year(s) in ', 'ecwd'); ?>
                        </span>
            </div>

            <div id="ecwd_weekly" class="hidden">
              <div id="<?php echo ECWD_PLUGIN_PREFIX; ?>_choose_day_container">
                <div>
                  <!-- each day is a field -->
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_monday"
                           value='monday' <?php if (in_array('monday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_monday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_monday"><?php _e('Monday', 'ecwd'); ?></label>
                </div>
                <div>
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_tuesday"
                           value='tuesday' <?php if (in_array('tuesday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_tuesday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_tuesday"><?php _e('Tuesday', 'ecwd'); ?></label>
                </div>

                <div>
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_wednesday"
                           value='wednesday' <?php if (in_array('wednesday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_wednesday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_wednesday"><?php _e('Wednesday', 'ecwd'); ?></label>
                </div>
                <div>
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_thursday"
                           value='thursday' <?php if (in_array('thursday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_thursday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_thursday"><?php _e('Thursday', 'ecwd'); ?></label>
                </div>
                <div>
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_friday"
                           value='friday' <?php if (in_array('friday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_friday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_friday"><?php _e('Friday', 'ecwd'); ?></label>
                </div>
                <div>
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_saturday"
                           value='saturday' <?php if (in_array('saturday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_saturday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_saturday"><?php _e('Saturday', 'ecwd'); ?></label>
                </div>
                <div>
                  <div class="checkbox-div">
                    <input type='checkbox' name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_day[]"
                           id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_sunday"
                           value='sunday' <?php if (in_array('sunday', $ecwd_event_day)) {
                      echo 'checked="checked"';
                    } ?> />
                    <label for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_sunday"></label>
                  </div>
                  <label
                    for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_sunday"><?php _e('Sunday', 'ecwd'); ?></label>
                </div>
              </div>
            </div>
            <div id="ecwd_monthly" class="hidden">
              <div>


                <input type='radio' value="1" <?php checked($ecwd_event_repeat_month_on_days, '1') ?>
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_month_on_days"
                       id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_month_on_days_1"
                       class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_choose"/>
                <label class="repeat_format_monthly"
                       for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_month_on_days_1"><?php _e('On the same day', 'ecwd'); ?></label>
                <!--                            <input type="text" name="-->
                <?php //echo ECWD_PLUGIN_PREFIX; ?><!--_event_repeat_on_the_m"-->
                <!--                                   class='-->
                <?php //echo ECWD_PLUGIN_PREFIX; ?><!--_event_repeat_on_the'-->
                <!--                                   value="-->
                <?php //echo $ecwd_event_repeat_on_the_m; ?><!--"/>-->
              </div>

              <div class="ecwd_event_repeat_event_div">

                <input type='radio' value="2" <?php checked($ecwd_event_repeat_month_on_days, '2') ?>
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_month_on_days"
                       id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_month_on_days_2"
                       class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_list_radio"/>

                <label class="repeat_format_monthly"
                       for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_month_on_days_2"><?php _e('On the: ', 'ecwd'); ?></label>
                <select name="<?php echo ECWD_PLUGIN_PREFIX; ?>_monthly_list_monthly"
                        class="select_to_enable_disable">
                  <option <?php selected($ecwd_monthly_list_monthly, 'first'); ?>
                    value="first"><?php _e('First', 'ecwd'); ?> </option>
                  <option <?php selected($ecwd_monthly_list_monthly, 'second'); ?>
                    value="second"><?php _e('Second', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_list_monthly, 'third'); ?>
                    value="third"><?php _e('Third', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_list_monthly, 'fourth'); ?>
                    value="fourth"><?php _e('Fourth', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_list_monthly, 'last'); ?>
                    value="last"><?php _e('Last', 'ecwd'); ?></option>
                </select>
                <select name="<?php echo ECWD_PLUGIN_PREFIX; ?>_monthly_week_monthly"
                        class="select_to_enable_disable">
                  <option <?php selected($ecwd_monthly_week_monthly, 'monday'); ?>
                    value="monday"><?php _e('Monday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_monthly, 'tuesday'); ?>
                    value="tuesday"><?php _e('Tuesday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_monthly, 'wednesday'); ?>
                    value="wednesday"><?php _e('Wednesday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_monthly, 'thursday'); ?>
                    value="thursday"><?php _e('Thursday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_monthly, 'friday'); ?>
                    value="friday"><?php _e('Friday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_monthly, 'saturday'); ?>
                    value="saturday"><?php _e('Saturday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_monthly, 'sunday'); ?>
                    value="sunday"><?php _e('Sunday', 'ecwd'); ?></option>
                </select>
              </div>
            </div>
            <div id="ecwd_yearly" class="hidden">
              <select name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_year_month"
                      id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_year_month" disabled="disabled"
                      class="select_to_enable_disable">
                <option <?php selected($ecwd_event_year_month, '1'); ?>
                  value="1"><?php _e('January', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '2'); ?>
                  value="2"><?php _e('February', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '3'); ?>
                  value="3"><?php _e('March', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '4'); ?>
                  value="4"><?php _e('April', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '5'); ?>
                  value="5"><?php _e('May', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '6'); ?>
                  value="6"><?php _e('June', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '7'); ?>
                  value="7"><?php _e('July', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '8'); ?>
                  value="8"><?php _e('August', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '9'); ?>
                  value="9"><?php _e('September', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '10'); ?>
                  value="10"><?php _e('October', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '11'); ?>
                  value="11"><?php _e('November', 'ecwd'); ?></option>
                <option <?php selected($ecwd_event_year_month, '12'); ?>
                  value="12"><?php _e('December', 'ecwd'); ?></option>
              </select>

              <div class="ecwd_event_repeat_event_div">
                <input type='radio' value="1" <?php checked($ecwd_event_repeat_year_on_days, '1') ?>
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_year_on_days"
                       id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_year_on_days_1"
                       class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_choose"/>
                <label class="repeat_format_monthly"
                       for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_year_on_days_1"><?php _e('On the same day', 'ecwd'); ?>
                  :</label>
                <!--                            <input type="text" name="-->
                <?php //echo ECWD_PLUGIN_PREFIX; ?><!--_event_repeat_on_the_m"-->
                <!--                                   class='-->
                <?php //echo ECWD_PLUGIN_PREFIX; ?><!--_event_repeat_on_the'-->
                <!--                                   value="-->
                <?php //echo $ecwd_event_repeat_on_the_m; ?><!--"/>-->
              </div>

              <div class="ecwd_event_repeat_event_div">
                <input type='radio' value="2" <?php checked($ecwd_event_repeat_year_on_days, '2') ?>
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_year_on_days"
                       id="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_year_on_days_2"
                       class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_list_radio"/>

                <label class="repeat_format_monthly"
                       for="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_year_on_days_2"><?php _e('On the: ', 'ecwd'); ?></label>
                <select name="<?php echo ECWD_PLUGIN_PREFIX; ?>_monthly_list_yearly"
                        class="select_to_enable_disable">
                  <option <?php selected($ecwd_monthly_list_yearly, 'first'); ?>
                    value="first"> <?php _e('First', 'ecwd'); ?> </option>
                  <option <?php selected($ecwd_monthly_list_yearly, 'second'); ?>
                    value="second"><?php _e('Second', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_list_yearly, 'third'); ?>
                    value="third"><?php _e('Third', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_list_yearly, 'fourth'); ?>
                    value="fourth"><?php _e('Fourth', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_list_yearly, 'last'); ?>
                    value="last"><?php _e('Last', 'ecwd'); ?></option>
                </select>
                <select name="<?php echo ECWD_PLUGIN_PREFIX; ?>_monthly_week_yearly"
                        class="select_to_enable_disable">
                  <option <?php selected($ecwd_monthly_week_yearly, 'monday'); ?>
                    value="monday"><?php _e('Monday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_yearly, 'tuesday'); ?>
                    value="tuesday"><?php _e('Tuesday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_yearly, 'wednesday'); ?>
                    value="wednesday"><?php _e('Wednesday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_yearly, 'thursday'); ?>
                    value="thursday"><?php _e('Thursday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_yearly, 'friday'); ?>
                    value="friday"><?php _e('Friday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_yearly, 'saturday'); ?>
                    value="saturday"><?php _e('Saturday', 'ecwd'); ?></option>
                  <option <?php selected($ecwd_monthly_week_yearly, 'sunday'); ?>
                    value="sunday"><?php _e('Sunday', 'ecwd'); ?></option>
                </select>
              </div>

            </div>
            <!-- repeat until -->
            <div class="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_event_div">
              <p class="description">

              <div id="ecwd_repeat_until" class="hidden">
                <label class="repeat_format"><?php _e('Repeat until', 'ecwd'); ?></label>
                <input id='<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_until_input' type="text"
                       name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_repeat_repeat_until"
                       value="<?php echo $ecwd_event_repeat_repeat_until; ?>"/>
              </div>
              </p>
            </div>

          </div>
          <div class="clear"></div>
        </div>
        <p class="description">
          <?php _e('Specify the repeating rate of the event.', 'ecwd'); ?>
        </p>
      </td>
    </tr>


  <?php } else { ?>
    <tr>
      <th scope="row"><label class="repeat_format"><?php _e('Repeat rate', 'ecwd'); ?></label></th>
      <td>
        <a href="https://web-dorado.com/files/fromEventCalendarWD.php"
           target="_blank"><?php _e('Upgrade to Pro version', 'ecwd'); ?></a>
      </td>
    </tr>
  <?php } ?>

  <tr>
    <th scope="row"><?php _e('Event Venue', 'ecwd'); ?></th>
    <td>

      <select name="ecwd_event_venue" id="ecwd_event_venue">
        <option value="0">None</option>
        <?php
        if (!empty($venues)) {
          foreach ($venues as $venue) {


            $options_attr = "";
            $options_attr .= 'data-venuetitle="' . $venue->post_title . '" ';
            $options_attr .= 'data-venuecontent="' . $venue->post_content . '" ';
            $options_attr .= 'data-location="' . $venues_meta_data[$venue->ID]['ecwd_venue_location'] . '" ';
            $options_attr .= 'data-marker="' . $venues_meta_data[$venue->ID]['ecwd_venue_lat_long'] . '" ';
            $options_attr .= 'data-zoom="' . $venues_meta_data[$venue->ID]['ecwd_map_zoom'] . '" ';
            $options_attr .= 'data-metaphone="' . $venues_meta_data[$venue->ID]['ecwd_venue_meta_phone'] . '" ';
            $options_attr .= 'data-metawebsite="' . $venues_meta_data[$venue->ID]['ecwd_venue_meta_website'] . '" ';
            $options_attr .= 'data-showmap="' . $venues_meta_data[$venue->ID]['ecwd_venue_show_map'] . '" ';

            ?>
            <option
              value="<?php echo $venue->ID; ?>"
              <?php echo $options_attr; ?>
              <?php echo selected($venue->ID, $ecwd_event_venue); ?>>
              <?php echo $venue->post_title; ?>
            </option>
            <?php
          }
        }
        $venue_fields_style = ($has_selected_venue == '1') ? "style='display:none;'" : "";
        ?>
      </select>

      <p class="description">
        <?php _e('Select the venue of the event.', 'ecwd'); ?>
      </p>

      <div class="ecwd-venue-meta-fields">
        <!-- start ecwd_venue_title -->
        <div class="ecwd-meta-field" <?php echo $venue_fields_style; ?>>
          <label for="ecwd_venue_title">Venue Title:</label>
          <input type="text" name="ecwd_venue_title" id="ecwd_venue_title"
                 value="<?php echo $venue_title; ?>" size="50"/>
        </div>
        <!-- end ecwd_venue_title -->
        <!-- start ecwd_venue_description -->
        <div class="ecwd-meta-field" <?php echo $venue_fields_style; ?>>
          <label style="vertical-align: top;" for="ecwd_venue_content">Venue Description:</label>
          <textarea name="ecwd_venue_content" id="ecwd_venue_content"><?php echo $venue_content; ?></textarea>
        </div>
        <!-- end ecwd_venue_description -->
        <!-- start ecwd_event_location -->
        <div class="ecwd-meta-field">
          <label for="ecwd_event_location">Address:</label>
          <input type="text" name="ecwd_event_location" id="ecwd_event_location"
                 value="<?php echo $ecwd_event_location; ?>" size="40"/>
        </div>
        <!-- end ecwd_event_location -->
        <!-- start ecwd_venue_meta_phone -->
        <div class="ecwd-meta-field" <?php echo $venue_fields_style; ?>>
          <label for="ecwd_venue_meta_phone">Phone:</label>
          <input type="text" name="ecwd_venue_meta_phone"
                 id="ecwd_venue_meta_phone" value="<?php echo $ecwd_venue_meta_phone; ?>"/>
        </div>
        <!-- end ecwd_venue_meta_phone -->
        <!-- start ecwd_venue_meta_website -->
        <div class="ecwd-meta-field" <?php echo $venue_fields_style; ?>>
          <label for="ecwd_venue_meta_website">Website:</label>
          <input type="text" name="ecwd_venue_meta_website"
                 id="ecwd_venue_meta_website" value="<?php echo $ecwd_venue_meta_website; ?>"/>
        </div>
        <!-- end ecwd_venue_meta_website -->
        <div class="ecwd-meta-field" <?php echo $venue_fields_style; ?>>
          <label for="ecwd_venue_show_map">Show Google Map:</label>
          <div class="checkbox-div">
            <input type='checkbox' class='ecwd_venue_show_map' id='ecwd_venue_show_map'
                   name='ecwd_venue_show_map' value="1" <?php checked($venue_meta_show_map, 1); ?>/>
            <label for="ecwd_venue_show_map"></label>
          </div>
        </div>

      </div>
      <?php

      $ecwd_marker = 1;
      if (!$ecwd_lat_long) {
        $ecwd_lat_long = $lat . ',' . $long;
        $ecwd_marker = 0;
      }

      $latitude = $longitude = '';
      if (!empty($ecwd_lat_long)) {
        $lat_long_data = explode(',', $ecwd_lat_long);
        if (is_array($lat_long_data) && count($lat_long_data) == 2) {
          $latitude = $lat_long_data[0];
          $longitude = $lat_long_data[1];
        }
      }

      $gmap_key = (isset($ecwd_options['gmap_key'])) ? trim($ecwd_options['gmap_key']) : "";

      $venue_description_class = ($venue_meta_show_map !== '1') ? 'ecwd_hidden' : '';
      $venue_description_class .= ' description ecwd_venue_meta_decription';
      if (!empty($gmap_key)) {
        $venue_map_class = ($venue_meta_show_map !== '1') ? "ecwd-hide-map" : "";
        ?>

        <div class="ecwd_google_map_wrapper">
          <div class="ecwd_google_map <?php echo $venue_map_class; ?>">
            <?php

            if (!$ecwd_map_zoom) {
              $ecwd_map_zoom = 17;
            }

            $ecwd_marker = 1;
            if (!$ecwd_lat_long) {
              $ecwd_map_zoom = 9;
              $ecwd_lat_long = $lat . ',' . $long;
              $ecwd_marker = 0;
            }
            ?>
            <input type="hidden" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_lat_long"
                   id="<?php echo ECWD_PLUGIN_PREFIX; ?>_lat_long"
                   value="<?php echo $ecwd_lat_long; ?>"/>
            <input type="hidden" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_marker"
                   id="<?php echo ECWD_PLUGIN_PREFIX; ?>_marker" value="<?php echo $ecwd_marker; ?>"/>
            <input type="hidden" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_map_zoom"
                   id="<?php echo ECWD_PLUGIN_PREFIX; ?>_map_zoom"
                   value="<?php echo $ecwd_map_zoom; ?>"/>

            <div id="map-canvas" style="width: 100%; height: 300px; min-height: 300px;"></div>

            <?php
            $latitude = $longitude = '';
            if (!empty($ecwd_lat_long)) {
              $lat_long_data = explode(',', $ecwd_lat_long);
              if (is_array($lat_long_data) && count($lat_long_data) == 2) {
                $latitude = $lat_long_data[0];
                $longitude = $lat_long_data[1];
              }
            }
            ?>

            <label style="width:85px;display:inline-block;" for="ecwd_latitude">Latitude:</label>
            <input type="text" id="ecwd_latitude" value="<?php echo $latitude; ?>"/>
            <br/>
            <label style="width:85px;display:inline-block;" for="ecwd_longitude">Longitude:</label>
            <input type="text" id="ecwd_longitude" value="<?php echo $longitude; ?>"/>
          </div>
        </div>
        <p class="<?php echo $venue_description_class; ?>">
          <?php _e('If venue is not specified you can fill in the address of the event location or click on the map to drag and drop the marker to the event location.', 'ecwd'); ?>
        </p>
      <?php } else { ?>
        <label></label>
        <span class="<?php echo $venue_description_class; ?>">
               <?php _e('Gmap key does not exist', 'ecwd'); ?>
          <a href="edit.php?post_type=ecwd_event&page=ecwd_general_settings&tab=google_map">Settings page</a>
            </span>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <th scope="row"><?php _e('Event URL', 'ecwd'); ?></th>
    <td>
      <input type="text" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_url" value="<?php echo $ecwd_event_url; ?>"
             size="70">

      <p class="description">
        <?php _e('Provide a custom URL which will display event details.', 'ecwd'); ?>
      </p>
    </td>
  </tr>
  <tr>
    <th scope="row"><?php _e('Event Video URL', 'ecwd'); ?></th>
    <td>
      <input type="text" name="<?php echo ECWD_PLUGIN_PREFIX; ?>_event_video"
             value="<?php echo $ecwd_event_video; ?>" size="70">

      <p class="description">
        <?php _e('Provide Youtube or Vimeo URL of the video to accompany the event.', 'ecwd'); ?>
      </p>
    </td>
  </tr>
</table>