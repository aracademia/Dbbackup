<?php
/**
 * Created by PhpStorm.
 * User: rafia
 * Date: 12/24/2014
 * Time: 10:35 PM
 */

namespace Aracademia\Dbbackup;

use Config;
use Illuminate\Filesystem\Filesystem;

class Dbbackup {

    /**
    * @var
    */
    private $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {

        $this->filesystem = $filesystem;
    }

    public function backup()
    {
        $this->DbBackupFolder();

        if($this->runBackup() == 0)
        {
            return true;
        }
        return false;
    }

    private function DbBackupFolder()
    {

        if(!$this->filesystem->isDirectory(Config::get('Dbbackup::DbBackupPath')))
        {
            return $this->filesystem->makeDirectory(Config::get('Dbbackup::DbBackupPath'));
        }
        return true;
    }

    private function runBackup()
    {

        $output = array();
        $return_var = NULL;

        $command = Config::get('Dbbackup::DbMysqlDumpPath')." --opt --host=".Config::get('Dbbackup::DbHost')." --user=".Config::get('Dbbackup::DbUser')." --password=".Config::get('Dbbackup::DbPass')." ".Config::get('Dbbackup::DbName')." > ".Config::get('Dbbackup::DbBackupPath')."/".Config::get('Dbbackup::DbName')."_".date('m_d_y_g-i-a').".sql";
        $run = exec($command, $output, $return_var);
        return $return_var;
    }

}