<?php

namespace Drupal\dataconnection\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayData.
 *
 * @package Drupal\dataconnection\Controller
 */
class DisplayData extends ControllerBase {


  

  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {
    /**return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: display with parameter(s): $name'),
    ];*/

    //create table header
    $header_table = array(
     'id'=>    t('SrNo'),
      'name' => t('Name'),
        'mobilenumber' => t('MobileNumber'),
        'email'=>t('Email'),
        'gender' => t('Gender'),
        'country' => t('Country'),
        'opt' => t('operations'),
        'opt1' => t('operations'),
    );

//select records from table
    $query = \Drupal::database()->select('subscribers', 'm');
      $query->fields('m', ['id','name','mobilenumber','email','gender','country']);
      $results = $query->execute()->fetchAll();
        $rows=array();
    foreach($results as $data){
        $delete = Url::fromUserInput('/dataconnection/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/dataconnection/form/subscribers?num='.$data->id);

      //print the data from table
             $rows[] = array(
            'id' =>$data->id,
                'name' => $data->name,
                'mobilenumber' => $data->mobilenumber,
                'email' => $data->email,
                //'age' => $data->age,
                'gender' => $data->gender,
                //'website' => $data->website,
                'country' => $data->country,

                 \Drupal::l('Delete', $delete),
                 \Drupal::l('Edit', $edit),
            );

    }
    //display data in site
    $form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No users found'),
        ];
//        echo '<pre>';print_r($form['table']);exit;
        return $form;

  }

}



