<?php
/**
 * @file
 * Contains \Drupal\hello_world\Form\HelloForm.
 */
namespace Drupal\hello_world\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
 
class HelloForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hello_form';
  }
 
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['first_name'] = array(
      '#type' => 'textfield',
      '#title' => t('First Name:'),
      '#pattern' => '[A-Za-z]+',
      '#required' => TRUE,
    );
    $form['last_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Last Name:'),
      '#pattern' => '[A-Za-z]+',
      '#required' => TRUE,
    );
    $form['email_address'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email:'),
      '#pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$',
      '#required' => TRUE,
    );
 
    $form['pincode'] = array(
      '#type' => 'textfield',
      '#title' => t('Pincode:'),
      '#size' => 6,
      '#pattern' => '[0-9]{6}',
      '#required' => TRUE,
    );
 
    $form['employee_role'] = array (
      '#type' => 'select',
      '#title' => ('Employee Role'),
      '#options' => array(
        'manager' => t('Manager'),
        'executive_manager' => t('Executive  Manager'),
        'fresher' => t('Fresher'),
        'ceo' => t('CEO'),
        'team_lead' => t('Team Lead')
      ),
    );
 
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $conn = Database::getConnection();

      $conn->insert('employee')->fields(
      array(
        'first_name' => $form_state->getValue('first_name'),
        'last_name' => $form_state->getValue('last_name'),
        'email' => $form_state->getValue('email_address'),
        'pincode' => $form_state->getValue('pincode'),
        'role' => $form_state->getValue('employee_role'),
      )
    )->execute();
    $url = Url::fromRoute('hello.thankyou');
    $form_state->setRedirectUrl($url);
   }
 
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //$email = $form_state->getValue('email_address');
 
  }
}