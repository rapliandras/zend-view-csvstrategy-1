<?php

/*
 * All rights reserved © 2016 Legow Hosting Kft.
 */

namespace LegoW\View\Model;

use Zend\View\Model\ViewModel;
/**
 * Description of CsvModel
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvModel extends ViewModel
{
    protected $__fileName = "csvmodel.csv";
    
    public function getFileName()
    {
        return $this->__fileName;
    }

    public function setFileName($fileName)
    {
        $this->__fileName = $fileName;
        return $this;
    }
   
}