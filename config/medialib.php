<?php

return [
    /*
     * FQCN of the model to use for media
     *
     * Should extend `InstanCeMS\Medialib\Models\Media`
     */
    'model' => InstanCeMS\Medialib\Models\Media::class,

    /*
     * Filesystem disk to use if none is specified
     */
    'default_disk' => 'public',

    /*
     * Filesystems that can be used for media storage
     *
     * Uploader will throw an exception if a disk not in this list is selected
     */
    'allowed_disks' => [
        'public',
    ],

    /*
     * The maximum file size in bytes for a single uploaded file
     */
    'max_size' => 1024 * 1024 * 10,

    /*
     * What to do if a duplicate file is uploaded.
     *
     * Options include:
     *
     * * `'increment'`: the new file's name is given an incrementing suffix
     * * `'replace'` : the old file and media model is deleted
     * * `'error'`: an Exception is thrown
     */
    'on_duplicate' => InstanCeMS\Medialib\MediaUploader::ON_DUPLICATE_INCREMENT,

    /*
     * Reject files unless both their mime and extension are recognized and both match a single aggregate type
     */
    'strict_type_checking' => false,

    /*
     * Reject files whose mime type or extension is not recognized
     * if true, files will be given a type of `'other'`
     */
    'allow_unrecognized_types' => false,

    /*
     * Only allow files with specific MIME type(s) to be uploaded
     */
    'allowed_mime_types' => [],

    /*
     * Only allow files with specific file extension(s) to be uploaded
     */
    'allowed_extensions' => [],

    /*
     * Only allow files matching specific aggregate type(s) to be uploaded
     */
    'allowed_aggregate_types' => [],

    /*
     * List of aggregate types recognized by the application
     *
     * Each type should list the MIME types and extensions
     * that should be recognized for the type
     */
    'aggregate_types' => [
        InstanCeMS\Medialib\Models\Media::TYPE_IMAGE => [
            'mime_types' => [
                'image/jpeg',
                'image/png',
                'image/gif',
            ],
            'extensions' => [
                'jpg',
                'jpeg',
                'png',
                'gif',
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_IMAGE_VECTOR => [
            'mime_types' => [
                'image/svg+xml',
            ],
            'extensions' => [
                'svg',
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_PDF => [
            'mime_types' => [
                'application/pdf',
            ],
            'extensions' => [
                'pdf',
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_AUDIO => [
            'mime_types' => [
                'audio/aac',
                'audio/ogg',
                'audio/mpeg',
                'audio/mp3',
                'audio/mpeg',
                'audio/wav'
            ],
            'extensions' => [
                'aac',
                'ogg',
                'oga',
                'mp3',
                'wav',
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_VIDEO => [
            'mime_types' => [
                'video/mp4',
                'video/mpeg',
                'video/ogg',
                'video/webm'
            ],
            'extensions' => [
                'mp4',
                'm4v',
                'mov',
                'ogv',
                'webm'
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_ARCHIVE => [
            'mime_types' => [
                'application/zip',
                'application/x-compressed-zip',
                'multipart/x-zip',
            ],
            'extensions' => [
                'zip',
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_DOCUMENT => [
            'mime_types' => [
                'text/plain',
                'application/plain',
                'text/xml',
                'text/json',
                'application/json',
                'application/msword',
                'application/application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ],
            'extensions' => [
                'doc',
                'docx',
                'txt',
                'text',
                'xml',
                'json',
            ]
        ],
        InstanCeMS\Medialib\Models\Media::TYPE_SPREADSHEET => [
            'mime_types' => [
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
            'extensions' => [
                'xls',
                'xlsx',
            ]
        ],
    ],

    /*
     * List of adapters to use for various source inputs
     *
     * Adapters can map either to a class or a pattern (regex)
     */
    'source_adapters' => [
        'class' => [
            Symfony\Component\HttpFoundation\File\UploadedFile::class 
            => InstanCeMS\Medialib\Adapters\UploadedFileAdapter::class,
            
            Symfony\Component\HttpFoundation\File\File::class 
            => InstanCeMS\Medialib\Adapters\FileAdapter::class,
        ],
        'pattern' => [
            '^https?://' => InstanCeMS\Medialib\Adapters\RemoteUrlAdapter::class,
            '^/' => InstanCeMS\Medialib\Adapters\LocalPathAdapter::class
        ],
    ],

    /*
     * List of URL Generators to use for handling various filesystem drivers
     *
     */
    'url_generators' => [
        'local' => InstanCeMS\Medialib\UrlGenerators\LocalUrlGenerator::class,
        's3' => InstanCeMS\Medialib\UrlGenerators\S3UrlGenerator::class,
    ],

    /**
     * Should mediable instances automatically reload their media relationships after modification are made to a tag.
     *
     * If true, will automatically reload media the next time `getMedia()`, `getMediaMatchAll()` or `getAllMediaByTag()` are called.
     */
    'rehydrate_media' => true,

    /**
     * Detach associated media when mediable model is soft deleted.
     */
    'detach_on_soft_delete' => false,
];
