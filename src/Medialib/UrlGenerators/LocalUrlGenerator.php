<?php

namespace InstanCeMS\Medialib\UrlGenerators;

use InstanCeMS\Medialib\Exceptions\MediaUrlException;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\UrlGenerator as Url;

/**
 * Local Url Generator.
 *
 * @author Sean Fraser <sean@plankdesign.com>
 */
class LocalUrlGenerator extends BaseUrlGenerator
{
    /**
     * @var Url
     */
    protected $url;

    /**
     * Constructor.
     * @param Config $config
     * @param Url    $url
     */
    public function __construct(Config $config, Url $url)
    {
        parent::__construct($config);
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function isPubliclyAccessible()
    {
        return  parent::isPubliclyAccessible() || $this->isInWebroot();
    }

    /**
     * Get the path to relative to the webroot.
     * @throws MediaUrlException If media's disk is not publicly accessible
     * @return string
     */
    public function getPublicPath()
    {
        if (! $this->isPubliclyAccessible()) {
            throw MediaUrlException::mediaNotPubliclyAccessible($this->getAbsolutePath(), public_path());
        }
        if ($this->isInWebroot()) {
            $path = str_replace(public_path(), '', $this->getAbsolutePath());
        } else {
            $path = rtrim($this->getDiskConfig('prefix', 'storage'), '/').'/'.$this->media->getDiskPath();
        }

        return $this->cleanDirectorySeparators($path);
    }

    /**
     * {@inheritdoc}
     * @throws MediaUrlException If media's disk is not publicly accessible
     */
    public function getUrl()
    {
        return $this->url->asset($this->getPublicPath());
    }

    /**
     * {@inheritdoc}
     */
    public function getAbsolutePath()
    {
        return $this->getDiskConfig('root').DIRECTORY_SEPARATOR.$this->media->getDiskPath();
    }

    /**
     * Correct directory separator slashes on non-unix systems.
     * @param  string $path
     * @return string
     */
    protected function cleanDirectorySeparators($path)
    {
        if (DIRECTORY_SEPARATOR != '/') {
            $path = str_replace(DIRECTORY_SEPARATOR, '/', $path);
        }

        return $path;
    }

    private function isInWebroot()
    {
        return strpos($this->getAbsolutePath(), public_path()) === 0;
    }
}
