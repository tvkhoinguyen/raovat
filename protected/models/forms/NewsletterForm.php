<?php

class NewsletterForm extends CFormModel
{
    public $subject;
    public $content;
    public $send_time;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('subject, content, send_time', 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'subject'=>'Subject',
            'content'=>'Content',
        );
    }
}
