<?php

namespace JivoWebHook;

class JivoHook
{
    public $event;
    private static $eventList = [
         'chat_accepted',
        'chat_assigned',
        'chat_finished',
        'chat_updated',
        'offline_message',
    ];

    /**
     * Read Json
     *
     * @return array|false
     */
    private function getWebHook()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function listen()
    {
        $data = $this->getWebHook();

        if (empty($data)) {
            return false;
        }

        if ($data['event_name'] == $this->event) {
            return $data;
        }
    }

    public function getEmailHook()
    {
        $data = $this->getWebHook();

        if (empty($data)) {
            return false;
        }

        if (array_key_exists('visitor', $data)) {
            if (array_key_exists('email', $data['visitor'])) {
                return $data['visitor']['email'];
            }
        }

        return false;
    }

    public function getEventList()
    {
        return $this::$eventList;
    }
}
