<?php

function wowslider_upload_dir($k = 'path'){
    static $dir = '/wow-slider-plugin/';
    if (is_string($dir)){
        $upload_dir = wp_upload_dir();
        $dir = array(
            'url'  => $upload_dir['baseurl'] . $dir,
            'path' => $upload_dir['basedir'] . $dir,
            'base' => $dir
        );
        if (!is_dir($dir['path'])) @mkdir($dir['path']);
        if (!is_dir($dir['path'] . 'import/')) @mkdir($dir['path'] . 'import/');
    }
    return $dir[$k];
}

function wowslider_install($undo = false){
    global $wpdb, $wp_current_filter;
    $tables = array($wpdb -> prefix . 'wowslider');
    if (in_array('wpmu_new_blog', $wp_current_filter)){
        $blog_id = func_get_arg(0);
        $tables[0] = $wpdb -> get_blog_prefix($blog_id) . 'wowslider';
    } else if (is_multisite() && ($blogs = $wpdb -> get_col('SELECT blog_id FROM ' . $wpdb -> blogs))){
        foreach ($blogs as $blog_id)
            $tables[] = $wpdb -> get_blog_prefix($blog_id) . 'wowslider';
        $tables = array_unique($tables);
    }
    if ($undo === 'undo'){
        foreach ($tables as $table)
            $wpdb -> query("DROP TABLE $table;");
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        WOWSlider_Helpers::filesystem_delete(wowslider_upload_dir(), true);
        if (is_multisite() && $blogs){
            foreach ($blogs as $blog_id)
                WOWSlider_Helpers::filesystem_delete(WP_CONTENT_DIR . "/blogs.dir/$blog_id/files" . wowslider_upload_dir('base'), true);
        }
        delete_option('wowslider_installed');
        delete_metadata('user', 0, 'wowslider_last_view', '', true);
        delete_metadata('user', 0, 'wp_wowslider_sliders_per_page', '', true);
        delete_metadata('user', 0, 'managewowslider_sliderscolumnshidden', '', true);
    } else {
        $charset_collate = '';
        if (!empty($wpdb -> charset)) $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        if (!empty($wpdb -> collate)) $charset_collate .= " COLLATE $wpdb->collate";
        $queries = "CREATE TABLE %s (
          ID bigint(20) unsigned NOT NULL auto_increment,
          slider_name varchar(200) NOT NULL,
          slider_author bigint(20) unsigned NOT NULL default '0',
          slider_date datetime NOT NULL default '0000-00-00 00:00:00',
          slider_date_gmt datetime NOT NULL default '0000-00-00 00:00:00',
          slider_public tinyint(3) unsigned NOT NULL default '1',
          slider_images text NOT NULL,
          PRIMARY KEY  (ID),
          KEY slider_name (slider_name),
          KEY slider_author (slider_author),
          KEY slider_public (slider_public),
          KEY slider_date (slider_date)
        ) $charset_collate;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        foreach ($tables as $table)
            dbDelta(sprintf($queries, $table));
        if (!get_option('wowslider_installed') && is_dir(WOWSLIDER_PLUGIN_PATH . 'install/')){
            add_option('wowslider_installed', 1);
            wowslider_add(WOWSLIDER_PLUGIN_PATH . 'install/');
        }
    }
    return true;
}

function wowslider_add($folder = false, $update = 0, $delete = true){
    global $wpdb, $user_ID;
    static $id = 0;
    if (!$folder) return $id;
    if (is_file($folder) && strtolower(substr($folder, -4)) == '.zip')
        return wowslider_import($folder, $update, $delete);
    $folder = rtrim(str_replace('\\', '/', $folder), '/') . '/';
    if (is_file($folder . 'slider.html') &&
        is_dir($folder . 'images/')){
        $images = array();
        $list = WOWSlider_Helpers::filesystem_dirlist($folder . (is_dir($folder . 'tooltips/') ? 'tooltips/' : 'images/'));
        foreach ($list as $name=>$v){
            if ($v['type'] != 'f') continue;
            switch (strtolower(substr($name, -4))){
                case '.jpg':
                case '.png':
                    $images[] = $name;
                    break;
            }
            if (count($images) == 10)
                break;
        }
        if (count($images)){
            $name = '';
            if (preg_match('/<!--\s*Name:(.+?)\s*-->/ui', file_get_contents($folder . 'slider.html'), $match)) $name = trim($match[1]);
            $date = current_time('mysql');
            $insert = array(
                'slider_name'     => mb_substr($name, 0, 200),
                'slider_author'   => $user_ID,
                'slider_date'     => $date,
                'slider_date_gmt' => get_gmt_from_date($date),
                'slider_public'   => 1,
                'slider_images'   => serialize($images)
            );
            if ($update) $insert['ID'] = $update;
            foreach ($insert as $k=>$v) $insert[$k] = '"' . $wpdb -> escape($v) . '"';
            $wpdb -> query('INSERT INTO ' . $wpdb -> prefix . 'wowslider (' . implode(',', array_keys($insert)) . ') VALUES (' . implode(',', array_values($insert)) . ');');
            $id = $update ? (int)$update : (int)$wpdb -> get_var('SELECT LAST_INSERT_ID();');
            if ($id){
                $dest = wowslider_upload_dir() . $id . '/';
                if (!is_dir(wowslider_upload_dir())) mkdir(wowslider_upload_dir());
                if (is_dir($dest)) WOWSlider_Helpers::filesystem_delete($dest, true);
                WOWSlider_Helpers::filesystem_move($folder, $dest);
                if ($name == '') $wpdb -> query('UPDATE ' . $wpdb -> prefix . 'wowslider SET slider_name = "' . $wpdb -> escape('Slider ' . $id) . '" WHERE ID = ' . $id . ';');
                file_put_contents($dest . 'slider.html', str_replace('%ID%', $id, file_get_contents($dest . 'slider.html')));
                file_put_contents($dest . 'style.css', str_replace('%ID%', $id, file_get_contents($dest . 'style.css')));
                if (file_exists($dest . 'script.js')) file_put_contents($dest . 'script.js', str_replace('%ID%', $id, file_get_contents($dest . 'script.js')));
                return true;
            } else return __('Failure when added to the table.', 'wowslider');
        }
    }
    return __('Wrong slider.', 'wowslider');
}

function wowslider_import($zip_file = false, $update = 0, $delete = true){
    global $wp_filesystem;
    static $file = '';
    if ($zip_file === 'file') return $file;
    $path = wowslider_upload_dir() . 'import/';
    $status = true;
    if (!$zip_file){
        $list = WOWSlider_Helpers::filesystem_dirlist($path);
        foreach ($list as $name=>$v){
            if ($v['type'] == 'f' && strtolower(substr($name, -4)) == '.zip'){
                $zip_file = $path . $name;
                $file = $name;
                break;
            }
        }
        if (!$zip_file) return __('Files to import not found.', 'wowslider');
    }
    $path .= md5(microtime()) . '/';
    @mkdir($path);
    add_filter('filesystem_method', create_function('', 'return "direct";'));
    WP_Filesystem();
    $unzip = unzip_file($zip_file, $path);
    $install = $path . 'wowslider/install/';
    if ($delete) WOWSlider_Helpers::filesystem_delete($zip_file);
    if (is_object($unzip)) $status = __('Wrong .zip file.', 'wowslider');
    else {
        $status = wowslider_add((is_dir($install) ? $install : $path . 'import/'), $update);
        $install = substr($install, 0, -8);
        if (is_dir($install) && WOWSlider_Helpers::is_new_plugin($install . 'wowslider.php')){
            foreach (array('', 'data/') as $dir){
                if ($list = WOWSlider_Helpers::filesystem_dirlist($install . $dir)){
                    foreach ($list as $item){
                        if ($item['type'] != 'f') continue;
                        WOWSlider_Helpers::filesystem_copy($install . $dir . $item['name'], WOWSLIDER_PLUGIN_PATH . $dir . $item['name'], true);
                    }
                }
            }
        }
    }
    WOWSlider_Helpers::filesystem_delete($path, true);
    return $status;
}

function wowslider_delete($id, $type = 'permanently'){
    global $wpdb;
    $where = '';
    if ($id !== 'all' && $id !== '*'){
        if (is_string($id)) $id = preg_split('/,\s*/', $id);
        else if (!is_array($id)) $id = array($id);
        $id = array_map(create_function('$v', 'return (int)$v;'), $id);
        $where = ' ID IN (' . implode(',', array_unique($id)) . ') AND';
    }
    if ($type == 'permanently'){
        if (!$id = $wpdb -> get_results('SELECT ID FROM ' . $wpdb -> prefix . 'wowslider WHERE' . $where . ' slider_public = 0 ORDER BY ID ASC LIMIT 200', ARRAY_A)) return false;
        $indexes = array_map(create_function('$v', 'return (int)$v[\'ID\'];'), $id);
        foreach ($indexes as $id){
            WOWSlider_Helpers::filesystem_delete(wowslider_upload_dir() . $id . '/', true);
            $wpdb -> query('DELETE FROM ' . $wpdb -> prefix . 'wowslider WHERE ID = ' . $id . ';');
        }
        return $indexes;
    } else if ($type == 'restore') $wpdb -> query('UPDATE ' . $wpdb -> prefix . 'wowslider SET slider_public = 1 WHERE' . $where . ' slider_public = 0;');
    else $wpdb -> query('UPDATE ' . $wpdb -> prefix . 'wowslider SET slider_public = 0 WHERE' . $where . ' slider_public = 1;');
    return $id;
}

function wowslider_get($q){
    global $wpdb;
    static $q_count = 0;
    $sliders = array();
    if (is_integer($q) || (is_array($q) && isset($q['name']))){
        $sort = '';
        if (is_array($q)){
            $sort = ' ORDER BY ID DESC';
            $where = 'slider_name = "' . $wpdb -> escape($q['name']) . '"';
        } else $where = 'ID = ' . $q;
        $only_public = func_num_args() > 1 ? func_get_arg(1) : true;
        if ($id = $wpdb -> get_var('SELECT ID FROM ' . $wpdb -> prefix . 'wowslider WHERE ' . $where . ($only_public ? ' AND slider_public = 1' : '') . $sort . ' LIMIT 1;')){
            $html = "\n\n<link rel='stylesheet' href='" . wowslider_upload_dir('url') . "$id/style.css' type='text/css' media='all' />\n" . str_replace('%URL%', wowslider_upload_dir('url') . "$id/", file_get_contents(wowslider_upload_dir() . $id . '/slider.html')) . "\n\n";
            if (file_exists(wowslider_upload_dir() . $id . '/script.js')) $html .= "<script type='text/javascript' src='" . wowslider_upload_dir('url') . "$id/script.js'></script>\n\n";
            return $html;
        }
        return '';
    } else if (is_string($q) && ($q = preg_split('/\s+/', $q, 2))){
        list($q, $param) = array_pad($q, 2, '');
        if ($q == 'count') return $q_count;
        else if ($q == 'totals'){
            return array(
                'published' => (int)$wpdb -> get_var('SELECT COUNT(*) FROM ' . $wpdb -> prefix . 'wowslider WHERE slider_public = 1;'),
                'trash' => (int)$wpdb -> get_var('SELECT COUNT(*) FROM ' . $wpdb -> prefix . 'wowslider WHERE slider_public = 0;')
            );
        } else if ($q == 'months'){
            if (!in_array($param, array('published', 'trash'))) $param = 'all';
            return $wpdb -> get_results('SELECT DISTINCT YEAR(slider_date) AS year, MONTH(slider_date) AS month FROM ' . $wpdb -> prefix . 'wowslider' . ($param != 'all' ? ' WHERE slider_public = ' . ($param == 'trash' ? 0 : 1) : '') . ' ORDER BY slider_date DESC', ARRAY_A);
        }
    } else if (isset($q['last']) && ($results = $wpdb -> get_results('SELECT ID as id, slider_name as name FROM ' . $wpdb -> prefix . 'wowslider WHERE slider_public = 1 ORDER BY ID DESC LIMIT ' . (int)$q['last'] . ';', ARRAY_A))){
        foreach ($results as $v)
            $sliders[ $v['id'] ] = $v['name'];
    } else {
        if (isset($q['limit'])) $limit = ' LIMIT ' . $q['limit'];
        else if (isset($q['page'])){
            $count = isset($q['count']) ? (int)$q['count'] : 10;
            $limit = ' LIMIT ' . (((int)$q['page'] - 1) * $count) . ', ' . $count;
        } else $limit = '';
        $sort  = ' ORDER BY ' . (isset($q['sort']) ? $q['sort'] : 'ID ASC');
        $users = $where = array();
        if (isset($q['where'])) $where[] = $q['where'];
        if (isset($q['month'])) $where[] = 'MONTH(slider_date) = ' . $q['month'];
        if (isset($q['year'])) $where[] = 'YEAR(slider_date) = ' . $q['year'];
        if (isset($q['search'])){
            $s = preg_split('/\s+/', $q['search']);
            foreach ($s as $i=>$v) $s[$i] = 'slider_name LIKE "%' . $wpdb -> escape(like_escape($v)) . '%"';
            $where[] = '((' . implode(' AND ', $s) . ')';
            $where[ count($where) - 1 ] .= (preg_match('/^[0-9]+$/', $q['search']) ? ' OR ID = ' . (int)$q['search'] : '') . ')';
        }
        $where = $where ? ' WHERE ' . implode(' AND ', $where) : '';
        if (!$q_count = (int)$wpdb -> get_var('SELECT COUNT(*) FROM ' . $wpdb -> prefix . 'wowslider ' . $where . ';')) return $sliders;
        $sliders = $wpdb -> get_results('SELECT ID as id, slider_name as name, slider_author as author,  slider_date as date, slider_date_gmt as date_gmt, slider_public as public, slider_images as images FROM ' . $wpdb -> prefix . 'wowslider ' . $where . $sort . $limit . ';', ARRAY_A);
        foreach ($sliders as $i=>$v) $users[] = $v['author'];
        $results = get_users(array('include' => array_unique($users)));
        $users = array();
        for ($i = 0, $count = count($results); $i < $count; $i++)
            $users[ (int)$results[$i] -> ID ] = $results[$i] -> display_name;
        foreach ($sliders as $i=>$v){
            $index  = (int)$v['author'];
            $sliders[$i]['images'] = unserialize($v['images']);
            $sliders[$i]['author'] = false;
            if (isset($users[$index])){
                $sliders[$i]['author'] = array(
                    'id'   => $index,
                    'name' => $users[$index]
                );
            }
            $sliders[$i]['trash'] = (int)$v['public'] ? false : true;
            $sliders[$i]['name'] = htmlspecialchars($sliders[$i]['name']);
        }
    }
    return $sliders;
}

?>
