<?php

namespace Drupal\age_checker\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

class AgeCheckerAgeGate extends ControllerBase {

  /**
   * Function age_checker_template.
   */
  public function age_checker_template() {

    // Getting the language Code.
    $language_code = $this->age_checker_get_language_code();

    dpm("language code");
    dpm($language_code); exit;
    // Header text of the form.
//    $age_checker_header_message_array = \Drupal::state()
//      ->get('age_checker_' . $language_code . '_age_gate_header');
//    $age_checker_header_message = $age_checker_header_message_array['value'];
//
//    // Form Element.
//    $age_checker_form = drupal_get_form('age_checker_form');

//    // Footer text of the form.
//    $age_checker_footer_message_array = \Drupal::state()->get('age_checker_' . $language_code . '_age_gate_footer');
//    $age_checker_footer_message = $age_checker_footer_message_array['value'];
//    // Sending variable to template.
//    return theme('age_checker',
//      array(
//        'age_checker_header_message' => $age_checker_header_message,
//        'age_checker_form' => $age_checker_form,
//        'age_checker_footer_message' => $age_checker_footer_message,
//      )
//    );
    return TRUE;
  }


  /**
   * Getting the language_code on the basis of Country selected.
   */
  public function age_checker_get_language_code() {

    $languages_options = array();
    $countries_array = array();
    $languages = \Drupal::state()->get('age_checker_language', '');
    $languages = explode("\n", $languages);

    foreach ($languages as $language) {
      $language = explode('|', $language);
      $language = array_map('trim', $language);

      $languages_options[$language[0]] = isset($language) ? $language[1] : NULL;
    }

    dpm("function call");
    dpm(age_checker_get_country_name());
    $selected_country = isset($_COOKIE['country_selected']) ? $_COOKIE['country_selected'] : age_checker_get_country_name();

    foreach ($languages_options as $key => $value) {
      $countries_array = \Drupal::state()->get('age_checker_' . $key . '_country_list');
      foreach ($countries_array as $country) {
        if ($country == $selected_country) {
          return $key;
        }
      }
    }
    return "hello";
  }


}