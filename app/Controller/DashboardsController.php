<?php

App::uses('PracticeTestsController', 'Controller');
App::uses('analytics', 'GoogleAnalytics');
App::import('Vendor', 'analytics', array('file' => 'GoogleAnalytics' . DS . 'analytics.class.php'));
//Consider deleting GA
class DashboardsController extends PracticeTestsController {
    public $uses = array('PracticeTest', 'AclManagement.User');
    public $helpers = array('Text', 'Time');

    public function admin_index(){
        $this->set('title', __('Dashboard'));
        //$this->set('description', __('Manage Quiz'));

        $practiceTests = $this->PracticeTest->find('all', array('order'=>array('PracticeTest.created'=>'DESC'), 'limit'=>20));
        $this->set('practiceTests', $practiceTests);

        $FavouritePracticeTests = $this->PracticeTest->find('all', array('order'=>array('PracticeTest.avg'=>'DESC'), 'limit'=>10));
        $this->set('FavouritePracticeTests', $FavouritePracticeTests);

        $users = $this->User->find('all', array('order'=>array('User.created'=>'DESC'), 'limit'=>10));
        $this->set('users', $users);

        //google analytics
        if(Configure::read('GA.email') != '' && Configure::read('GA.password') != ''){
            try {

                // construct the class
                $oAnalytics = new analytics(Configure::read('GA.email'), Configure::read('GA.password'));
                // set it up to use caching
                $oAnalytics->useCache();
                //$oAnalytics->setProfileByName(Configure::read('GA.domain'));
                $oAnalytics->setProfileById(Configure::read('GA.profile_id'));
                // set the date range
                //$oAnalytics->setMonth(date('n'), date('Y'));
                $oAnalytics->setDateRange(date('Y-m-d', strtotime('-1 week')), date('Y-m-d'));
                //echo '<pre>';
                // print out visitors for given period
                //print_r($oAnalytics->getVisitors());
                // print out pageviews for given period
                //print_r($oAnalytics->getPageviews());
                // use dimensions and metrics for output
                // see: http://code.google.com/intl/nl/apis/analytics/docs/gdata/gdataReferenceDimensionsMetrics.html
                // print_r($oAnalytics->getData(array(   'dimensions' => 'ga:keyword',
                // 'metrics'    => 'ga:visits',
                // 'sort'       => 'ga:keyword')));
                //print_r($oAnalytics->getData(array('dimensions' => 'ga:visitorType','metrics'    => 'ga:newVisits')));
                $visits = $oAnalytics->getVisitors();
                $views = $oAnalytics->getPageviews();
                /* build tables */
                if (count($visits)) {
                    $visits = $this->array_filter_recursive($visits);
                    $views = $this->array_filter_recursive($views);
                    foreach ($visits as $day => $visit) {
                        $flot_datas_visits[] = '[' . $day . ',' . $visit . ']';
                        $flot_datas_views[] = '[' . $day . ',' . $views[$day] . ']';
                    }
                    $flot_data_visits = '[' . implode(',', $flot_datas_visits) . ']';
                    $flot_data_views = '[' . implode(',', $flot_datas_views) . ']';
                }
                $this->set(compact('flot_data_visits', 'flot_data_views'));
            } catch (Exception $e) {
    		//echo 'Caught exception: ' . $e->getMessage();
            }
        }
    }

    public function admin_toggle($id, $status, $field='published') {
        return parent::admin_toggle($id, $status, $field);
    }
}
?>
