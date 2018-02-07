<?php

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class ThnxBlogSelectedPosts extends Module implements WidgetInterface
{
    public $css_files = array(
        array(
            'key' => 'thnxblogselectedposts',
            'src' => 'thnxblogselectedposts.css',
            'priority' => 50,
            'media' => 'all',
            'load_theme' => false,
        ),
    );
    public $js_files = array(
        array(
            'key' => 'thnxblogselectedposts',
            'src' => 'thnxblogselectedposts.js',
            'priority' => 50,
            'position' => 'bottom', // bottom or head
            'load_theme' => false,
        ),
    );
    public function __construct()
    {
        $this->name = 'thnxblogselectedposts';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'thanksit.com';
        $this->bootstrap = true;
        // $this->dependencies = array('thnxblog');
        parent::__construct();
        $this->displayName = $this->l('Platinum Theme thnxBlog Selected Blog Posts');
        $this->description = $this->l('Platinum Theme Selected Blog Posts Module');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }
    // For installation service
    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('displayheader')
            || !$this->registerHook('displayHomeBottom')
            // || !$this->registerHook('displayFooterTopFullwidth')
            || !$this->xpertsampledata()
        ) {
            return false;
        }
        return true;
    }
    // For uninstallation service
    public function uninstall()
    {
        if (!parent::uninstall()
        ) {
            return false;
        } else {
            return true;
        }
    }
    public function xpertsampledata($demo = null)
    {
        if (($demo == null) || (empty($demo))) {
            $demo = "demo_1";
        }

        $func = 'xpertsample_' . $demo;
        if (method_exists($this, $func)) {
            $this->{$func}();
        } else {
            $this->xpertsample_demo();
        }
        return true;
    }
    public function xpertsample_demo()
    {
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            Configuration::updateValue('thnxbsp_title_' . $lang['id_lang'], "LESTER BLOG");
            Configuration::updateValue('thnxbsp_subtext_' . $lang['id_lang'], "");
        }
        Configuration::updateValue('thnxbsp_postcount', 4);
        Configuration::updateValue('thnxbsp_item_prd', '1,2,3,4');
        Configuration::updateValue('thnxbsp_designlayout', 'default');
        Configuration::updateValue('thnxbsp_numcolumn', 2);
        return true;
    }
    public function xpertsample_demo_1()
    {
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            Configuration::updateValue('thnxbsp_title_' . $lang['id_lang'], "LESTER BLOG");
            Configuration::updateValue('thnxbsp_subtext_' . $lang['id_lang'], "");
        }
        Configuration::updateValue('thnxbsp_postcount', 4);
        Configuration::updateValue('thnxbsp_item_prd', '1,2,3,4');
        Configuration::updateValue('thnxbsp_numcolumn', 2);
        Configuration::updateValue('thnxbsp_designlayout', 'default');
        return true;
    }
    public function xpertsample_demo_2()
    {
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            Configuration::updateValue('thnxbsp_title_' . $lang['id_lang'], "LESTER BLOG");
            Configuration::updateValue('thnxbsp_subtext_' . $lang['id_lang'], "");
        }
        Configuration::updateValue('thnxbsp_postcount', 4);
        Configuration::updateValue('thnxbsp_item_prd', '1,2,3,4');
        Configuration::updateValue('thnxbsp_numcolumn', 2);
        Configuration::updateValue('thnxbsp_designlayout', 'default');
        return true;
    }
    public function xpertsample_demo_3()
    {
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            Configuration::updateValue('thnxbsp_title_' . $lang['id_lang'], "LESTER BLOG");
            Configuration::updateValue('thnxbsp_subtext_' . $lang['id_lang'], "");
        }
        Configuration::updateValue('thnxbsp_postcount', 4);
        Configuration::updateValue('thnxbsp_item_prd', '1,2,3,4');
        Configuration::updateValue('thnxbsp_numcolumn', 1);
        Configuration::updateValue('thnxbsp_designlayout', 'classic');
        return true;
    }
    public function allthnxBlogPosts()
    {
        if (Module::isInstalled('thnxblog') && Module::isEnabled('thnxblog')) {
            $context = Context::getContext();
            $id_lang = (int) $context->language->id;
            $id_shop = (int) $context->shop->id;
            $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'thnxposts` xc INNER JOIN `' . _DB_PREFIX_ . 'thnxposts_lang` xcl ON (xc.`id_thnxposts` = xcl.`id_thnxposts` AND xcl.`id_lang` = ' . $id_lang . ') INNER JOIN `' . _DB_PREFIX_ . 'thnxposts_shop` xcs ON (xc.`id_thnxposts` = xcs.`id_thnxposts` AND xcs.`id_shop` = ' . $id_shop . ') WHERE xc.`active` = 1 AND xc.post_type = "post"  ';
            $queryexec = Db::getInstance()->executeS($sql);
            if (isset($queryexec) && !empty($queryexec)) {
                return $queryexec;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function allBlogPosts()
    {
        $rs = array();
        $rslt = array();
        $rs = $this->allthnxBlogPosts();
        $i = 0;
        if (isset($rs) && !empty($rs)) {
            foreach ($rs as $r) {
                $rslt[$i]['id'] = $r['id_thnxposts'];
                $rslt[$i]['name'] = $r['post_title'];
                $i++;
            }
        }
        return $rslt;
    }
    // Helper Form for Html markup generate
    public function SettingForm()
    {
        $default_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        $this->fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Setting'),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button',
            ),
        );
        $this->fields_form[0]['form']['input'][] = array(
            'type' => 'text',
            'label' => $this->l('Title'),
            'name' => 'thnxbsp_title',
            'lang' => true,
        );
        $this->fields_form[0]['form']['input'][] = array(
            'type' => 'text',
            'label' => $this->l('Sub Title'),
            'name' => 'thnxbsp_subtext',
            'lang' => true,
        );
        $this->fields_form[0]['form']['input'][] = array(
            'type' => 'selecttwotype',
            'label' => $this->l('Select Blog Posts'),
            'placeholder' => $this->l('Select Blog Posts'),
            'initvalues' => $this->allBlogPosts(),
            'name' => 'thnxbsp_item_prd',
            'desc' => $this->l('Please Type Your blog post Name And Select. You Can Select Multiple'),
        );
        $this->fields_form[0]['form']['input'][] = array(
            'type' => 'text',
            'label' => $this->l('How Many Post You Want To Display'),
            'name' => 'thnxbsp_postcount',
        );
        $this->fields_form[0]['form']['input'][] = array(
            'type' => 'select',
            'label' => $this->l('Select number of column to display'),
            'name' => 'thnxbsp_numcolumn',
            'options' => array(
                'query' => array(
                    array(
                        'id' => '1',
                        'name' => '1 column',
                    ),
                    array(
                        'id' => '2',
                        'name' => '2 column',
                    ),
                    array(
                        'id' => '3',
                        'name' => '3 column',
                    ),
                    array(
                        'id' => '4',
                        'name' => '4 column',
                    ),
                ),
                'id' => 'id',
                'name' => 'name',
            ),
        );
        $this->fields_form[0]['form']['input'][] = array(
            'type' => 'select',
            'label' => $this->l('Select Design Layout'),
            'name' => 'thnxbsp_designlayout',
            'options' => array(
                'query' => array(
                    array(
                        'id' => 'default',
                        'name' => 'Default',
                    ),
                    array(
                        'id' => 'general',
                        'name' => 'General',
                    ),
                    array(
                        'id' => 'classic',
                        'name' => 'Classic',
                    ),
                    array(
                        'id' => 'creative',
                        'name' => 'Creative',
                    ),
                ),
                'id' => 'id',
                'name' => 'name',
            ),
        );
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        foreach (Language::getLanguages(false) as $lang) {
            $helper->languages[] = array(
                'id_lang' => $lang['id_lang'],
                'iso_code' => $lang['iso_code'],
                'name' => $lang['name'],
                'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0),
            );
        }
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name . 'token=' . Tools::getAdminTokenLite('AdminModules'),
            ),
        );
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'save' . $this->name;
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $helper->fields_value['thnxbsp_title'][$lang['id_lang']] = Configuration::get('thnxbsp_title_' . $lang['id_lang']);
            $helper->fields_value['thnxbsp_subtext'][$lang['id_lang']] = Configuration::get('thnxbsp_subtext_' . $lang['id_lang']);
        }
        $helper->fields_value['thnxbsp_postcount'] = Configuration::get('thnxbsp_postcount');
        $helper->fields_value['thnxbsp_item_prd'] = Configuration::get('thnxbsp_item_prd');
        $helper->fields_value['thnxbsp_designlayout'] = Configuration::get('thnxbsp_designlayout');
        $helper->fields_value['thnxbsp_numcolumn'] = Configuration::get('thnxbsp_numcolumn');
        return $helper;
    }
    // All Functional Logic here.
    public function getContent()
    {
        $html = '';
        $this->context->controller->addJqueryPlugin('select2');
        if (Tools::isSubmit('save' . $this->name)) {
            $languages = Language::getLanguages(false);
            foreach ($languages as $lang) {
                Configuration::updateValue('thnxbsp_title_' . $lang['id_lang'], Tools::getvalue('thnxbsp_title_' . $lang['id_lang']));
                Configuration::updateValue('thnxbsp_subtext_' . $lang['id_lang'], Tools::getvalue('thnxbsp_subtext_' . $lang['id_lang']));
            }
            Configuration::updateValue('thnxbsp_postcount', Tools::getvalue('thnxbsp_postcount'));
            Configuration::updateValue('thnxbsp_item_prd', Tools::getvalue('thnxbsp_item_prd'));
            Configuration::updateValue('thnxbsp_designlayout', Tools::getvalue('thnxbsp_designlayout'));
            Configuration::updateValue('thnxbsp_numcolumn', Tools::getvalue('thnxbsp_numcolumn'));
        }
        $helper = $this->SettingForm();
        $html .= $helper->generateForm($this->fields_form);
        return $html;
    }
    public static function isEmptyFileContet($path = null)
    {
        if ($path == null) {
            return false;
        }
        if (file_exists($path)) {
            $content = Tools::file_get_contents($path);
            if (empty($content)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    public function Register_Css()
    {
        if (isset($this->css_files) && !empty($this->css_files)) {
            $theme_name = $this->context->shop->theme_name;
            $page_name = $this->context->controller->php_self;
            $root_path = _PS_ROOT_DIR_.'/';
            foreach ($this->css_files as $css_file) :
                if (isset($css_file['key']) && !empty($css_file['key']) && isset($css_file['src']) && !empty($css_file['src'])) {
                    $media = (isset($css_file['media']) && !empty($css_file['media'])) ? $css_file['media'] : 'all';
                    $priority = (isset($css_file['priority']) && !empty($css_file['priority'])) ? $css_file['priority'] : 50;
                    $page = (isset($css_file['page']) && !empty($css_file['page'])) ? $css_file['page'] : array('all');
                    if (is_array($page)) {
                        $pages = $page;
                    } else {
                        $pages = array($page);
                    }
                    if (in_array($page_name, $pages) || in_array('all', $pages)) {
                        if (isset($css_file['load_theme']) && ($css_file['load_theme'] == true)) {
                            $theme_file_src = 'themes/'.$theme_name.'/assets/css/'.$css_file['src'];
                            if (self::isEmptyFileContet($root_path.$theme_file_src)) {
                                $this->context->controller->registerStylesheet($css_file['key'], $theme_file_src, ['media' => $media, 'priority' => $priority]);
                            }
                        } else {
                            $module_file_src = 'modules/'.$this->name.'/css/'.$css_file['src'];
                            if (self::isEmptyFileContet($root_path.$module_file_src)) {
                                $this->context->controller->registerStylesheet($css_file['key'], $module_file_src, ['media' => $media, 'priority' => $priority]);
                            }
                        }
                    }
                }
            endforeach;
        }
        return true;
    }
    public function Register_Js()
    {
        if (isset($this->js_files) && !empty($this->js_files)) {
            $theme_name = $this->context->shop->theme_name;
            $page_name = $this->context->controller->php_self;
            $root_path = _PS_ROOT_DIR_.'/';
            foreach ($this->js_files as $js_file) :
                if (isset($js_file['key']) && !empty($js_file['key']) && isset($js_file['src']) && !empty($js_file['src'])) {
                    $position = (isset($js_file['position']) && !empty($js_file['position'])) ? $js_file['position'] : 'bottom';
                    $priority = (isset($js_file['priority']) && !empty($js_file['priority'])) ? $js_file['priority'] : 50;
                    $page = (isset($css_file['page']) && !empty($css_file['page'])) ? $css_file['page'] : array('all');
                    if (is_array($page)) {
                        $pages = $page;
                    } else {
                        $pages = array($page);
                    }
                    if (in_array($page_name, $pages) || in_array('all', $pages)) {
                        if (isset($js_file['load_theme']) && ($js_file['load_theme'] == true)) {
                            $theme_file_src = 'themes/'.$theme_name.'/assets/js/'.$js_file['src'];
                            if (self::isEmptyFileContet($root_path.$theme_file_src)) {
                                $this->context->controller->registerJavascript($js_file['key'], $theme_file_src, ['position' => $position, 'priority' => $priority]);
                            }
                        } else {
                            $module_file_src = 'modules/'.$this->name.'/js/'.$js_file['src'];
                            if (self::isEmptyFileContet($root_path.$module_file_src)) {
                                $this->context->controller->registerJavascript($js_file['key'], $module_file_src, ['position' => $position, 'priority' => $priority]);
                            }
                        }
                    }
                }
            endforeach;
        }
        return true;
    }
    // Display Header Hook Execute Functions
    public function hookdisplayheader($params)
    {
        $thnxbsp_numcolumn = Configuration::get('thnxbsp_numcolumn');
        Media::addJsDef(array('thnxbsp_numcolumn' => $thnxbsp_numcolumn));
        $this->Register_Css();
        $this->Register_Js();
    }
    public static function getthnxBlogPosts($ids = null)
    {
        if ($ids == null) {
            return false;
        }
        if (Module::isInstalled('thnxblog') && Module::isEnabled('thnxblog')) {
            $results = array();
            $context = Context::getContext();
            $id_lang = (int) $context->language->id;
            $id_shop = (int) $context->shop->id;
            $post_type = 'post';
            $GetAllImageTypes = thnximagetypeclass::GetAllImageTypes();
            $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'thnxposts` xc INNER JOIN `' . _DB_PREFIX_ . 'thnxposts_lang` xcl ON (xc.`id_thnxposts` = xcl.`id_thnxposts` AND xcl.`id_lang` = ' . $id_lang . ') INNER JOIN `' . _DB_PREFIX_ . 'thnxposts_shop` xcs ON (xc.`id_thnxposts` = xcs.`id_thnxposts` AND xcs.`id_shop` = ' . $id_shop . ') ';
            $sql .= ' WHERE xc.`active` = 1 AND xc.post_type = "post" AND xc.`id_thnxposts` = '.$ids;
            $queryexec = Db::getInstance()->executeS($sql);
            if (isset($queryexec) && !empty($queryexec)) {
                $i = 0;
                foreach ($queryexec as $qlvalue) {
                    if (isset($qlvalue) && !empty($qlvalue)) {
                        foreach ($qlvalue as $qkey => $qvalue) {
                            $results[$qkey] = $qvalue;
                            // start Image
                            if ($qkey == 'post_img') {
                                if (isset($GetAllImageTypes) && !empty($GetAllImageTypes)) {
                                    foreach ($GetAllImageTypes as $imagetype) {
                                        $results['post_img_' . $imagetype['name']] = thnxblog_img_uri . $imagetype['name'] . '-' . $qvalue;
                                        if (!thnxpostsclass::ImageExists($imagetype['name'] . '-' . $qvalue)) {
                                            $results['post_img_' . $imagetype['name']] = thnxblog_img_uri . $imagetype['name'] . '-noimage.jpg';
                                        }
                                    }
                                    if (!thnxpostsclass::ImageExists($qvalue)) {
                                        $results['post_img'] = 'noimage.jpg';
                                    }
                                }
                            }
                            // end Image
                            if ($qkey == 'post_author') {
                                $post_author_arr = new Employee((int) $qvalue);
                                $results['post_author_arr']['lastname'] = $post_author_arr->lastname;
                                $results['post_author_arr']['firstname'] = $post_author_arr->firstname;
                            }
                            $results['link'] = thnxblog::thnxBlogPostLink(array('id' => $qlvalue['id_thnxposts'], 'rewrite' => $qlvalue['link_rewrite'], 'page_type' => $post_type));
                            $results['post_tags'] = thnxpostsclass::GetPostTagsResults($qlvalue['id_thnxposts'], "tag");
                            if (isset($qlvalue['audio']) && !empty($qlvalue['audio'])) {
                                $results['audio_lists'] = @explode(",", $qlvalue['audio']);
                            }
                            if (isset($qlvalue['video']) && !empty($qlvalue['video'])) {
                                $results['video_lists'] = @explode(",", $qlvalue['video']);
                            }
                            if (isset($qlvalue['gallery']) && !empty($qlvalue['gallery'])) {
                                $gallery_lists = @explode(",", $qlvalue['gallery']);
                                if (isset($gallery_lists) && !empty($gallery_lists)) {
                                    $ij = 0;
                                    foreach ($gallery_lists as $gall) {
                                        $results['gallery_lists'][$ij]['main'] = thnxblog_img_uri . $gall;
                                        if (isset($GetAllImageTypes) && !empty($GetAllImageTypes)) {
                                            foreach ($GetAllImageTypes as $imagetype) {
                                                $results['gallery_lists'][$ij][$imagetype['name']] = thnxblog_img_uri . $imagetype['name'] . '-' . $gall;
                                                if (!thnxpostsclass::ImageExists($imagetype['name'] . '-' . $gall)) {
                                                    $results['gallery_lists'][$ij][$imagetype['name']] = thnxblog_img_uri . $imagetype['name'] . '-noimage.jpg';
                                                }
                                            }
                                        }
                                        $ij++;
                                    }
                                }
                            }
                            if ($qkey == 'category_default') {
                                $category_default_arr = new thnxcategoryclass((int) $qvalue);
                                $results['category_default_arr']['id'] = @$category_default_arr->id;
                                $results['category_default_arr']['name'] = @$category_default_arr->name[$id_lang];
                                $results['category_default_arr']['link_rewrite'] = @$category_default_arr->link_rewrite[$id_lang];
                                $results['category_default_arr']['title'] = @$category_default_arr->title[$id_lang];
                                $results['category_default_arr']['link'] = thnxblog::thnxBlogCategoryLink(array('id' => $category_default_arr->id, 'rewrite' => $category_default_arr->link_rewrite[$id_lang], 'page_type' => 'category', 'subpage_type' => $post_type));
                            }
                        }
                    }

                    $i++;
                }
            }
            return $results;
        } else {
            return false;
        }
    }
    // Display Header Hook Execute Functions
    public function ExecuteHook()
    {
        $id_lang = (int) $this->context->language->id;
        $thnxbsp_title = Configuration::get('thnxbsp_title_' . $id_lang);
        $thnxbsp_subtext = Configuration::get('thnxbsp_subtext_' . $id_lang);
        $thnxbsp_postcount = Configuration::get('thnxbsp_postcount');
        $thnxbsp_item_prd = Configuration::get('thnxbsp_item_prd');
        $thnxbsp_designlayout = Configuration::get('thnxbsp_designlayout');
        $thnxbsp_numcolumn = Configuration::get('thnxbsp_numcolumn');
        $thnxblogposts = array();
        if (Module::isInstalled('thnxblog') && Module::isEnabled('thnxblog')) {
            if (isset($thnxbsp_item_prd) && !empty($thnxbsp_item_prd)) {
                $thnxbsp_item_prd_arr = @explode(",", $thnxbsp_item_prd);
                if (isset($thnxbsp_item_prd_arr) && !empty($thnxbsp_item_prd_arr)) {
                    $i = 0;
                    foreach ($thnxbsp_item_prd_arr as $thnxbspvalue) {
                        if ($i < $thnxbsp_postcount) {
                            $thnxblogposts[$i] = self::getthnxBlogPosts($thnxbspvalue);
                        }
                        $i++;
                    }
                }
            }
        }
        $this->smarty->assign(
            array(
                'thnxbsp_title' => $thnxbsp_title,
                'thnxbsp_subtext' => $thnxbsp_subtext,
                'thnxbsp_postcount' => $thnxbsp_postcount,
                'thnxbsp_item_prd' => $thnxbsp_item_prd,
                'thnxbsp_designlayout' => $thnxbsp_designlayout,
                'thnxbsp_numcolumn' => $thnxbsp_numcolumn,
                'thnxblogposts' => $thnxblogposts,
            )
        );
    }
    public function renderWidget($hookName = null, array $configuration = [])
    {
        if (Module::isInstalled('thnxblog') && Module::isEnabled('thnxblog')) {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
            return $this->fetch('module:'.$this->name.'/views/templates/front/'.$this->name.'.tpl');
        } else {
            return false;
        }
    }
    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        if (Module::isInstalled('thnxblog') && Module::isEnabled('thnxblog')) {
            $id_lang = (int) $this->context->language->id;
            $thnxbsp_title = Configuration::get('thnxbsp_title_' . $id_lang);
            $thnxbsp_subtext = Configuration::get('thnxbsp_subtext_' . $id_lang);
            $thnxbsp_postcount = Configuration::get('thnxbsp_postcount');
            $thnxbsp_item_prd = Configuration::get('thnxbsp_item_prd');
            $thnxbsp_designlayout = Configuration::get('thnxbsp_designlayout');
            $thnxbsp_numcolumn = Configuration::get('thnxbsp_numcolumn');
            $thnxblogposts = array();
            if (Module::isInstalled('thnxblog') && Module::isEnabled('thnxblog')) {
                if (isset($thnxbsp_item_prd) && !empty($thnxbsp_item_prd)) {
                    $thnxbsp_item_prd_arr = @explode(",", $thnxbsp_item_prd);
                    if (isset($thnxbsp_item_prd_arr) && !empty($thnxbsp_item_prd_arr)) {
                        $i = 0;
                        foreach ($thnxbsp_item_prd_arr as $thnxbspvalue) {
                            if ($i < $thnxbsp_postcount) {
                                $thnxblogposts[$i] = self::getthnxBlogPosts($thnxbspvalue);
                            }
                            $i++;
                        }
                    }
                }
                // $thnxblogposts = self::getthnxBlogPosts($thnxbsp_item_prd, $thnxbsp_postcount);
            }
            return array(
                    'thnxbsp_title' => $thnxbsp_title,
                    'thnxbsp_subtext' => $thnxbsp_subtext,
                    'thnxbsp_postcount' => $thnxbsp_postcount,
                    'thnxbsp_item_prd' => $thnxbsp_item_prd,
                    'thnxbsp_designlayout' => $thnxbsp_designlayout,
                    'thnxbsp_numcolumn' => $thnxbsp_numcolumn,
                    'thnxblogposts' => $thnxblogposts,
                );
        } else {
            return false;
        }
    }
    public function hookdisplayhome($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogselectedposts.tpl');
    }
    public function hookdisplayFooterTop($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogdisplayfooterposts.tpl');
    }
    public function hookdisplayFooterTopFullwidth($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogdisplayfooterposts.tpl');
    }
    public function hookLeftColumn($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogdisplayleftposts.tpl');
    }
    public function hookRightColumn($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogdisplayleftposts.tpl');
    }
    public function hookdisplaythnxblogleft($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogdisplayleftposts.tpl');
    }
    public function hookdisplaythnxblogright($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogdisplayleftposts.tpl');
    }
    // Display Header Hook Execute Functions
    public function hookdisplayHomeBottom($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogselectedposts.tpl');
    }
    public function hookdisplayHomeMiddle($params)
    {
        $this->ExecuteHook();
        return $this->fetch('module:'.$this->name.'/views/templates/front/thnxblogselectedposts.tpl');
    }
}
