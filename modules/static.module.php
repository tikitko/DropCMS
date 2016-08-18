<?php
/*
 *   DropCMS
 *   Ver. 0.0.2
 *   (c) 2016 Bykov Nikita
 *   static.module.php
 *
 */
    class module
    {
        public $args;
        public function __construct($args = array()) {$this->args = (array)$args;}
        public function main() : array {
            if(!isset($this->args['pages_dir']) || !is_dir($this->args['pages_dir'])) die(Localization::ERROR_STATIC_MODULE_LOAD_DIR );
            $pages_dir = $this->args['pages_dir'];
            $get_page = isset($_GET['page']) ? $_GET['page'] : '';
            $array = PageConstructors::BasePageCreate();
            $array['data']['content_tpl'] = 'static.tpl';

            $default_page_path = $pages_dir.Config::STATIC_MODULE_DEFAULT_PAGE.'.json';
            $new_page_path = $pages_dir.$get_page.'.json';
            if(empty($get_page) && is_file($default_page_path)) $load_page_path = $default_page_path;
            elseif(!empty($get_page) && is_file($new_page_path)) $load_page_path = $new_page_path;
            else $load_page_path = '';

            if(!empty($load_page_path)) {
                $page_data = json_decode(file_get_contents($load_page_path),true);
                if(!empty($page_data['title'])) $array['data']['title'] = $page_data['title'].' - '.$array['data']['title'];
                if(!empty($page_data['description'])) $array['data']['description'] = $page_data['description'];
                if(!empty($page_data['keywords'])) $array['data']['keywords'] = $page_data['keywords'];
                $array['data']['static']['title'] = $page_data['page_title'];
                $array['data']['static']['text'] = $page_data['page_text'];
            }
            else PageConstructors::Error404Add($array,'static');

            return (array) $array;
        }
    }