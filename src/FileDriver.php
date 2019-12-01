<?php

namespace HayriCan\IpChecker;

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use HayriCan\IpChecker\Contracts\IpCheckerInterface;

class FileDriver implements IpCheckerInterface
{

    /**
     * file path to save the logs
     */
    protected $path;
    protected $ipList = [];

    public function __construct()
    {
        $this->path = storage_path(config('ipchecker.filepath'));
    }

    /**
     * @return array
     */
    public function getIpArray()
    {
        if (is_dir($this->path)) {
            $files = scandir($this->path);

            foreach ($files as $file) {
                if (!is_dir($file)) {
                    $lines = file($this->path.DIRECTORY_SEPARATOR.$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($lines as $line) {
                        $contentarr = explode(";", $line);
                        array_push($this->ipList, $contentarr[2]);
                    }
                }
            }
            $ipList = $this->ipList ?? [];

            return $ipList;
        }

        return [];
    }

    /**
     * @return array|\Illuminate\Support\Collection|mixed
     */
    public function getIpList()
    {
        if (is_dir($this->path)) {
            $files = scandir($this->path);

            foreach ($files as $file) {
                if (!is_dir($file)) {
                    $lines = file($this->path.DIRECTORY_SEPARATOR.$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($lines as $line) {
                        $contentarr = explode(";", $line);
                        array_push($this->ipList, $this->mapArrayToModel($contentarr));
                    }
                }
            }
            return collect($this->ipList);
        }

        return [];
    }

    /**
     * @param $array
     * @return bool
     */
    public function saveIp($array)
    {
        $array['created_at']=Carbon::now()->toDateTimeString();
        $filename = $this->getFilename();

        $contents = implode(";", $array);

        File::makeDirectory($this->path, 0777, true, true);

        File::append(($this->path.DIRECTORY_SEPARATOR.$filename), $contents.PHP_EOL);

        return true;
    }

    /**
     * @param $ipAddress
     * @return bool
     */
    public function deleteIp($ipAddress)
    {
        if (is_dir($this->path)) {
            $files = scandir($this->path);

            foreach ($files as $file) {
                if (!is_dir($file)) {
                    $lines = file($this->path.DIRECTORY_SEPARATOR.$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($lines as $line) {
                        if (strpos($line, $ipAddress)){
                            $contents = file_get_contents($this->path.DIRECTORY_SEPARATOR.$file);
                            $contents = str_replace($line,'',$contents);
                            file_put_contents($this->path.DIRECTORY_SEPARATOR.$file,$contents);
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        return false;
    }

    /**
     * Helper method for mapping array into models
     *
     * @param array $data
     * @return IpList
     */
    public function mapArrayToModel(array $data){
        $model = new IpList();
        $model->group = $data[0];
        $model->definition = $data[1];
        $model->ip = $data[2];
        $model->created_at = Carbon::make($data[3]);
        return $model;
    }

    /**
     * get log file if defined in constants
     *
     * @return string
     */
    public function getFilename()
    {
        $filename = 'iplist.php';
        if (config('ipchecker.filename')){
            $filename = config('ipchecker.filename');
        }

        return $filename;
    }
}
