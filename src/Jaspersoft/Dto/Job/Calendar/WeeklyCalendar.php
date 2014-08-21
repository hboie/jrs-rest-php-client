<?php


namespace Jaspersoft\Dto\Job\Calendar;


class WeeklyCalendar extends FlaggedCalendar {

    const WEEKLY_FILL_INDEX = 6;

    public function addExcludeDay($day) {
        if (!is_int($day) || $day < 0 || $day > 6) {
            throw new \DomainException("You must describe days of the week using integers between 0 and 6");
        }
        else {
            parent::addExcludeDay($day);
        }
    }

    public function removeExcludeDay($day) {
        if (!is_int($day) || $day < 0 || $day > 6) {
            throw new \DomainException("You must describe days of the week using integers between 0 and 6");
        }
        else {
            parent::removeExcludeDay($day);
        }
    }

    protected function generateFlagArray()
    {
        $flagArray = array_fill(0, WeeklyCalendar::WEEKLY_FILL_INDEX, false);
        foreach ($this->excludeDaysFlags as $key) {
            $flagArray[$key] = true;
        }
        return $flagArray;
    }

    public function jsonSerialize()
    {
        $pre = parent::jsonSerialize();
        if (!empty($pre->excludeDaysFlags)) {
            $pre->excludeDaysFlags = array("excludeDayFlag" => $this->generateFlagArray());
        }
        return $pre;
    }

} 