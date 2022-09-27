<?php 

namespace Drupal\devjobs_homepage\Controller;

use Drupal\Core\Controller\ControllerBase;
// use Drupal\Core\Render\Element\File;
use \Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class HomePage extends ControllerBase {

  public function view() {
    $title = \Drupal::request()->request->get('search');
    $location = \Drupal::request()->request->get('location');
    $checkbox = \Drupal::request()->request->get('check');
    // var_dump($title);
    // var_dump($location);
    // var_dump($checkbox);
    // if($title === null){
    //   echo "title is null";
    // }
    

    // $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $nids = \Drupal::entityQuery('node')
      ->condition('type','devjob')
      ->condition('title.value', $title, 'CONTAINS')
      ->condition('field_country', $location, 'CONTAINS')
      ->condition('field_employment', $checkbox, 'CONTAINS')
      ->execute();
      // var_dump(count($nids));
    
    // $nids = $node_storage->getQuery()
    //   ->condition('status', 1)
    //   ->condition('type', 'devjob')
    //   ->execute();




      $jobs = [];
      foreach($nids as $nid){
        $node = Node::load($nid);

        $fid = $node->field_logo->getValue()[0]['target_id'];
      $file = File::load($fid);
      $image_uri = $file->getFileUri();
      $style = ImageStyle::load('thumbnail');
      $uri = $style->buildUri($image_uri);
      $url = $style->buildUrl($image_uri);

        $jobs[$nid] = [
          'title' => $node->getTitle(),
          'logo' => $url,
          'date' => $node->field_employment->getValue()[0]['value'],
          'company' => $node->field_company->getValue()[0]['value'],
          'country' => $node->field_country->getValue()[0]['value'],
          'nid' => $nid,
        ];
      }
    return [
      '#theme' => 'home-page',
      '#jobs' => $jobs,
    ];
  }
}

