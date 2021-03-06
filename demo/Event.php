<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/10/31
 * Time: 11:37
 */

class Event
{
    public $id;
    public $name;
    public $start_date;
    public $end_date;
    public $deadline;
    public $attendee_limit;
    public $attendees = array();

    public function __construct($id, $name, $start_date, $end_date, $deadline, $attendee_limit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->deadline = $deadline;
        $this->attendee_limit = $attendee_limit;
    }

    public function reserve($user)
    {
        // 使用者報名
        $this->attendees[$user->id] = $user;
    }

    public function getAttendeeNumber()
    {
        return sizeof($this->attendees);
        return 123;
        echo 123;
    }

    public function unreserve($user)
    {
        unset($this->attendees[$user->id]);
    }
}