<?php

class WOWSlider_Helpers {
    
    function filesystem_copy($source, $destination, $overwrite = false) {
        if (!$overwrite && file_exists($destination))
            return false;
        $rtval = @copy($source, $destination);
        return $rtval;
    }
    
    function filesystem_move($source, $destination, $overwrite = false){
        if (!file_exists($source) || (!$overwrite && is_file($destination)))
            return false;
        if (@rename($source, $destination))
            return true;
        if (is_dir($source)){
            $dirs = $list = array();
            $source = trailingslashit($source);
            $destination = trailingslashit($destination);
            $length = strlen($source);
            $dirs[] = $source;
            while ($dirs){
                $dir = array_pop($dirs);
                if ($dh = opendir($dir)){
                    while (($item = readdir($dh)) !== false){
                        if ($item{0} == '.') continue;
                        else if (is_dir($dir . $item)){
                            $list[] = substr($dir . $item . '/', $length);
                            $dirs[] = $dir . $item . '/';
                        } else $list[] = substr($dir . $item, $length);
                    }
                    closedir($dh);
                }
            }
            sort($list);
            if (!is_dir($destination)) @mkdir($destination);
            foreach ($list as $item){
                if (substr($item, -1) == '/'){
                    if (!is_dir($destination . $item))
                        @mkdir($destination . $item);
                } else {
                    if (!file_exists($destination . $item) || $overwrite)
                        @copy($source . $item, $destination . $item);
                    @unlink($source . $item);
                }
            }
            WOWSlider_Helpers::filesystem_delete($source, true);
            return true;
        }
        if (WOWSlider_Helpers::filesystem_copy($source, $destination, $overwrite) && file_exists($destination)){
            WOWSlider_Helpers::filesystem_delete($source);
            return true;
        } else {
            return false;
        }
    }

    function filesystem_delete($file, $recursive = false, $type = false){
        if (empty($file)) return false;
        $file = str_replace('\\', '/', $file);
        if ('f' == $type || is_file($file))
            return @unlink($file);
        if (!$recursive && is_dir($file))
            return @rmdir($file);
        $file = trailingslashit($file);
        $filelist = WOWSlider_Helpers::filesystem_dirlist($file, true);
        $retval = true;
        if (is_array($filelist))
            foreach ($filelist as $filename => $fileinfo)
                if (!WOWSlider_Helpers::filesystem_delete($file . $filename, $recursive, $fileinfo['type']))
                    $retval = false;
        if (file_exists($file) && !@rmdir($file))
            $retval = false;
        return $retval;
    }
    
    function filesystem_dirlist($path, $include_hidden = true, $recursive = false){
        if (is_file($path)){
            $limit_file = basename($path);
            $path = dirname($path);
        } else $limit_file = false;
        if (!is_dir($path)) return false;
        $dir = @dir($path);
        if (!$dir) return false;
        $ret = array();
        while (false !== ($entry = $dir -> read())){
            $struc = array();
            $struc['name'] = $entry;
            if ('.' == $struc['name'] || '..' == $struc['name'])
                continue;
            if (!$include_hidden && '.' == $struc['name'][0])
                continue;
            if ($limit_file && $struc['name'] != $limit_file)
                continue;
            $struc['type'] = is_dir($path.'/'.$entry) ? 'd' : 'f';
            if ('d' == $struc['type']){
                if ($recursive)
                    $struc['files'] = WOWSlider_Helpers::filesystem_dirlist($path . '/' . $struc['name'], $include_hidden, $recursive);
                else
                    $struc['files'] = array();
            }
            $ret[ $struc['name'] ] = $struc;
        }
        $dir -> close();
        unset($dir);
        return $ret;
    }
    
    function is_new_plugin($file){
        if (!file_exists($file) || (is_multisite() && !is_super_admin())) return false;
        $current = get_file_data(WOWSLIDER_PLUGIN_PATH . 'wowslider.php', array('Version' => 'Version'), 'plugin');
        $new = get_file_data($file, array('Version' => 'Version'), 'plugin');
        return version_compare($new['Version'], $current['Version'], '>');
    }
    
}

?>
