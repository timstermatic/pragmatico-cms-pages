<?php
/**
 * Pages controller.
 *
 * @package       pragmaticocms
 */

class PagesController extends PagesAppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * allow display without being logged in
 */
	public function beforeFilter()
	{
        parent::beforeFilter();
		$this->Auth->allow(array('display'));
	}

/**
 * cms page list
 *
 * @param $parent int level
 */
  public function cms_index($parent = null)
  {
    $this->set('pages', $this->paginate(array('Page.current'=>1, 'Page.parent_id'=>$parent, 'deleted'=>0)));
  }

/**
 * cms create page
 *
 * @param $parent int level
 */
  public function cms_create($parent = null)
  {
    if($this->request->is('post')) {
      $this->request->data['Page']['current'] = 1;
      $this->request->data['Page']['position'] = 1000;
      if($this->Page->save($this->request->data)) {
        $this->Page->saveField('revision_of_page_id', $this->Page->id);
        $this->Session->setFlash(__('Page created'), 'flash_success');
        $this->redirect(array('action'=>'index', $this->request->data['Page']['parent_id']));
      }
    }
    $this->setTitle('Create a new page');
  }

/**
 * cms edit page
 *
 * @param $parent int level
 */
  public function cms_edit($id = null)
  {
    if($this->request->is('post')) {
      $this->request->data['Page']['current'] = 1;
      if($this->Page->save($this->request->data)) {

        $this->Page->updateAll(
          array('current'=>0),
          array('revision_of_page_id'=>$id)
        );

        $this->Page->saveField('revision_of_page_id', $id);
        $this->Session->setFlash(__('Page updated'), 'flash_success');
        $this->redirect(array('action'=>'index', $this->request->data['Page']['parent_id']));
      }
    } else {
      $this->request->data = $this->Page->_currentRevision($id);
    }

    $this->setTitle('Edit page');

  }

/**
 * delete a page (soft delete)
 *
 * @param int $id of original page
 * @param int $parent_id to return to
 */
  public function cms_delete($id=null, $parent_id=null)
  {
    $this->Page->deleteAll(array('Page.revision_of_page_id'=>$id));
    $this->Session->setFlash(__('Page deleted'), 'flash_success');
    $this->redirect(array('action'=>'index', $parent_id));
  }

/**
 * cms reorder pages function
 */
	public function cms_reorder() {
		$this->autoRender = false;
		foreach($this->request->query['sortable'] as $k=>$v) {
			$this->Page->id = end(explode('row_',$v));
			$this->Page->set('position',$k);
			$this->Page->save();
		}		
	}

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function display() {
	  $content = $this->Page->_findByUrl($this->here);
      $title_for_layout = $content['Page']['meta_title'];
      $meta_description = $content['Page']['meta_description'];
      $meta_keywords = $content['Page']['meta_keywords'];
      
      $this->set(compact('content', 'title_for_layout', 'meta_keywords', 'meta_description'));

    }
}
