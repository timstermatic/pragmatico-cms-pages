<?php
class Page extends AppModel {

/**
 * order pages by position
 */
  public $order = array('Page.position'=>'asc');


/**
 * sets current page
 *
 * @param int $id of page
 */
  public function _setCurrent($id='x') {
  
    // set all other versions to not current
  
    // set this page to current
    $this->id = $id;
    $this->saveField('current', 1);

  }

/**
 * get current revision of a page
 *
 * @param int $id of page
 * @return array page
 */
  public function _currentRevision($id = null)
  {
    return $this->find('first', array(
      'conditions'=>array(
        'Page.deleted'=>0,
        'Page.revision_of_page_id'=>$id,
        'Page.current'=>1
      )
    ));
  }

}
