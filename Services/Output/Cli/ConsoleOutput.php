<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    08/12/16
 * Time:    10:36
 * Project: PartFireCommon
 * File:    ConsoleOutput.php
 *
 **/
namespace PartFire\CommonBundle\Services\Output\Cli;

use PartFire\CommonBundle\Services\Output\CommonOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleOutput implements CommonOutputInterface
{
    private $output;
    private $log;

    public function __construct()
    {
        $this->resetLog();
    }

    public function setOutputer(OutputInterface $outputer)
    {
        $this->output       = $outputer;
    }

    public function info($string)
    {
        $this->output->writeln('<info>' . $string . '</info>');
        $this->writeToLog($string);
    }

    public function infoid($string)
    {
        $this->output->writeln('<info>    ' . $string . '</info>');
        $this->writeToLog($string);
    }

    public function comment($string)
    {
        $this->output->writeln('<comment>' . $string . '</comment>');
        $this->writeToLog($string);
    }

    public function error($string)
    {
        $this->output->writeln('<error>' . $string . '</error>');
        $this->writeToLog($string);
    }

    public function highlight($string)
    {
        $this->output->writeln('<fg=blue;options=bold>' .$string.'</fg=blue;options=bold>');
        $this->writeToLog($string);
    }

    public function highlightid($string)
    {
        $this->output->writeln('<fg=blue;options=bold>    ' .$string.'</fg=blue;options=bold>');
        $this->writeToLog($string);
    }

    public function getLogArray()
    {
        $log        = $this->log;
        $this->resetLog();
        return $log;
    }

    public function getLogString()
    {
        return implode("\n", $this->getLogArray());
    }

    private function writeToLog($string)
    {
        $this->log[] = $string;
    }

    private function resetLog()
    {
        $this->log = [];
    }

}