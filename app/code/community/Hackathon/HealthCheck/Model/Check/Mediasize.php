<?php

class Hackathon_HealthCheck_Model_Check_Mediasize extends Hackathon_HealthCheck_Model_Check_Abstract
{

    protected function sizeFormat($size)
    {
        if($size<1024)
        {
            return $size." bytes";
        }
        else if($size<(1024*1024))
        {
            $size=round($size/1024,1);
            return $size." KB";
        }
        else if($size<(1024*1024*1024))
        {
            $size=round($size/(1024*1024),1);
            return $size." MB";
        }
        else
        {
            $size=round($size/(1024*1024*1024),1);
            return $size." GB";
        }
    }

    protected function getDirectorySize($path)
    {
        $totalsize = 0;
        $totalcount = 0;
        $dircount = 0;
        if ($handle = opendir ($path))
        {
            while (false !== ($file = readdir($handle)))
            {
                $nextpath = $path . '/' . $file;
                if ($file != '.' && $file != '..' && !is_link ($nextpath))
                {
                    if (is_dir ($nextpath))
                    {
                        $dircount++;
                        $result = $this->getDirectorySize($nextpath);
                        $totalsize += $result['size'];
                        $totalcount += $result['count'];
                        $dircount += $result['dircount'];
                    }
                    elseif (is_file ($nextpath))
                    {
                        $totalsize += filesize ($nextpath);
                        $totalcount++;
                    }
                }
            }
        }
        closedir ($handle);
        $total['size'] = $totalsize;
        $total['count'] = $totalcount;
        $total['dircount'] = $dircount;
        return $total;
    }


    public function _run() {

        /** @var Hackathon_Healthcheck_Model_Content_Renderer_Abstract $renderer */
        $renderer = $this->getContentRenderer();
        $helper = Mage::helper('hackathon_healthcheck');

        $header = array(
            $helper->__('Size'),
            $helper->__('Number Directories'),
            $helper->__('Number Files')
        );
        $this->getContentRenderer()->setHeaderRow($header);

        $path = Mage::getBaseDir() . "/media";
        $dirSize = $this->getDirectorySize($path);
        $row = array($this->sizeFormat($dirSize['size']), $dirSize['count'], $dirSize['dircount']);

        $renderer->addRow($row);

        return $this;
    }
}