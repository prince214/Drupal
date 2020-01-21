<?php
/**
 * @file
 * Contains \Drupal\contact_us\Form\ResumeForm.
 */
namespace Drupal\contact_us\Form;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;


class ContactUsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_us';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'contact_us/contact_us_library';
    $form['#attributes']['class'][] = 'contactus--form';
    $form['#attributes']['id'][] = 'contact-us';
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
      '#attributes' => [
        'id' => [
            'contact_us_name'
          ]
        ]  
    );
    $form['phone'] = array(
      '#type' => 'textfield',
      '#title' => t('Phone:'),
      '#required' => TRUE,
      '#attributes' => [
        'id' => [
            'contact_us_phone'
          ]
        ]  
    ); 
    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Email:'),
      '#required' => TRUE,
      '#attributes' => [
        'id' => [
            'contact_us_email'
          ]
        ] 
    );
    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => t('message:'),
      '#required' => TRUE,
      '#attributes' => [
        'id' => [
            'contact_us_query'
          ]
        ] 
    );
   $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Send'),
      '#attributes' => [
        'class' => [
            'button',
            'hollow',
            'form--cta'
          ]
       ],
    ];  
    $form['#theme'] = 'contact_us_form';
    return $form;
  } 
 /**
   * Submitting the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRebuild();
  }
 
}