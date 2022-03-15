<?php

// 惯例配置

use App\Enums\ConfigKey;
use App\Enums\GroupConfigKey;
use App\Enums\Mail\SmtpOption;
use App\Enums\Scan\AliyunOption;
use App\Enums\Watermark\FontOption;
use App\Enums\Watermark\ImageOption;

return [
    'app' => [
        ConfigKey::AppName => 'Lsky Pro',
        ConfigKey::AppVersion => 'V 2.0',
        ConfigKey::SiteKeywords => 'Lsky Pro,lsky,兰空图床',
        ConfigKey::SiteDescription => 'Lsky Pro, Your photo album on the cloud.',
        ConfigKey::SiteNotice => '',
        ConfigKey::IcpNo => '',
        ConfigKey::IsEnableRegistration => 1,
        ConfigKey::IsEnableGallery => 1,
        ConfigKey::IsEnableApi => 1,
        ConfigKey::IsAllowGuestUpload => 1,
        ConfigKey::UserInitialCapacity => 512000,
        ConfigKey::IsUserNeedVerify => 0,
        ConfigKey::Mail => [
            'default' => 'smtp',
            'mailers' => [
                'smtp' => [
                    SmtpOption::Transport => 'smtp',
                    SmtpOption::Host => 'smtp.mailgun.org',
                    SmtpOption::Port => 587,
                    SmtpOption::Encryption => 'tls',
                    SmtpOption::Username => '',
                    SmtpOption::Password => '',
                    SmtpOption::Timeout => null,
                ]
            ],
        ],
        ConfigKey::Group => [
            GroupConfigKey::MaximumFileSize => 5120,
            GroupConfigKey::ConcurrentUploadNum => 3,
            GroupConfigKey::IsEnableScan => 0,
            GroupConfigKey::IsEnableWatermark => 0,
            GroupConfigKey::IsEnableOriginalProtection => 0,
            GroupConfigKey::ScannedAction => 'mark', // in mark or delete
            GroupConfigKey::ScanConfigs => [
                'driver' => 'aliyun',
                'drivers' => [
                    'aliyun' => [
                        AliyunOption::AccessKeyId => '',
                        AliyunOption::AccessKeySecret => '',
                        AliyunOption::RegionId => '',
                        AliyunOption::Scenes => ['porn'],
                        AliyunOption::BizType => '',
                    ],
                ],
            ],
            GroupConfigKey::WatermarkConfigs => [
                'driver' => 'font',
                'drivers' => [
                    'font' => [
                        FontOption::Text => 'Lsky Pro',
                        FontOption::Position => 'bottom-right',
                        FontOption::Angle => 0,
                        FontOption::Size => 50,
                        FontOption::Font => '',
                        FontOption::Color => '#000000',
                        FontOption::X => 10,
                        FontOption::Y => 10,
                    ],
                    'image' => [
                        ImageOption::Image => '',
                        ImageOption::Position => 'bottom-right',
                        ImageOption::Opacity => 100,
                        ImageOption::Rotate => 0,
                        ImageOption::Width => 0,
                        ImageOption::Height => 0,
                        ImageOption::X => 10,
                        ImageOption::Y => 10,
                    ]
                ],
            ],
            GroupConfigKey::LimitPerMinute => 20,
            GroupConfigKey::LimitPerHour => 100,
            GroupConfigKey::LimitPerDay => 300,
            GroupConfigKey::LimitPerWeek => 600,
            GroupConfigKey::LimitPerMonth => 999,
            GroupConfigKey::AcceptedFileSuffixes => ['jpeg', 'jpg', 'png', 'gif', 'tif', 'bmp', 'ico', 'psd', 'webp'],
            GroupConfigKey::PathNamingRule => '{Y}/{m}/{d}',
            GroupConfigKey::FileNamingRule => '{uniqid}',
            GroupConfigKey::ImageCacheTtl => 2626560,
        ],
    ],
];
