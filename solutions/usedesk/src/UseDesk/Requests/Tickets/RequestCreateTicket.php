<?php

namespace UseDesk\Requests\Tickets;

use UseDesk\Requests\Request;

/**
 * Класс создает тикет для API канала.
 *
 * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%A1%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C%D1%82%D0%B8%D0%BA%D0%B5%D1%82
 */
class RequestCreateTicket extends Request
{
    /**
     * @var array
     */
    protected $fields = array();

    /**
     * @var int
     */
    protected $countFiles = 0;

    protected function preparePush()
    {
        $this->setFieldId(implode(';', array_keys($this->fields)));
        $this->setFieldValue(implode(';', $this->fields));
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setSubject($value)
    {
        return $this->setBody('subject', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
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
     * @return $this
     */
    public function setClientEmail($value)
    {
        return $this->setBody('client_email', $value);
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setClientPhone($value)
    {
        return $this->setBody('client_phone', $value);
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setClientId($value = 'new_client')
    {
        return $this->setBody('client_id', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setClientCountry($value)
    {
        return $this->setBody('client_country', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setClientCity($value)
    {
        return $this->setBody('client_city', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setClientAddress($value)
    {
        return $this->setBody('client_address', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCompanyName($value)
    {
        return $this->setBody('company_name', $value);
    }

    /**
     * @return $this
     */
    public function createPrivateComment()
    {
        return $this->setBody('private_comment', true);
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setAdditionalId($value)
    {
        return $this->setBody('additional_id', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
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
     * @return $this
     */
    public function setTypeQuestion()
    {
        return $this->setType('question');
    }

    /**
     * @return $this
     */
    public function setTypeTask()
    {
        return $this->setType('task');
    }

    /**
     * @return $this
     */
    public function setTypeProblem()
    {
        return $this->setType('problem');
    }

    /**
     * @return $this
     */
    public function setTypeIncident()
    {
        return $this->setType('incident');
    }

    /**
     * @param string $value
     *
     * @return $this
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
     * @return $this
     */
    public function setPriorityLow()
    {
        return $this->setPriority('low');
    }

    /**
     * @return $this
     */
    public function setPriorityMedium()
    {
        return $this->setPriority('medium');
    }

    /**
     * @return $this
     */
    public function setPriorityUrgent()
    {
        return $this->setPriority('urgent');
    }

    /**
     * @return $this
     */
    public function setPriorityExtreme()
    {
        return $this->setBody('priority', 'extreme');
    }

    /**
     * @param int $value
     *
     * @return $this
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
     * @return $this
     */
    public function setTags($value)
    {
        return $this->setBody('tag', $value);
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setAssigneeId($value)
    {
        return $this->setBody('assignee_id', $value);
    }

    /**
     * @param int $value
     *
     * @return $this
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
     * @return $this
     */
    public function addField($key, $value)
    {
        $this->fields[$key] = $value;

        return $this;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setChannelId($value)
    {
        return $this->setBody('channel_id', $value);
    }

    /**
     * @param array $value
     *
     * @return $this
     */
    public function setFiles($value)
    {
        return $this->setBody('files', $value);
    }

    /**
     * @param string $value
     * @param int    $id
     *
     * @return $this
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
     * @return $this
     */
    public function setFromUser($id)
    {
        return $this->setFrom('from', $id);
    }

    /**
     * @return $this
     */
    public function setFromClient()
    {
        return $this->setFrom('client');
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setFromTrigger($id)
    {
        return $this->setFrom('from', $id);
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setUserId($value)
    {
        return $this->setBody('user_id', $value);
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setTriggerId($value)
    {
        return $this->setBody('trigger_id', $value);
    }

    /**
     * @return $this
     */
    public function setNewAddress()
    {
        return $this->setBody('new_address', true);
    }

    /**
     * @param string $value
     *
     * @return $this
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
     * @return $this
     */
    public function setPhoneTypeHome()
    {
        return $this->setPhoneType('phone');
    }

    /**
     * @return $this
     */
    public function setPhoneTypeMobile()
    {
        return $this->setPhoneType('mobile');
    }

    /**
     * @return $this
     */
    public function setPhoneTypeStationary()
    {
        return $this->setPhoneType('stationary');
    }

    /**
     * @return $this
     */
    public function setPhoneTypeFax()
    {
        return $this->setPhoneType('fax');
    }

    /**
     * @return $this
     */
    public function setPhoneTypeOther()
    {
        return $this->setPhoneType('other');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function addFile($value)
    {
        if(!is_string($value)) {
            return $this;
        }

        $field = "files[$this->countFiles]";
        ++$this->countFiles;

        return $this->setBody($field, new \CURLFile($value));
    }
}