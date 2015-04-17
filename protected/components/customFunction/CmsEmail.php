<?php
/**
 * Class for manipulating email
 */
class CmsEmail
{
    /**
     * @static send a email
     * @param array $data
     *      array('subject'=>?, 'params'=>array(), 'view'=>?, 'to'=>?, 'from'=>?)
     * @param bool $requireView if true, it will only send email if view is existed
     */
    public static function mail($data, $requireView = false)
    {
//        self::_setTestEmail($data, 'quocbao1087@gmail.com');
        $message = new YiiMailMessage($data['subject']);
        if(isset($data['view']))
        {
            if($requireView)
            {
                $path = YiiBase::getPathOfAlias(Yii::app()->mail->viewPath) . '/' . $data['view'] . '.php';
                if(!file_exists($path))
                {
                    return;
                }
            }
            $message->view = $data['view'];
        }
        elseif($requireView)
            return;
        $message->setBody($data['params'], 'text/html');


        if(is_array($data['to']))
        {
            foreach($data['to'] as $t)
            {
                $message->addTo($t);
            }
        }
        else
            $message->addTo($data['to']);
        $message->from = $data['from'];
//        $message->setFrom(array($data['from'] => Yii::app()->setting->getItem('title_all_mail')));
        $message->setFrom(array($data['from'] => Yii::app()->setting->getItem('mailSenderName')) );
        return Yii::app()->mail->send($message);
    }

    /**
     * @static send separate a mail to each email address
     * @param $data
     */
    public static function mailAll($data)
    {
        foreach($data as $d)
        {
            self::mail($d);
        }
    }
    /**
     * 
     * @static send a mail
     * @template

                $aSubject = array('{KEY_1}' =>'value1',
                    '{KEY_2}'=>'value2',
                    '{KEY_3}'=>'value3'
                );

                $aBody = array('{KEY_1}' =>'value1',
                    '{KEY_2}'=>'value2',
                    '{KEY_3}'=>'value3'
                );

     */
    
    /**
     * 
     * @param int $iEmailTemplateID
     * @param array $aSubject
     * @param array $aBody
     * @param array $sTo
     * @example  
     *          $aSubject = array('{KEY_1}' =>'value1',
                        '{KEY_2}'=>'value2',
                        '{KEY_3}'=>'value3'
                    );

                $aBody = array('{KEY_1}' =>'value1',
                        '{KEY_2}'=>'value2',
                        '{KEY_3}'=>'value3'
                    );
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function sendmail($iEmailTemplateID, $aSubject, $aBody, $sTo)
    {
        $modelEmailTemplate = EmailTemplates::model()->findByPk($iEmailTemplateID);

        $sSubject = $modelEmailTemplate->email_subject;        
		if(is_array($aSubject) && count($aSubject)>0)
        foreach($aSubject as $key => $value)
        {
            $sSubject = str_replace($key, $value, $sSubject);
        }

        $sBody = $modelEmailTemplate->email_body;
        if(is_array($aBody) && count($aBody)>0)
        foreach($aBody as $key => $value)
        {
            $sBody = str_replace($key, $value, $sBody);
        }

        $data = array(
            'subject'=>$sSubject,
//            'params'=>array(
//                'message'=>$sBody,
//            ),
            'message'=>$sBody,
            'view'=>'message',
            'to'=>$sTo,
            'from'=>Yii::app()->params['autoEmail'],
        );
        return EmailHelper::sendMail($data);
    }
    
    public static function viewEmail($iEmailTemplateID, $aSubject, $aBody, $sTo)
    {
        $modelEmailTemplate = EmailTemplates::model()->findByPk($iEmailTemplateID);
        $sSubject = $modelEmailTemplate->email_subject;        
		if(is_array($aSubject) && count($aSubject)>0)
        foreach($aSubject as $key => $value)
        {
            $sSubject = str_replace($key, $value, $sSubject);
        }

        $sBody = $modelEmailTemplate->email_body;
        if(is_array($aBody) && count($aBody)>0)
        foreach($aBody as $key => $value)
        {
            $sBody = str_replace($key, $value, $sBody);
        }
        
        $sTo = implode(';', $sTo);
        $data = array(
            'subject'=>$modelEmailTemplate->email_subject,
            'message'=>$sBody,
            'to'=>$sTo,
            'from'=>Yii::app()->params['autoEmail'],
        );
        return $data;
    }
    
    /**
     * 
     * @param int $iEmailTemplateID
     * @param array $aSubject
     * @param array $aBody
     * @param string $sTo
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 2013, bb 
     */
    public static function sendmailTranslate($iEmailTemplateID, $aSubject, $aBody, $sTo)
    {
        $modelEmailTemplate = new TranslateHelper('EmailTemplates', $iEmailTemplateID);
        
        $sSubject = $modelEmailTemplate->get('email_subject');
        if(is_array($aSubject))
        foreach($aSubject as $key => $value)
        {
            $sSubject = str_replace($key, $value, $sSubject);
        }

        $sBody = $modelEmailTemplate->get('email_body');
        if(is_array($aBody))        
        foreach($aBody as $key => $value)
        {
            $sBody = str_replace($key, $value, $sBody);
        }

        $data = array(
            'subject'=>$sSubject,
            'params'=>array(
                'message'=>$sBody,
            ),
            'view'=>'message',
            'to'=>$sTo,
            'from'=>Yii::app()->params['autoEmail'],
        );
       return CmsEmail::mail($data);
    }
    
    /**
     * All emails are sent to emailTest
     * @param array $data
     * @param string $emailTest
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 7/6/2013, bb 
     */
    private static function _setTestEmail(&$data, $emailTest)
    {
        if(is_array($data['to']))
        {
            foreach($data['to'] as $key=>$email)
            {
                  $data['to'][$key] = $emailTest;
            }
        }
        else{
            $data['to'] = $emailTest;            
        }
        
        if(isset($data['setCc']))
            $data['setCc'] = $emailTest; 
        
        /*
         * Begin Bcc
         */
        if(isset($data['setBcc']))
        {
            if(is_array($data['setBcc']))
            {
                foreach($data['setBcc'] as $key=>$email)
                {
                    $data['setBcc'][$key] = $emailTest;
                }
            }
            else
            {
                $data['setBcc'] = $emailTest;
            }
        }
    }
}
