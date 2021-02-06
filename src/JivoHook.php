<?php

namespace JivoWebHook;

class JivoHook
{
    /**
     * Unique event to receive
     */
    public $event;
    /**
     * List of events supported by Jivo
     */
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

    /**
     * Getting an array with the event value
     *
     * @return array|false
     */
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

    /**
     * Receiving a visitor's email
     *
     * @return false|string
     */
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

    /**
     * Get event list Jivo
     *
     * @return array
     */
    public function getEventList()
    {
        return $this::$eventList;
    }
}
