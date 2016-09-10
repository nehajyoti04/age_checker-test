<?php
/**
 * @file
 * Contains \Drupal\example\Form\AgeChecker.
 */

namespace Drupal\age_checker\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use DateTime;
//use Drupal\age_checker\Form\AgeCalculatorSettingsForm;
/**
 * Implements an example form.
 */
class AgeCheckerForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'age_checker_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = array();
    // Getting the langauge_code.
//    $language_code = age_checker_get_language_code();
//
//    // Default Country.
//    $selected_country = isset($_COOKIE['country_selected']) ? $_COOKIE['country_selected'] : age_checker_get_country_name();
//
//    // Country list.
//    $countries = \Drupal::state()->get('age_checker_countries', '');
//    $countries = explode("\n", $countries);
//    foreach ($countries as $country) {
//      $country = explode('|', $country);
//      $country = array_map('trim', $country);
//      $result[$country[0]] = $country[1];
//    }
//    if (count($result) > 1) {
//      $form['list_of_countries'] = array(
//        '#type' => 'select',
//        '#title' => \Drupal::state()->get('age_checker_' . $language_code . '_select_list_label'),
//        '#options' => $result,
//        '#weight' => -1,
//        '#id' => 'age_checker_country',
//        '#default_value' => $selected_country,
//        '#attributes' => array(
//          'tabindex' => '1',
//        ),
//      );
//    }
//
    $form['age_checker_error_message'] = array(
      '#type' => 'markup',
      '#markup' => '<div id="age_checker_error_message"> </div>',
      '#weight' => 0,
    );
//
//    // Day form Element.
    $form['day'] = array(
      '#type' => 'textfield',
      '#size' => 2,
      '#maxlength' => 2,
//      '#id' => 'age_checker_day',
//      '#weight' => \Drupal::state()->get('age_checker_' . $selected_country . '_day_weight'),
//      '#required' => TRUE,
//      '#attributes' => array(
//        'pattern' => "[0-9]*",
//        'tabindex' => \Drupal::state()->get('age_checker_' . $selected_country . '_day_weight'),
//        'placeholder' => \Drupal::state()->get('age_checker_' . $selected_country . '_day_placeholder'),
//      ),
    );
//
//    // Month form Element.
//    $form['month'] = array(
//      '#type' => 'textfield',
//      '#size' => 2,
//      '#maxlength' => 2,
//      '#id' => 'age_checker_month',
//      '#required' => TRUE,
//      '#weight' => \Drupal::state()->get('age_checker_' . $selected_country . '_month_weight'),
//      '#attributes' => array(
//        'pattern' => "[0-9]*",
//        'tabindex' => \Drupal::state()->get('age_checker_' . $selected_country . '_month_weight'),
//        'placeholder' => \Drupal::state()->get('age_checker_' . $selected_country . '_month_placeholder'),
//      ),
//    );
//
//    // Year form Element.
//    $form['year'] = array(
//      '#type' => 'textfield',
//      '#size' => 4,
//      '#maxlength' => 4,
//      '#id' => 'age_checker_year',
//      '#weight' => \Drupal::state()->get('age_checker_' . $selected_country . '_year_weight'),
//      '#required' => TRUE,
//      '#attributes' => array(
//        'pattern' => "[0-9]*",
//        'tabindex' => \Drupal::state()->get('age_checker_' . $selected_country . '_year_weight'),
//        'placeholder' => \Drupal::state()->get('age_checker_' . $selected_country . '_year_placeholder'),
//      ),
//    );
//
//    // Remember Me Checkbox.
//    $option_remember_me = \Drupal::state()->get('age_checker_option_remember_me');
//    if ($option_remember_me == 1) {
//      $form['remember_me'] = array(
//        '#type' => 'checkbox',
//        '#weight' => 5,
//        '#id' => 'age_checker_remember_me',
//        '#title' => \Drupal::state()->get('age_checker_' . $language_code . '_remember_me_text'),
//        '#default_value' => 0,
//        '#attributes' => array(
//          'tabindex' => '5',
//        ),
//      );
//    }
//
    // Submit button.
    $form['submit'] = array(
      '#type' => 'submit',
//      '#value' => \Drupal::state()->get('age_checker_' . $language_code . '_button_text'),
      '#value' => 'hello',
      '#weight' => 6,
//      '#attributes' => array(
//        'onclick' => "age_checker.verify();",
//        'tabindex' => '6',
//      ),
    );

//
//    $form['#attributes']['onsubmit'] = 'return false;';

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {


    $birthdate = $form_state->getValue('day');
//    $age_on_date = $form_state->getValue('age_on_date');
//
//    // Convert dates to timestamps.
//    $birthdate_timestamp = strtotime($birthdate);
//    $age_on_date_timestamp = strtotime($age_on_date);
//
//    // Check if birthdate greater than age on time.
    if (!empty($birthdate)) {
//      unset($form['calculated_age']['#markup']);
      // Show error if the date of birth is in future.
      $form_state->setErrorByName('day', $this->t('Age on date should not be lesser than date of birth.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

//  /**
//   * Implements hook_theme().
//   */
//  function age_calculator_theme() {
//    return array(
//      'age_calculator' => array(
//        'arguments' => array(
//          'date_information' => NULL,
//        ),
//      ),
//    );
//  }

  /**
   * Ajax callback for calculate age button.
   */
//  public function age_calculator_display_results(array &$form, FormStateInterface $form_state) {
//    return $form['calculated_age'];
//  }
}
