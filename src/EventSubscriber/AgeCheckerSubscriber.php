<?php

namespace Drupal\age_checker\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Component\Utility\Unicode;

/**
 * Provides an AgeCheckerSubscriber.
 */
class AgeCheckerSubscriber implements EventSubscriberInterface {

  /**
   * The Event to process.
   */
  public function ageCheckerSubscriberLoad() {
    $user = \Drupal::currentUser();
    $age_gate_cookie = isset($_COOKIE['age_checker']) ? $_COOKIE['age_checker'] : 0;
    $remember_me_cookie = isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : 0;

    if ($user->id() > 0) {
      setcookie('age_checker', 1, 0, $GLOBALS['base_path'], NULL, FALSE, TRUE);
    }
    else {
      if (($age_gate_cookie != 1) && ($remember_me_cookie != 1)) {
        if ($this->ageCheckerShowAgeGate()) {

        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('ageCheckerSubscriberLoad', 20);
    return $events;
  }

  /**
   * Function to control age checker display depending user and accesses.
   *
   * @return bool
   *   True if must be shown
   */
  public static function ageCheckerShowAgeGate() {
    $visibility = \Drupal::state()->get('age_checker_visibility', AGE_CHECKER_VISIBILITY_NOTLISTED);
    $pages = \Drupal::state()->get('age_checker_pages');
    $current_path = \Drupal::service('path.current')->getPath();

    // Convert path to lowercase.
    $pages = Unicode::strtolower($pages);
    if ($visibility < 2) {
      // Convert the Drupal path to lowercase.
      $path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($current_path);
      $path = Unicode::strtolower($path_alias);
      // Compare the lowercase internal and lowercase path alias (if any).
      $age_checker_visibility = \Drupal::service('path.matcher')->matchPath($path, $pages);

      if ($path != $current_path) {
        $age_checker_visibility = $age_checker_visibility || \Drupal::service('path.matcher')->matchPath($current_path, $pages);
      }

      $age_checker_visibility = !($visibility xor $age_checker_visibility);
    }

    if ($age_checker_visibility == 1) {
      return TRUE;
    }
    return FALSE;
  }

}
