<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 *
 * User:    gra
 * Date:    09/12/2015
 * Time:    00:33
 * Project: PartFire-CommonBundle
 * File:    TimeAgo.php
 **/

namespace PartFire\CommonBundle\Services\DateTime;

use Datetime;

class TimeAgo
{

    protected $translator;

    public function __construct()
    {

    }

    public function getTimeNow()
    {
        return new \Datetime();
    }

    public function getTimeFrom(Datetime $datetime)
    {
        return $this->formatDiff($datetime, new Datetime());
    }

    /**
     * Returns a formatted diff for the given from and to datetimes
     *
     * @param  Datetime $from
     * @param  Datetime $to
     *
     * @return string
     */
    public function formatDiff(Datetime $from, Datetime $to)
    {
        static $units = array(
            'y' => 'year',
            'm' => 'month',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second'
        );

        $diff = $to->diff($from);

        foreach ($units as $attribute => $unit) {
            $count = $diff->$attribute;
            if (0 !== $count) {
                return $this->doGetDiffMessage($count, $diff->invert, $unit);
            }
        }

        return $this->getEmptyDiffMessage();
    }

    /**
     * Returns the diff message for the specified count and unit
     *
     * @param  integer $count  The diff count
     * @param  boolean $invert Whether to invert the count
     * @param  integer $unit   The unit must be either year, month, day, hour,
     *                         minute or second
     *
     * @return string
     */
    public function getDiffMessage($count, $invert, $unit)
    {
        if (0 === $count) {
            throw new \InvalidArgumentException('The count must not be null.');
        }

        $unit = strtolower($unit);

        if (!in_array($unit, array('year', 'month', 'day', 'hour', 'minute', 'second'))) {
            throw new \InvalidArgumentException(sprintf('The unit \'%s\' is not supported.', $unit));
        }

        return $this->doGetDiffMessage($count, $invert, $unit);
    }

    protected function doGetDiffMessage($count, $invert, $unit)
    {
        $id = sprintf('diff.%s.%s', $invert ? 'in' : 'ago', $unit);

        return $this->getENMessages($id, $count);
        //return $id;
    }

    /**
     * Returns the message for an empty diff
     *
     * @return string
     */
    public function getEmptyDiffMessage()
    {
        return ""; //$this->translator->trans('diff.empty', array(), 'time');
    }

    private function getENMessages($id, $count)
    {
        $timeReturn = "";

        if ($id == "diff.ago.year") {
            $timeReturn = $this->ago("year", $count);
        }
        if ($id == "diff.ago.month") {
            $timeReturn = $this->ago("month", $count);
        }
        if ($id == "diff.ago.day") {
            $timeReturn = $this->ago("day", $count);
        }
        if ($id == "diff.ago.hour") {
            $timeReturn = $this->ago("hour", $count);
        }
        if ($id == "diff.ago.minute") {
            $timeReturn = $this->ago("minute", $count);
        }
        if ($id == "diff.ago.second") {
            $timeReturn = $this->ago("second", $count);
        }
        if ($id == "diff.empty") {
            $timeReturn = "now";
        }
        if ($id == "diff.in.year") {
            $timeReturn = $this->in("year", $count);
        }
        if ($id == "diff.in.month") {
            $timeReturn = $this->in("month", $count);
        }
        if ($id == "diff.in.day") {
            $timeReturn = $this->in("day", $count);
        }
        if ($id == "diff.in.hour") {
            $timeReturn = $this->in("hour", $count);
        }
        if ($id == "diff.in.minute") {
            $timeReturn = $this->in("minute", $count);
        }
        if ($id == "diff.in.second") {
            $timeReturn = $this->in("second", $count);
        }

        return $timeReturn;
    }

    private function ago($text, $count)
    {
        return $this->plural($text, $count) . " ago";
    }

    private function in($text, $count)
    {
        return $this->plural($text, $count);
    }


    private function plural($text, $count)
    {
        $endText = $text;
        if($count != 1) {
          $endText = $text . "s";
        }
        return $count . " " . $endText;
    }
}
