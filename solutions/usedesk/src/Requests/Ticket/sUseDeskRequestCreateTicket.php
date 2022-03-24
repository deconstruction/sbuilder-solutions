<?php

/**
 * Класс создает тикет для API канала.
 *
 * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%A1%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C%D1%82%D0%B8%D0%BA%D0%B5%D1%82
 */
class sUseDeskRequestCreateTicket extends sUseDeskRequest
{
    /**
     * @var array
     */
    protected $fields = array();

    protected function preparePush()
    {
        $this->setFieldId(implode(';', array_keys($this->fields)));
        $this->setFieldValue(implode(';', $this->fields));
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setSubject($value)
    {
        return $this->setBody('subject', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setMessage($value)
    {
        return $this->setBody('message', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setClientName($value)
    {
        $this->setBody('client_name', $value);

        return $this;
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setClientEmail($value)
    {
        return $this->setBody('client_email', $value);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setClientPhone($value)
    {
        return $this->setBody('client_phone', $value);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setClientId($value = 'new_client')
    {
        return $this->setBody('client_id', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setClientCountry($value)
    {
        return $this->setBody('client_country', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setClientCity($value)
    {
        return $this->setBody('client_city', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setClientAddress($value)
    {
        return $this->setBody('client_address', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setCompanyName($value)
    {
        return $this->setBody('company_name', $value);
    }

    /**
     * @return self
     */
    public function createPrivateComment()
    {
        return $this->setBody('private_comment', true);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setAdditionalId($value)
    {
        return $this->setBody('additional_id', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setType($value)
    {
        $types = array(
            'question',
            'task',
            'problem',
            'incident',
        );
        $this->checkValue($types, $value);

        return $this->setBody('type', $value);
    }

    /**
     * @return self
     */
    public function setTypeQuestion()
    {
        return $this->setType('question');
    }

    /**
     * @return self
     */
    public function setTypeTask()
    {
        return $this->setType('task');
    }

    /**
     * @return self
     */
    public function setTypeProblem()
    {
        return $this->setType('problem');
    }

    /**
     * @return self
     */
    public function setTypeIncident()
    {
        return $this->setType('incident');
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setPriority($value)
    {
        $types = array(
            'low',
            'medium',
            'urgent',
            'extreme',
        );
        $this->checkValue($types, $value);

        return $this->setBody('priority', $value);
    }

    /**
     * @return self
     */
    public function setPriorityLow()
    {
        return $this->setPriority('low');
    }

    /**
     * @return self
     */
    public function setPriorityMedium()
    {
        return $this->setPriority('medium');
    }

    /**
     * @return self
     */
    public function setPriorityUrgent()
    {
        return $this->setPriority('urgent');
    }

    /**
     * @return self
     */
    public function setPriorityExtreme()
    {
        return $this->setBody('priority', 'extreme');
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setStatus($value)
    {
        $value = (int) $value;

        $this->checkValue(range(1, 10), $value);

        return $this->setBody('status', $value);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setTags($value)
    {
        return $this->setBody('tag', $value);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setAssigneeId($value)
    {
        return $this->setBody('assignee_id', $value);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setGroupId($value)
    {
        return $this->setBody('group_id', $value);
    }

    /**
     * @param string $value
     *
     * @return void
     */
    private function setFieldId($value)
    {
        $this->setBody('field_id', $value);
    }

    /**
     * @param string $value
     *
     * @return void
     */
    private function setFieldValue($value)
    {
        $this->setBody('field_value', $value);
    }

    /**
     * @param int    $key
     * @param scalar $value
     *
     * @return self
     */
    public function addField($key, $value)
    {
        $this->fields[$key] = $value;

        return $this;
    }

    /**
     * @param id $value
     *
     * @return self
     */
    public function setChannelId($value)
    {
        return $this->setBody('channel_id', $value);
    }

    /**
     * @param array $value
     *
     * @return self
     */
    public function setFiles($value)
    {
        return $this->setBody('files', $value);
    }

    /**
     * @param string $value
     * @param int    $id
     *
     * @return self
     */
    public function setFrom($value, $id = null)
    {
        $values = array('user', 'client', 'trigger');
        $this->checkValue($values, $value);
        if($id) {
            $this->setBody("{$value}_id", $id);
        }

        return $this->setBody('from', $value);
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setFromUser($id)
    {
        return $this->setFrom('from', $id);
    }

    /**
     * @return self
     */
    public function setFromClient()
    {
        return $this->setFrom('client');
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setFromTrigger($id)
    {
        return $this->setFrom('from', $id);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setUserId($value)
    {
        return $this->setBody('user_id', $value);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setTriggerId($value)
    {
        return $this->setBody('trigger_id', $value);
    }

    /**
     * @return self
     */
    public function setNewAddress()
    {
        return $this->setBody('new_address', true);
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setPhoneType($value)
    {
        $values = array(
            'home',
            'mobile',
            'stationary',
            'fax',
            'other',
        );
        $this->checkValue($values, $value);

        return $this->setBody('phone_type', $value);
    }

    /**
     * @return self
     */
    public function setPhoneTypeHome()
    {
        return $this->setPhoneType('phone');
    }

    /**
     * @return self
     */
    public function setPhoneTypeMobile()
    {
        return $this->setPhoneType('mobile');
    }

    /**
     * @return self
     */
    public function setPhoneTypeStationary()
    {
        return $this->setPhoneType('stationary');
    }

    /**
     * @return self
     */
    public function setPhoneTypeFax()
    {
        return $this->setPhoneType('fax');
    }

    /**
     * @return self
     */
    public function setPhoneTypeOther()
    {
        return $this->setPhoneType('other');
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function addFile($value)
    {
        $file  = new CURLFile($value);
        $files = $this->getFromBody('files');
        if(is_array($files)) {
            $files[] = $file;
        } else {
            $files = array($file);
        }

        return $this->setBody('files', $files);
    }
}