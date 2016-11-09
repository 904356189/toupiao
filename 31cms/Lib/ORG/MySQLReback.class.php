<?php
class MySQLReback
{
    private $config;
    private $content;
    private $dbName = array();
    const DIR_SEP = DIRECTORY_SEPARATOR;
    public function __construct($config)
    {
        $this->config = $config;
        header("Content-type: text/html;charset=utf-8");
        $this->connect();
    }
    private function connect()
    {
        if (mysql_connect($this->config['host'] . ':' . $this->config['port'], $this->config['userName'], $this->config['userPassword'])) {
            mysql_query("SET NAMES '{$this->config['charset']}'");
            mysql_query("set interactive_timeout=24*3600");
        } else {
            $this->error('无法连接到数据库!');
        }
    }
    public function setDBName($dbName = '*')
    {
        if ($dbName == '*') {
            $rs   = mysql_list_dbs();
            $rows = mysql_num_rows($rs);
            if ($rows) {
                for ($i = 0; $i < $rows; $i++) {
                    $dbName = mysql_tablename($rs, $i);
                    $block  = array(
                        'information_schema',
                        'mysql'
                    );
                    if (!in_array($dbName, $block)) {
                        $this->dbName[] = $dbName;
                    }
                }
            } else {
                $this->error('没有任何数据库!');
            }
        } else {
            $this->dbName = func_get_args();
        }
    }
    private function getFile($fileName)
    {
        $this->content = '';
        $fileName      = $this->trimPath($this->config['path'] . self::DIR_SEP . $fileName);
        if (is_file($fileName)) {
            $ext = strrchr($fileName, '.');
            if ($ext == '.sql') {
                $this->content = file_get_contents($fileName);
            } elseif ($ext == '.gz') {
                $this->content = implode('', gzfile($fileName));
            } else {
                $this->error('无法识别的文件格式!');
            }
        } else {
            $this->error('文件不存在!');
        }
    }
    private function setFile()
    {
        $recognize = '';
        $recognize = implode('_', $this->dbName);
        //$fileName  = $this->trimPath($this->config['path'] . self::DIR_SEP . $recognize . '_' . date('YmdHis') . '_' . mt_rand(100000000, 999999999) . '.sql');
		$fileName  = $this->trimPath($this->config['path'] . self::DIR_SEP . time() . '.sql');
        $path      = $this->setPath($fileName);
        if ($path !== true) {
            $this->error("无法创建备份目录目录 '$path'");
        }
        if ($this->config['isCompress'] == 0) {
            if (!file_put_contents($fileName, $this->content, LOCK_EX)) {
                $this->error('写入文件失败,请检查磁盘空间或者权限!');
            }
        } else {
            if (function_exists('gzwrite')) {
                $fileName .= '.gz';
                if ($gz = gzopen($fileName, 'wb')) {
                    gzwrite($gz, $this->content);
                    gzclose($gz);
                } else {
                    $this->error('写入文件失败,请检查磁盘空间或者权限!');
                }
            } else {
                $this->error('没有开启gzip扩展!');
            }
        }
        if ($this->config['isDownload']) {
            $this->downloadFile($fileName);
        }
    }
    private function trimPath($path)
    {
        return str_replace(array(
            '/',
            '\\',
            '//',
            '\\\\'
        ), self::DIR_SEP, $path);
    }
    private function setPath($fileName)
    {
        $dirs = explode(self::DIR_SEP, dirname($fileName));
        $tmp  = '';
        foreach ($dirs as $dir) {
            $tmp .= $dir . self::DIR_SEP;
            if (!file_exists($tmp) && !@mkdir($tmp, 0777))
                return $tmp;
        }
        return true;
    }
    private function downloadFile($fileName)
    {
        ob_end_clean();
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($fileName));
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        readfile($fileName);
    }
    private function backquote($str)
    {
        return "`{$str}`";
    }
    private function getTables($dbName)
    {
        @$rs = mysql_list_tables($dbName);
        $rows     = mysql_num_rows($rs);
        $dbprefix = $this->config['dbprefix'];
        for ($i = 0; $i < $rows; $i++) {
            $tbName = mysql_tablename($rs, $i);
            if (substr($tbName, 0, strlen($dbprefix)) == $dbprefix) {
                $tables[] = $tbName;
            }
        }
        return $tables;
    }
    private function chunkArrayByByte($array, $byte = 5120)
    {
        $i   = 0;
        $sum = 0;
        foreach ($array as $v) {
            $sum += strlen($v);
            if ($sum < $byte) {
                $return[$i][] = $v;
            } elseif ($sum == $byte) {
                $return[++$i][] = $v;
                $sum            = 0;
            } else {
                $return[++$i][] = $v;
                $i++;
                $sum = 0;
            }
        }
        return $return;
    }
	
	/**
	* 插入数据库备份基础信息
	*
	* @return string
	*/
	private $ds = "\n";
	private function _base() {
		$value = '';
		$value .= '-- MySQL database dump' . $this->ds;
		$value .= '-- Created by MySQLReback. Power by Hintay.' . $this->ds;
		$value .= '--' . $this->ds;
		$value .= '-- 主机: ' . $this->host . $this->ds;
		$value .= '-- 生成日期: ' . date ( 'Y' ) . ' 年  ' . date ( 'm' ) . ' 月 ' . date ( 'd' ) . ' 日 ' . date ( 'H:i' ) . $this->ds;
		$value .= '-- MySQL版本: ' . mysql_get_server_info () . $this->ds;
		$value .= '-- PHP 版本: ' . phpversion () . $this->ds;
		$value .= $this->ds;
		$value .= '--' . $this->ds;
		$value .= '-- 数据库: `' . C("DB_NAME") . '`'. $this->ds;
		$value .= '--' . $this->ds ;
		$value .= '-- -------------------------------------------------------';
		$value .= $this->ds . $this->ds;
		return $value;
	}

    public function backup()
    {
        //$this->content = '/* This file is created by MySQLReback ' . date('Y-m-d H:i:s') . ' */';
		$this->content = $this->_base();;
        foreach ($this->dbName as $dbName) {
            $qDbName = $this->backquote($dbName);
            $rs      = mysql_query("SHOW CREATE DATABASE {$qDbName}");
            if ($row = mysql_fetch_row($rs)) {
                mysql_select_db($dbName);
                $tables = $this->getTables($dbName);
                foreach ($tables as $table) {
                    $table   = $this->backquote($table);
                    $tableRs = mysql_query("SHOW CREATE TABLE {$table}");
                    if ($tableRow = mysql_fetch_row($tableRs)) {
                        $this->content .= "\r\n /* 创建表结构 {$table} */";
                        $this->content .= "\r\n DROP TABLE IF EXISTS {$table};/* MySQLReback Separation */ {$tableRow[1]};/* MySQLReback Separation */";
                        $tableDateRs = mysql_query("SELECT * FROM {$table}");
                        $valuesArr   = array();
                        $values      = '';
                        while ($tableDateRow = mysql_fetch_row($tableDateRs)) {
                            foreach ($tableDateRow as &$v) {
                                $v = "'" . addslashes($v) . "'";
                            }
                            $valuesArr[] = '(' . implode(',', $tableDateRow) . ')';
                        }
                        $temp = $this->chunkArrayByByte($valuesArr);
                        if (is_array($temp)) {
                            foreach ($temp as $v) {
                                $values = implode(',', $v) . ';/* MySQLReback Separation */';
                                if ($values != ';/* MySQLReback Separation */') {
                                    $this->content .= "\r\n /* 插入数据 {$table} */";
                                    $this->content .= "\r\n INSERT INTO {$table} VALUES {$values}";
                                }
                            }
                        }
                    }
                }
            } else {
                $this->error('未能找到数据库!');
            }
        }
        if (!empty($this->content)) {
            $this->setFile();
        }
        return true;
    }
    public function recover($fileName)
    {
        $this->getFile($fileName);
        if (!empty($this->content)) {
            $content = explode(';/* MySQLReback Separation */', $this->content);
            foreach ($content as $i => $sql) {
                $sql = trim($sql);
                if (!empty($sql)) {
                    $dbName = $this->dbName[0];
                    if (!mysql_select_db($dbName))
                        $this->error('不存在的数据库!' . mysql_error());
                    $rs = mysql_query($sql);
                    if ($rs) {
                        if (strstr($sql, 'CREATE DATABASE')) {
                            $dbNameArr = sscanf($sql, 'CREATE DATABASE %s');
                            $dbName    = trim($dbNameArr[0], '`');
                            mysql_select_db($dbName);
                        }
                    } else {
                        $this->error('备份文件被损坏!' . mysql_error());
                    }
                }
            }
        } else {
            $this->error('无法读取备份文件!');
        }
        return true;
    }
    private function error($error)
    {
        throw new Exception($error);
    }
}
?> 