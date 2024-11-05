<?php
namespace App\Libraries;


class LangLoader {
    
    private $locale;
    
    private $langMap    = array (
        'topbar'    => array (
            'welcome_tagline'   => 'Dashboard.topbar.welcome',
            'top_notif_heading' => 'Dashboard.topbar.notif_title',
            'top_notif_seeall'  => 'Dashboard.topbar.notif_seeall',
            'top_msgs_heading'  => 'Dashboard.topbar.msgs_title',
            'top_msgs_empty'    => 'Dashboard.topbar.msgs_empty',
            'top_msgs_seeall'   => 'Dashboard.topbar.msgs_seeall',
            'top_acc_heading'   => 'Dashboard.topbar.acc_title',
            'top_acc_menu1'     => 'Dashboard.topbar.profile',
            'top_acc_menu2'     => 'Dashboard.topbar.about',
            'top_acc_signout'   => 'Dashboard.topbar.sign_out',
        ),
        'nav'       => array (
            'tm_sidebar'        => 'Dashboard.nav.t_sidebar',
            'tm_dashboard'      => 'Dashboard.nav.dashboard',
            'tm_asset'          => 'Dashboard.nav.fixedasset',
            'tm_location'       => 'Dashboard.nav.location',
            'tm_asset_flow'     => 'Dashboard.nav.flow_asset',
            'tsm_flow_title0'   => 'Dashboard.nav.sm_flow_asset.title0',
            'tsm_flow_title1'   => 'Dashboard.nav.sm_flow_asset.title1',
            'tsm_flow_action0'  => 'Dashboard.nav.sm_flow_asset.action0',
            'tsm_flow_action1'  => 'Dashboard.nav.sm_flow_asset.action1',
            'tsm_flow_action2'  => 'Dashboard.nav.sm_flow_asset.action2',
            'tsm_flow_action3'  => 'Dashboard.nav.sm_flow_asset.action3',
            'tm_maintenance'    => 'Dashboard.nav.maintenance',
            'tm_users'          => 'Dashboard.nav.m_users',
            'tsm_user_title'    => 'Dashboard.nav.sm_users.title',
            'tsm_user_action0'  => 'Dashboard.nav.sm_users.action0',
            'tsm_user_action1'  => 'Dashboard.nav.sm_users.action1',
            'tm_file_manager'   => 'Dashboard.nav.file_manager',
            'tm_settings'       => 'Dashboard.nav.settings',
            'tsm_setting_title' => 'Dashboard.nav.sm_settings.title',
            'ts_settings0'      => 'Dashboard.nav.sm_settings.settings0',
            'ts_settings1'      => 'Dashboard.nav.sm_settings.settings1',
            'ts_settings2'      => 'Dashboard.nav.sm_settings.settings2',
            'tm_manual'         => 'Dashboard.nav.manual',
        ),
        'settings'  => array (
            'lang_text'         => 'Dashboard.settings.language',
            'theme_text'        => 'Dashboard.settings.theme',
            'light_text'        => 'Dashboard.settings.theme_color.light',
            'dark_text'         => 'Dashboard.settings.theme_color.dark',
            'primary_text'      => 'Dashboard.settings.topbar',
        )
    );
    
    /**
     * 
     * @param string $locale
     */
    public function __contruct ($locale='id') {
        $this->locale = $locale;
    }
    
    public function getLanguage ($key, $parameter='') {
        if (!array_key_exists($key, $this->langMap)) return FALSE;
        $lang   = array ();
        $map    = $this->langMap[$key];
        foreach ($map as $k => $v) $lang[$k] = lang ($v, [$parameter], $this->locale);
        return $lang;
    }
}