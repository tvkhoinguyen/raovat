<?php
/*
 * bb
 */
class MailChimp{

    // Your API Key: http://admin.mailchimp.com/account/api/
    public $apiKey = 'dee7782ff2e00539c28762f5d7ae793c-us6' ;
    
    // Your List Unique ID: http://admin.mailchimp.com/lists/ (Click "settings")
    public $listId = '6935518728';
    protected $api;
  
    public function __construct() 
    {
        if(Yii::app()->params['mailchimp_on'] == 'no')
             $this->apiKey = 'notuse';
        else{
            $this->apiKey = Yii::app()->params['mailchimp_api_key'];
            $this->listId = Yii::app()->params['mailchimp_list_id'];
        }
        if (!$this->api) {
          Yii::import('ext.MailChimp.lib.MCAPI', true);     
          $this->api = new MCAPI($this->apiKey);
        }
        return $this->api;
    }
    
    /**
     * 
     * @param type $email
     * @param type $merge_vars
     * @return int
     * @example $merge_vars = array('FNAME'=>'first', 'LNAME'=>'last', 
                        'GROUPINGS'=>array(
                            array('name'=>'patients', 'groups'=>'patients'),
                        )
                    );
     */
    public function addSubscriber($email, $merge_vars = NULL)
    {           
        $retval = $this->api->listSubscribe( $this->listId , $email, $merge_vars );
        $result = array();
        $result['success'] = 0;
        $result['msg'] = '';
        if ($this->api->errorCode)
        {
                $result['msg'] .= "Unable to load listSubscribe()!\n";
                $result['msg'] .= "\tCode=".$this->api->errorCode."\n";
                $result['msg'] .= "\tMsg=".$this->api->errorMessage."\n";
        } else {
            $result['msg'] .= "Subscribed - ".$email;
            $result['success'] = 1;
        }    
        return $result;
    }
    /**
     * 
     * @param type $email
     * @return int
     * @author bb
     */
    public function removeSubscriber($email)
    {
        $retval = $this->api->listUnsubscribe( $this->listId,$email);
        $result = array();
        $result['success'] = 0;
        $result['msg'] = '';
        if ($this->api->errorCode){
                $result['msg'] .= "Unable to load listUnsubscribe()!\n";
                $result['msg'] .= "\tCode=".$this->api->errorCode."\n";
                $result['msg'] .= "\tMsg=".$this->api->errorMessage."\n";
        } else {
            $result['msg'] .= "Returned: ".$retval."\n";
            $result['success'] = 1;
        }
        return $result;
    }
    /**
     * 
     * @param type $email
     * @param type $merge_vars
     * @example $merge_vars = array('FNAME'=>'first', 'LNAME'=>'last', 
                        'GROUPINGS'=>array(
                            array('name'=>'patients', 'groups'=>'patients'),
                        )
                    );
     * @author bb
     */
    public function updateSubscriber($email, $merge_vars)
    {
        $retval = $this->api->listUpdateMember($this->listId, $email, $merge_vars, 'html', true);
        $result = array();
        $result['success'] = 0;
        $result['msg'] = '';
        if ($this->api->errorCode){
                $result['msg'] .= "Unable to update member info!\n";
                $result['msg'] .= "\tCode=".$this->api->errorCode."\n";
                $result['msg'] .= "\tMsg=".$this->api->errorMessage."\n";
        } else {    
                $result['msg'] .= "Returned: ".$retval."\n";
                $result['success'] = 1;
        }
        return $result;
    }
}
