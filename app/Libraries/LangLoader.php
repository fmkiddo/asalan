<?php
namespace App\Libraries;


class LangLoader {
    
    private $locale;
    
    private $maps       = array (
        'users'             => 'dash_users_texts',
        'acl'               => 'dash_acl_texts',
        'categories'        => 'dash_configitems_texts',
        'master-asset'      => 'dash_fixedasset_texts',
        'locations'         => 'dash_locations_text',
        'flow-request'      => 'dash_assetrqst_texts',
    );
    
    private $langMap    = array (
        'topbar'        => array (
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
        'nav'           => array (
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
            'tsm_flow_action4'  => 'Dashboard.nav.sm_flow_asset.action4',
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
        'settings'      => array (
            'lang_text'         => 'Dashboard.settings.language',
            'theme_text'        => 'Dashboard.settings.theme',
            'light_text'        => 'Dashboard.settings.theme_color.light',
            'dark_text'         => 'Dashboard.settings.theme_color.dark',
            'primary_text'      => 'Dashboard.settings.topbar',
        ),
        'commons'       => array (
            'btn_add'           => 'Dashboard.texts.common.add',
            'btn_reload'        => 'Dashboard.texts.common.reload',
            'btn_update'        => 'Dashboard.texts.common.update',
            'btn_save'          => 'Dashboard.texts.common.save',
            'btn_cancel'        => 'Dashboard.texts.common.cancel',
            'btn_remove'        => 'Dashboard.texts.common.delete',
            'th_created'        => 'Dashboard.texts.common.created',
            'empty_list'        => 'Dashboard.texts.common.na',
        ),
        'users'         => array (
            'users_title'           => 'Dashboard.texts.users.title',
            'th_username'           => 'Dashboard.texts.users.tableh0',
            'th_usergroup'          => 'Dashboard.texts.users.tableh1',
            'th_email'              => 'Dashboard.texts.users.tableh2',
            'th_isactive'           => 'Dashboard.texts.users.tableh3',
            'mdl_title_userform'    => 'Dashboard.texts.users.modal.title',
            'label_username'        => 'Dashboard.texts.users.modal.label0',
            'label_email'           => 'Dashboard.texts.users.modal.label1',
            'label_cemail'          => 'Dashboard.texts.users.modal.label2',
            'label_password'        => 'Dashboard.texts.users.modal.label3',
            'label_cpassword'       => 'Dashboard.texts.users.modal.label4',
            'label_accesstype'      => 'Dashboard.texts.users.modal.label5',
            'label_active'          => 'Dashboard.texts.users.modal.label6',
            'opt_disabled_acl'      => 'Dashboard.texts.users.modal.disabled',
        ),
        'acl'           => array (
            'acl_title'             => 'Dashboard.texts.controls.title',
            'th_code'               => 'Dashboard.texts.controls.tableh0',
            'th_name'               => 'Dashboard.texts.controls.tableh1',
            'th_caprv'              => 'Dashboard.texts.controls.tableh2',
            'th_crmv'               => 'Dashboard.texts.controls.tableh3',
            'th_csend'              => 'Dashboard.texts.controls.tableh4',
            'mdl_title_controlform' => 'Dashboard.texts.controls.modal.title',
            'label_gcode'           => 'Dashboard.texts.controls.modal.label0',
            'label_gdscript'        => 'Dashboard.texts.controls.modal.label1',
            'label_control'         => 'Dashboard.texts.controls.modal.label2',
            'label_canapprove'      => 'Dashboard.texts.controls.modal.label3',
            'label_canremove'       => 'Dashboard.texts.controls.modal.label4',
            'label_cansend'         => 'Dashboard.texts.controls.modal.label5',
            'label_access'          => 'Dashboard.texts.controls.modal.label6',
            'label_accessall'       => 'Dashboard.texts.controls.modal.label7',
            'label_access0'         => 'Dashboard.texts.controls.modal.label8',
            'label_access1'         => 'Dashboard.texts.controls.modal.label9',
            'label_access2'         => 'Dashboard.texts.controls.modal.label10',
            'label_access3'         => 'Dashboard.texts.controls.modal.label11',
            'label_access4'         => 'Dashboard.texts.controls.modal.label12',
            'label_access5'         => 'Dashboard.texts.controls.modal.label13',
            'label_access6'         => 'Dashboard.texts.controls.modal.label14',
            'label_access7'         => 'Dashboard.texts.controls.modal.label15',
            'label_access8'         => 'Dashboard.texts.controls.modal.label16',
            'label_access9'         => 'Dashboard.texts.controls.modal.label17',
            'label_access10'        => 'Dashboard.texts.controls.modal.label18',
            'label_access11'        => 'Dashboard.texts.controls.modal.label19',
            'label_access12'        => 'Dashboard.texts.controls.modal.label20',
        ),
        'categories'    => array (
            'components_title'      => 'Dashboard.texts.ci.title0',
            'ci_title'              => 'Dashboard.texts.ci.title1',
            'tab_0'                 => 'Dashboard.texts.ci.tabh0',
            'tab_1'                 => 'Dashboard.texts.ci.tabh1',
            'th_ci0'                => 'Dashboard.texts.ci.tableh0',
            'th_ci1'                => 'Dashboard.texts.ci.tableh1',
            'th_ci2'                => 'Dashboard.texts.ci.tableh2',
            'th_ci3'                => 'Dashboard.texts.ci.tableh3',
            'mdl_title_ci0'         => 'Dashboard.texts.ci.modal.title0',
            'mdl_title_ci1'         => 'Dashboard.texts.ci.modal.title1',
            'ci_label0'             => 'Dashboard.texts.ci.modal.label0',
            'ci_label1'             => 'Dashboard.texts.ci.modal.label1',
            'ci_label2'             => 'Dashboard.texts.ci.modal.label2',
            'ci_label3'             => 'Dashboard.texts.ci.modal.label3',
            'ci_label4'             => 'Dashboard.texts.ci.modal.label4',
            'plist_value_text'      => 'Dashboard.texts.ci.modal.label5',
            'ci_label6'             => 'Dashboard.texts.ci.modal.label6',
            'ci_label7'             => 'Dashboard.texts.ci.modal.label7',
            'ci_disabled_opt0'      => 'Dashboard.texts.ci.modal.opt0',
            'ci_prop_type0'         => 'Dashboard.texts.ci.modal.opt1',
            'ci_prop_type1'         => 'Dashboard.texts.ci.modal.opt2',
            'ci_prop_type2'         => 'Dashboard.texts.ci.modal.opt3',
            'ci_prop_type3'         => 'Dashboard.texts.ci.modal.opt4',
            'ci_depre_disabled'     => 'Dashboard.texts.ci.modal.depreopt0',
            'ci_depre_opt1'         => 'Dashboard.texts.ci.modal.depreopt1',
            'ci_depre_opt2'         => 'Dashboard.texts.ci.modal.depreopt2',
            'ci_depre_opt3'         => 'Dashboard.texts.ci.modal.depreopt3',
            'ci_depre_opt4'         => 'Dashboard.texts.ci.modal.depreopt4',
        ),
        'locations'     => array (
            'title0'                => 'Dashboard.texts.locations.title0',
            'title1'                => 'Dashboard.texts.locations.title1',
            'title2'                => 'Dashboard.texts.locations.title2',
            'title3'                => 'Dashboard.texts.locations.title3',
            'title4'                => 'Dashboard.texts.locations.title4',
            'th_location0'          => 'Dashboard.texts.locations.thlocation0',
            'th_location1'          => 'Dashboard.texts.locations.thlocation1',
            'th_location2'          => 'Dashboard.texts.locations.thlocation2',
            'th_location3'          => 'Dashboard.texts.locations.thlocation3',
            'th_location4'          => 'Dashboard.texts.locations.thlocation4',
            'th_location5'          => 'Dashboard.texts.locations.thlocation5',
            'th_location6'          => 'Dashboard.texts.locations.thlocation6',
            'th_location7'          => 'Dashboard.texts.locations.thlocation7',
            'th_sublocation0'       => 'Dashboard.texts.locations.modal.thsubloc0',
            'th_sublocation1'       => 'Dashboard.texts.locations.modal.thsubloc1',
            'th_sublocation2'       => 'Dashboard.texts.locations.modal.thsubloc2',
            'th_locasset0'          => 'Dashboard.texts.locations.modal.thsubasset0',
            'th_locasset1'          => 'Dashboard.texts.locations.modal.thsubasset1',
            'th_locasset2'          => 'Dashboard.texts.locations.modal.thsubasset2',
            'th_locasset3'          => 'Dashboard.texts.locations.modal.thsubasset3',
            'th_locasset4'          => 'Dashboard.texts.locations.modal.thsubasset4',
            'mdl_title_location0'   => 'Dashboard.texts.locations.modal.mdl_title0',
            'mdl_title_location1'   => 'Dashboard.texts.locations.modal.mdl_title1',
            'mdl_title_location2'   => 'Dashboard.texts.locations.modal.mdl_title2',
            'btn_details'           => 'Dashboard.texts.locations.modal.text_details',
            'btn_sublocations'      => 'Dashboard.texts.locations.modal.text_sublocs',
            'btn_assets'            => 'Dashboard.texts.locations.modal.text_assets',
            'text_label0'           => 'Dashboard.texts.locations.modal.loclabel0',
            'text_label1'           => 'Dashboard.texts.locations.modal.loclabel1',
            'text_label2'           => 'Dashboard.texts.locations.modal.loclabel2',
            'text_label3'           => 'Dashboard.texts.locations.modal.loclabel3',
            'text_label4'           => 'Dashboard.texts.locations.modal.loclabel4',
            'text_label5'           => 'Dashboard.texts.locations.modal.loclabel5',
            'text_label6'           => 'Dashboard.texts.locations.modal.loclabel6',
            'text_label7'           => 'Dashboard.texts.locations.modal.loclabel0',
            'text_label8'           => 'Dashboard.texts.locations.modal.loclabel7',
            'text_label9'           => 'Dashboard.texts.locations.modal.loclabel8',
        ),
        'master-asset'  => array (
            'asset_title'           => 'Dashboard.texts.assets.title0',
            'th_fasset0'            => 'Dashboard.texts.assets.thasset0',
            'th_fasset1'            => 'Dashboard.texts.assets.thasset1',
            'th_fasset2'            => 'Dashboard.texts.assets.thasset2',
            'th_fasset3'            => 'Dashboard.texts.assets.thasset3',
            'mdl_fasset_form_title' => 'Dashboard.texts.assets.modal.form_title0',
            'fasset_label0'         => 'Dashboard.texts.assets.modal.fa_label0',
            'fasset_label1'         => 'Dashboard.texts.assets.modal.fa_label1',
            'fasset_label2'         => 'Dashboard.texts.assets.modal.fa_label2',
            'fasset_label3'         => 'Dashboard.texts.assets.modal.fa_label3',
            'fasset_label4'         => 'Dashboard.texts.assets.modal.fa_label4',
            'fasset_label5'         => 'Dashboard.texts.assets.modal.fa_label5',
            'fasset_label6'         => 'Dashboard.texts.assets.modal.fa_label6',
            'fasset_label7'         => 'Dashboard.texts.assets.modal.fa_label7',
            'fasset_label8'         => 'Dashboard.texts.assets.modal.fa_label8',
            'fasset_label9'         => 'Dashboard.texts.assets.modal.fa_label9',
            'fasset_dopttext0'      => 'Dashboard.texts.assets.modal.disabled.disabled_opt0',
            'fasset_dopttext1'      => 'Dashboard.texts.assets.modal.disabled.disabled_opt1',
            'fasset_dopttext2'      => 'Dashboard.texts.assets.modal.disabled.disabled_opt2',
            'fasset_tab0'           => 'Dashboard.texts.assets.modal.tabs.tab_buttons.fa_tab0',
            'fasset_tab1'           => 'Dashboard.texts.assets.modal.tabs.tab_buttons.fa_tab1',
            'fasset_tab2'           => 'Dashboard.texts.assets.modal.tabs.tab_buttons.fa_tab2',
            'fasset_tab_title0'     => 'Dashboard.texts.assets.modal.tabs.titles.title0',
            'fasset_tab_title1'     => 'Dashboard.texts.assets.modal.tabs.titles.title1',
            'fasset_tab_title2'     => 'Dashboard.texts.assets.modal.tabs.titles.title2',
            'fadetail0_thead0'      => 'Dashboard.texts.assets.modal.tabs.details0.thead0',
            'fadetail0_thead1'      => 'Dashboard.texts.assets.modal.tabs.details0.thead1',
            'fadetail0_thead2'      => 'Dashboard.texts.assets.modal.tabs.details0.thead2',
        ),
        'flow-request'  => array (
            
        ),
    );
    
    /**
     * 
     * @param string $locale
     */
    public function __contruct ($locale='id') {
        $this->locale = $locale;
    }
    
    public function getVariableMapping (string $routes) {
        if (!array_key_exists($routes, $this->maps)) return FALSE;
        return $this->maps[$routes];
    }
    
    /**
     * 
     * @param string $key
     * @param string $parameter
     * @return boolean|list<string>[]|string[]
     */
    public function getLanguage (string $key, $parameter='') {
        if (!array_key_exists($key, $this->langMap)) return FALSE;
        $lang   = array ();
        $map    = $this->langMap[$key];
        foreach ($map as $k => $v) $lang[$k] = lang ($v, [$parameter], $this->locale);
        return $lang;
    }
}