<?php
/**
 * @file
 * Contains \Drupal\contact_us\Plugin\Block.
 */
namespace Drupal\contact_us\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
/**
 * Provides a 'contact_us' block.
 *
 * @Block(
 *   id = "contact_us_block",
 *   admin_label = @Translation("Contact Us Block"),
 *   category = @Translation("Contact Us Form")
 * )
 */
class ContactUsBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\contact_us\Form\ContactUsForm');
    return $form;
   }
}