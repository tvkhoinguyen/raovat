<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailHelper {

    public static function sendMail($data) {
//        self::_setTestEmail($data, 'quocbao1087@gmail.com');
        $message = new YiiMailMessage($data['subject']);
        $message->setBody($data['message'], 'text/html');
        if (is_array($data['to'])) {
            foreach ($data['to'] as $t) {
                $message->addTo($t);
            }
        }
        else
            $message->addTo($data['to']);

        if (isset($data['cc']))
            $message->setCc($data['cc']);

        $message->from = $data['from'];
        $message->setFrom(array($data['from'] => Yii::app()->params['mailSenderName']));
        return Yii::app()->mail->send($message);
    }

    /*     * *
     * $emailTemplateId: Email template id in database
     * $param: supported param in template with array key=>value. Key is param {key} in template
     */

    public static function bindEmailContent($emailTemplateId, $param, $to, $cc = null) {
        $modelEmailTemplate = EmailTemplates::model()->findByPk($emailTemplateId);
        if (!empty($modelEmailTemplate)) {
            $message = $modelEmailTemplate->email_body;
            $subject = $modelEmailTemplate->email_subject;
            if (!empty($param)) {
                foreach ($param as $key => $value) {
                    $message = str_replace('{' . strtoupper($key) . '}', $value, $message);
                    $subject = str_replace('{' . strtoupper($key) . '}', $value, $subject);
                }
            }

            // Send a email to patient     
            $data = array(
                'subject' => $subject,
                'message' => $message,
                'to' => $to,
                'cc' => $cc,
                'from' => Yii::app()->params['autoEmail'],
            );
            self::sendMail($data);
        }
    }

}

?>
