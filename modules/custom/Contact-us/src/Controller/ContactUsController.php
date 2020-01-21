<?php
namespace Drupal\contact_us\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class ContactUsController.
 *
 * @package Drupal\contact_us\Controller
 */
class ContactUsController extends ControllerBase {
  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {

    //create table header
    $header_table = array(
     'id'=>    t('S no'),
      'name' => t('Name'),
      'phone'=>t('Phone'),
      'email'=>t('Email'),
      'message' => t('Message'),
      'salesperson_contact' => t('Salesperson Contact'),
       /* 'opt' => t('operations'),
        'opt1' => t('operations'),*/
    );
//select records from table
    $query = \Drupal::database()->select('contact_us', 'm');
      $query->fields('m', ['id','name','phone', 'email' ,'message', 'salesperson_contact']);
      $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(10);
      $results = $pager->execute()->fetchAll();
        $rows=array();
     $count = 1;   
    foreach($results as $data){
       /* $delete = Url::fromUserInput('/ask-expert/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/ask-expert/form/mydata?num='.$data->id);*/
      //print the data from table
             $rows[] = array(
                'id' =>$count,
                'name' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'message' => $data->message,
                'salesperson_contact' => ($data->salesperson_contact == '1') ? 'Yes' : 'No',
               /*  \Drupal::l('Delete', $delete),
                 \Drupal::l('Edit', $edit),*/
            );
             $count++;
}
    //display data in site
    $form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No record found'),
        ];
    $form['pager'] = array(
      '#type' => 'pager'
      );    
        return $form;
}
  public function addQuery(){
    $name = \Drupal::request()->request->get('name');
    $phone = \Drupal::request()->request->get('phone');
    $email = \Drupal::request()->request->get('email');
    $message = \Drupal::request()->request->get('message');
    $salesperson_contact = \Drupal::request()->request->get('salesperson_contact');
    if(!empty($name) && !empty($email) && !empty($message)){
       $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
       $uid = $user->get('uid')->value;
       $field  = array(
        'uid' => $uid,
        'name'   =>  $name,
        'phone' =>  $phone,
        'email' =>  $email,
        'message' => $message,
        'salesperson_contact' => $salesperson_contact,
          );
       $query = \Drupal::database();
           $query ->insert('contact_us')
               ->fields($field)
               ->execute();
       $message = t("Succesfully Saved.");        
       echo json_encode(array("result" => "done", "message" => $message)); die;
    }else{
        $message = t("Bad Request."); 
        echo json_encode(array("result" => "error", "message" => $message)); die;
    }
 }
}