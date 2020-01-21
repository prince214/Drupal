<?php 
/** 
 * @file 
 * Contains \Drupal\contact_us\Form\contact_us.
  */
namespace Drupal\contact_us\Form; 

use Drupal\Core\Form\ConfigFormBase; 
use Drupal\Core\Form\FormStateInterface;
 
class SettingsForm extends ConfigFormBase { 
  /** 
   * {@inheritdoc} 
   */

  public function getFormId() { 
    return 'contact_us_admin_settings'; 
  }
  /**
    * {@inheritdoc}
    */
 
  protected function getEditableConfigNames() { 
    return [ 
      'contact_us.settings', 
    ];
 
  }
   /**
    * {@inheritdoc}
    */
 
  public function buildForm(array $form, FormStateInterface $form_state) { 
    $form = parent::buildForm($form, $form_state); 
    $config = $this->config('contact_us.settings'); 
    $form['email'] = array( 
      '#type' => 'textarea', 
      '#title' => $this->t('Recipients'), 
      '#default_value' => $config->get('contact_us.email'), 
      '#required' => TRUE,
      '#description' => '<p>' . t("Example: 'webmaster@exampe.com' or 'sales@example.com,support@example.com'. To specify multiple recipients, separate each mail address with a comma.") . '</p>'
 
    );
     $form['msg'] = array( 
      '#type' => 'textarea', 
      '#title' => $this->t('Message'), 
      '#default_value' => $config->get('contact_us.msg'), 
      '#required' => FALSE,
      '#description' => '<p>' . t("The message to display to the user after submmission of this form. Leave blank for no message.") . '</p>'
 
    );
    return $form;
  }
   /**
    * {@inheritdoc}
    */ 
  public function submitForm(array &$form, FormStateInterface $form_state) { 
    $config = $this->config('contact_us.settings'); 
    $config->set('contact_us.email', $form_state->getValue('email')); 
    $config->set('contact_us.node_types', $form_state->getValue('node_types')); 
    $config->save(); 
    return parent::submitForm($form, $form_state);
   }
   
}
