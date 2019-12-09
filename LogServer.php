<?php

/**
 * 记录日志辅助类 (写文件)
 *
 * @author zhang.hangda
 * @date 2019-12-09
 */

class LogServer{

    /** @var string 默认的存储路径 实例 */
    public static $baseFile = 'D:\log';

    /** @var string 每次实例后 生成的地址对象 */
    public static $path;

    /** @var object 单例对象 */
    private static $objIns;


	/**
	 * 单例
	 */
	public static function model(){
	    if(!self::$objIns){
	        self::$objIns = new self();
        }

	    return self::$objIns;
    }

    /**
     * 写入文件
     */
    public function log($_message,$_itemFile){
        $objFile = fopen(self::getPath($_itemFile));
        fwrite($objFile,date('Y-m-d H:i:s').'  '.$_message."\r\n");
        fclose($objFile);
    }

    /**
     * 获取日志文件目录 没有则生成
     */
    public static function getPath($_itemFile){
        if(!self::$path){
            $strPath = self::$baseFile.'/'.$_itemFile.'/'.date("Y").'/'.date("m");
            self::mkdir($strPath);
            self::$path = $strPath.'/'.date('Ymd').'.log';
        }

        return self::$path;
    }

    /**
     * 生成指定的文件夹
     */
    public static function mkdir($_file){
        //$strPath = '';
        if(!file_exists($_file)){
            //循环检测路径 依次生成
            /*$aryDir = explode('/',$_file);
            foreach ($aryDir as $strDir){
                $strPath .= $strDir.'/';
                if(!file_exists($strPath)){
                    // 生成文件夹
                    mkdir($strPath,'0777');
                }
            }*/


            // mkdir 的第三个参数 为true时 支持递归生成目录 所以可以省去手动foreach的逻辑
            mkdir($_file,'0777',true);
        }
    }
}