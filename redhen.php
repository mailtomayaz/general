<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Drupal\Core\Form\FormStateInterface;
//use \Drupal\node\Entity\Node;
//use \Drupal\file\Entity\File;
//use Drupal\redhen_contact\Entity\Contact;
//use Drupal\Core\Form\FormState;

function webform_redhen_form_alter(&$form, FormStateInterface $form_state, $form_id) {
   
  if ($form_id == 'webform_submission_form_one_form') {
    $form['actions']['submit']['#value'] = t('Submit');
    $form['actions']['submit']['#submit'][] = 'webform_redhen_checkdata';
  }
}

function webform_redhen_checkdata(&$form, FormStateInterface $form_state){
    
//$entity_manager = \Drupal::entityManager();
//$users = $entity_manager->getStorage('redhen_contact')->loadMultiple(false);
//kint($users);
//die('tst');
$data = entity_load_multiple('redhen_contact');
 //kint($data->toArray());
foreach($data as $val){}
//    $arrEmail= $val->email->getValue('email');
//   kint($arrEmail);
//   // kint($val->email->getValue());
//   echo $arrEmail['value'];
//} 
//echo $data->get('field_name')->getValue();
//die('tst');
//get webform values
    $formValues = $form_state->getValues();
    $name = $formValues['name'];
    $email = $formValues['email'];
    $phone = $formValues['phone'];
    $values = array(
      'first_name' => $name,
      'last_name' => '',
      'email' => $email,
      'roles' => array(),
      'field_phone' => $phone,
      'field_name' => $name,
      'status' => 1,
      'type' => "customer"
);  
$account = entity_create('redhen_contact', $values);
$account->save();   


    $values = $form_state->getValues();
 // kint($values);

  //query to insert 
  $query = \Drupal::database()->insert('redhen_contact');
  $query->fields(['type',  'email','uuid','langcode','status']);
  $query->values(['customer',  $form_state->getValue('email'),'8ea0e2fe-2c04-485b-841f-e662f65cfl6fl1bkj11k','en',1]);
  $query->execute();
  
  /**/
  $query = \Drupal::database()->insert('redhen_contact_revision');
  $query->fields(['id',  'email','langcode','status']);
  $query->values(['8',  $form_state->getValue('email'),'en',1]);
  $query->execute();
    
  echo "Form submitted";
    exit();

}
//function entity_load_multiple($entity_type, array $ids = NULL, $reset = FALSE) {
//  $controller = \Drupal::entityManager()->getStorage($entity_type);
//  if ($reset) {
//    $controller->resetCache($ids);
//  }
//  return $controller->loadMultiple($ids);
//}