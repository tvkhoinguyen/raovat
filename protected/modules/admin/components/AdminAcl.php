<?php
class AdminAcl
{
    /**
     * return all authItem name, associated by controller name.
     * For instance:
     *      array(
     *          'ManageAdmin'=>array(
     *              'view',
     *              'update',
     *              'create',
     *              'delete'
     *          ),
     *      )
     * @return array
     */
    public static function getAllAclName()
    {
        
        $result = array();
        $auth = Yii::app()->authManager;
        $authItems = $auth->getAuthItems();
        foreach($authItems as $item)
        {
            $str = explode('_', $item->name);
            if(isset($result[$str[1]]))
            {
                $result[$str[1]] []= $str[0];
            }
            else
            {
                $result[$str[1]] = array($str[0]);
            }
        }
        return $result;
    }

    /**
     * @static Revoke all permissions from a user
     * @param $id The ID of user
     */
    public static function revokeAll($id)
    {
        $auth = Yii::app()->authManager;
        $authAssigned = $auth->getAuthAssignments($id);
        foreach($authAssigned as $key=>$value) {
            $auth->revoke($key, $id);
        }
    }

    /**
     * @static Assign permission to a user
     * @param $id The ID of user
     * @param $permissions The array of permissions
     */
    public static function assignAll($id, $permissions)
    {
        $auth = Yii::app()->authManager;
        foreach($permissions as $role=>$value) {
            if(intval($value)){
                $auth->assign($role, $id);
            }
        }
    }
}