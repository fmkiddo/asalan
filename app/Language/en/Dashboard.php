<?php

return array (
    'title'     => 'Asset Management System by FMKiddo | Dashboard - {0}',
    'topbar'    => array (
        'welcome'       => 'Hi, {0}, welcome back!',
        'notif_title'   => 'Notifications',
        'notif_seeall'  => 'See all notifications',
        'msgs_title'    => 'Messages',
        'msgs_empty'    => 'There is no new messages!',
        'msgs_seeall'   => 'See all messages',
        'acc_title'     => 'Account',
        'profile'       => 'Account Profile',
        'about'         => 'About',
        'sign_out'      => 'Sign Out',
    ),
    'nav'       => array (
        't_sidebar'     => 'Navigation',
        'dashboard'     => 'Dashboard',
        'fixedasset'    => 'Fixed Assets',
        'location'      => 'Locations',
        'flow_asset'    => 'Asset Flows',
        'sm_flow_asset' => array (
            'title0'        => 'Request Menu',
            'title1'        => 'Asset Flow Menu',
            'action0'       => 'Asset Request',
            'action1'       => 'Asset Procurement',
            'action2'       => 'Asset Transfer',
            'action3'       => 'Asset Receive',
            'action4'       => 'Asset Disposal'
        ),
        'maintenance'   => 'Maintenance',
        'm_users'       => 'Users',
        'sm_users'      => array (
            'title'         => 'Users Menu',
            'action0'       => 'Access Control',
            'action1'       => 'Users',
        ),
        'file_manager'  => 'File Management',
        'settings'      => 'Settings',
        'sm_settings'   => array (
            'title'         => 'Configuration Menu',
            'settings0'     => 'Categories',
            'settings1'     => 'Configurations',
        ),
        'manual'        => 'Documentation'
    ),
    'settings'  => array (
        'language'      => 'language',
        'theme'         => 'Theme Color',
        'theme_color'   => array (
            'dark'          => 'Dark',
            'light'         => 'Light'
        ),
        'topbar'        => 'Bar Color',
        'topbar_color'  => array (
            'green'         => 'Green',
            'yellow'        => 'Yellow',
            'red'           => 'Red',
            'white'         => 'White',
            'blue'          => 'Blue',
            'black'         => 'Black',
            'theme'         => 'Primary',
            'default'       => 'Default',
        ),
    ),
    'status'    => array (
        'Pending',
        'Approved',
        'Sent',
        'Received',
        'Distributed',
        'Declined',
        'Procured',
    ),
    'reqtype'   => array (
        'Unknown',
        'Transfer Request',
        'Removal Request',
        'Procurement Request',
    ),
    'alerts'  => array (
        'titles'    => array (
            'Error',
        ),
        'messages'  => array (
            'Please, pick location first!',
            'Please, pick location of origin first!'
        )
    ),
    'texts'     => array (
        'common'   => array (
            'add'       => 'Add',
            'reload'    => 'Reload',
            'update'    => 'Update',
            'delete'    => 'Hapus',
            'more'      => 'More',
            'save'      => 'Save',
            'cancel'    => 'Cancel',
            'created'   => 'Created At',
            'na'        => 'Not Available',
            'details'   => 'Details',
            'deactive'  => 'Deactivate',
            'upload'    => 'Upload',
            'user'      => 'Username: {0}',
        ),
        'users'     => array (
            'title'     => 'Pengguna',
            'tableh0'   => 'Username',
            'tableh1'   => 'Level Akses',
            'tableh2'   => 'Email',
            'tableh3'   => 'Status',
            'modal'     => array (
                'title0'    => 'Update User Data',
                'title1'    => 'User Details',
                'subtitle0' => 'User Allocation',
                'label0'    => 'Username',
                'label1'    => 'Email',
                'label2'    => 'Confirm Email',
                'label3'    => 'Password',
                'label4'    => 'Confirm Password',
                'label5'    => 'Access Level',
                'label6'    => 'Active',
                'disabled'  => 'Choose Access Level',
                't_chkall'  => 'Check All',
                'th1_0'     => 'Location Code',
                'th1_1'     => 'Location Name',
            ),
        ),
        'controls'  => array (
            'title'     => 'Access Control',
            'tableh0'   => 'Code',
            'tableh1'   => 'Description',
            'tableh2'   => 'Procure',
            'tableh3'   => 'Disposal',
            'tableh4'   => 'Transfer',
            'modal'     => array (
                'title'     => 'Update Access Control Data',
                'label0'    => 'Code',
                'label1'    => 'Description',
                'label2'    => 'Authority',
                'label3'    => 'Procure',
                'label4'    => 'Disposal',
                'label5'    => 'Transfer',
                'label6'    => 'Access Level',
                'label7'    => 'Full Access',
                'label8'    => 'Alamat Email',
                'label9'    => 'Konfirmasi Email',
                'label10'    => 'Kata Sandi',
                'label11'    => 'Konfirmasi Kata Sandi',
                'label12'    => 'Nama Pengguna',
                'label13'    => 'Alamat Email',
                'label14'    => 'Konfirmasi Email',
                'label15'    => 'Kata Sandi',
                'label16'    => 'Konfirmasi Kata Sandi',
                'label17'    => 'Level Akses',
                'label18'    => 'Aktif',
                'label19'    => 'Nama Pengguna',
                'label20'    => 'Alamat Email',
            ),
        ),
        'ci'        => array (
            'title0'    => 'Attributes',
            'title1'    => 'Configuration Items',
            'tableh0'   => 'Code',
            'tableh1'   => 'Description',
            'tableh2'   => 'Depreciation',
            'tableh3'   => 'Salvage Value',
            'tabh0'     => 'Attributes',
            'tabh1'     => 'Configurations',
            'datatype'  => array (
                'text'              => 'Text',
                'date'              => 'Date',
                'list'              => 'List',
                'prepopulated-list' => 'Prepopulated List'
            ),
            'modal'     => array (
                'title0'    => 'Update Attributes',
                'title1'    => 'Update Configuration Items',
                'label0'    => 'Name',
                'label1'    => 'Attribute Type',
                'label2'    => 'Code',
                'label3'    => 'Description',
                'label4'    => 'Attributes',
                'label5'    => 'List Value',
                'label6'    => 'Depreciation Type',
                'label7'    => 'Salvage Percentage',
                'opt0'      => 'Choose attribute type',
                'opt1'      => 'Text',
                'opt2'      => 'Date',
                'opt3'      => 'List',
                'opt4'      => 'Pre-filled List',
                'depreopt0' => 'Choose depreciation method',
                'depreopt1' => 'Straight-line',
                'depreopt2' => 'Double declining balance',
                'depreopt3' => 'Units of production',
                'depreopt4' => 'Sum of years digits',
            ),
        ),
        'locations' => array (
            'title0'        => 'Registered Locations',
            'title1'        => 'Location Details',
            'title2'        => 'Sublocation Details',
            'title3'        => 'Location Assets Details',
            'thlocation0'   => 'Code',
            'thlocation1'   => 'Description',
            'thlocation2'   => 'Address',
            'thlocation3'   => 'Phone',
            'thlocation4'   => 'Contact Person',
            'thlocation5'   => 'Email',
            'thlocation6'   => 'Notes',
            'thlocation7'   => 'Created At',
            'modal'         => array (
                'mdl_title0'    => 'Locations Data Update',
                'mdl_title1'    => 'Location Details',
                'mdl_title2'    => 'Sublocation Data Update',
                'loclabel0'     => 'Code',
                'loclabel1'     => 'Description',
                'loclabel2'     => 'Address',
                'loclabel3'     => 'Phone',
                'loclabel4'     => 'Contact Person',
                'loclabel5'     => 'Email',
                'loclabel6'     => 'Notes',
                'loclabel7'     => 'Sublocation Code',
                'loclabel8'     => 'Description',
                'text_details'  => 'Locaton Details',
                'text_sublocs'  => 'Sublocations Details',
                'text_assets'   => 'Assets Details',
                'thsubloc0'     => 'Code',
                'thsubloc1'     => 'Description',
                'thsubloc2'     => 'Created At',
                'thsubasset0'   => 'Code',
                'thsubasset1'   => 'Description',
                'thsubasset2'   => 'Category',
                'thsubasset3'   => 'Sublocation',
                'thsubasset4'   => 'Quantity',
            )
        ),
        'assets'    => array (
            'title0'    => 'Assets Database',
            'thasset0'  => 'Category',
            'thasset1'  => 'Code',
            'thasset2'  => 'Description',
            'thasset3'  => 'Quantity',
            'modal'     => array (
                'title0'        => 'Asset Data Update',
                'title1'        => 'Asset Details',
                'subtitle0'     => 'Details',
                'subtitle1'     => 'Images',
                'fa_label0'     => 'Location',
                'fa_label1'     => 'Sublocation',
                'fa_label2'     => 'Configuration Item - Category',
                'fa_label3'     => 'Serial Number',
                'fa_label4'     => 'Description',
                'fa_label5'     => 'Acquisition Date',
                'fa_label6'     => 'Acquisition Cost (IDR)',
                'fa_label7'     => 'Total Assets',
                'fa_label8'     => 'Lifespan (Year)',
                'fa_label9'     => 'Remarks',
                'disabled'      => array (
                    'disabled_opt0' => 'Choose location',
                    'disabled_opt1' => 'Choose sublocation',
                    'disabled_opt2' => 'Choose configuration item/category',
                ),
                'tabs'          => array (
                    'titles'        => array (
                        'fa_tab0'       => 'Assets Map',
                        'fa_tab1'       => 'Procurement History',
                        'fa_tab2'       => 'Removal History',
                        'fa_tab3'       => 'Stock Card',
                    ),
                    'details0'      => array (
                        'thead0'        => 'Location',
                        'thead1'        => 'Sublocation',
                        'thead2'        => 'Qty',
                    ),
                    'details1'      => array (
                        
                    ),
                    'details2'      => array (
                        
                    ),
                ),
            ),
        ),
        'asset-request'         => array (
            'titles'                => array (
                'title'                 => array (
                    'Asset Requests Module',
                    'Asset Procurement Requests Form',
                ),
                'card'                  => array (
                    '# of Request Documents',
                    '# of Procuremnts',
                    '# of Asset Transfer',
                    '# of Asset Removal',
                ),
                'header'                => array (
                    array (
                        'Document #',
                        'Date',
                        'Type of Request',
                        'Applicant',
                        'Status'
                    ),
                    array (
                        'Code',
                        'Description',
                        'Est. Price',
                        'Qty',
                        'Remarks',
                    ),
                    array (
                        'Code',
                        'Description',
                        'Sublocation',
                        'Qty',
                    ),
                    array (
                        'Category',
                        'Code',
                        'Description',
                        'Sublocation',
                        'Qty'
                    ),
                ),
            ),
            'labels'                => array (
                'tabs'                  => array (
                    'Request Summaries',
                    'Asset Procurement Request',
                    'Asset Transfer Request',
                    'Asset Removal Request',
                ),
                'disabled_opts'         => array (
                    'Choose type of procurement',
                    'Choose locations',
                    'Choose transfer origin',
                    'Choose transfer destination',
                    'Choose sublocation',
                    'Choose asset origin',
                ),
                'procure_type'          => array (
                    'Unregistered Asset',
                    'Existing/Registered Asset'
                ),
                'form_labels'           => array (
                    array (
                        'Location',
                        'Date',
                        'Applicant',
                        'Name',
                        'Description',
                        'Approximate Price',
                        'Qty',
                        'Remarks',
                        'Images',
                        'Upload',
                        'Clear',
                        'Search asset',
                    ),
                    array (
                        'Document #',
                        'Date',
                        'Applicant',
                        'Origin',
                        'Destination',
                        'Remarks',
                        'Search'
                    ),
                    array (
                        'Location',
                        'Date',
                        'Applicant',
                        'Search',
                    ),
                ),
            ),
        ),
        'asset-procure'         => array (
            'titles'                => array (
                'title'                 => array (
                    'Asset Procurement Requests',
                ),
                'card'                  => array (
                    '# of Documents',
                    'Waiting for Reviews',
                    'Approved | Declined | Done'
                ),
            ),
            'tableHeaders'          => array (
                'documents'             => array (
                    'Document #',
                    'Date',
                    'Applicant',
                    'Location',
                    'Status'
                ),
            ),
        ),
        'asset-transfer'        => array (
            'titles'                => array (
                'Asset Transfer',
                'Asset Transfer Document Details',
                'Asset List at',
            ),
            'ctitle'                => array (
                'Total Transfer',
                'Total Waiting',
                'Declined | Approved | On Progress | Done',
            ),
            'labels'                => array (
                'Document #',
                'Date',
                'Applicant',
                'Origin',
                'Destination',
                'Remarks'
            ),
            'disabled-opts'         => array (
                'Choose origin',
                'Choose destination',
                'Choose sublocation'
            ),
            'placeholders'          => array (
                'Search'
            ),
            'table-headers'         => array (
                'summaries'             => array (
                    'Document #',
                    'Date',
                    'Applicant',
                    'Status',
                    'Approval',
                    'Approval Date',
                ),
                'form'                  => array (
                    'Code',
                    'Descriptions',
                    'Origin Sublocation',
                    'Qty'
                ),
                'asset-select'          => array (
                    'Code',
                    'Description',
                    'Sublocation',
                    'Qty',
                ),
            ),
        ),
    ),
    'Errors'    => array (
        '404'           => '404 - Halaman yang anda cari tidak ditemukan!'
    )
);