<?php

// write log exception, delete log... - PDQuang
class DbLogRoute extends CDbLogRoute
{    
    public function processLogs($logs)
    {
        parent::processLogs($logs);
        
        $count=$this->getDbConnection()->createCommand('SELECT COUNT(*) FROM '.$this->logTableName)->queryScalar();
        if($count >= LOGGER_TABLE_MAX_RECORDS)
        {
            $query = "DELETE FROM $this->logTableName limit 200";
            $command = Yii::app()->db->createCommand($query);
            $command->execute();
        }
    }
}
?>
