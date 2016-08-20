<?php

class extension_asset_pipeline_stylus extends Extension
{
    public function getSubscribedDelegates()
    {
        return array(
            array(
                'page' => '/extension/asset_pipeline/',
                'delegate' => 'RegisterPlugins',
                'callback' => 'register'
            )
        );
    }

    function register($context)
    {
        $context['plugins']['styl'] = array('output_type' => 'css', 'driver' => $this);
    }

    public function compile($content, $import_dir = null)
    {
        $result = shell_exec(
            'node ' . escapeshellarg(__DIR__ . '/lib/compile.js') . ' ' . escapeshellarg($content) . ' ' . escapeshellarg($import_dir)
        );
        $pos = strpos($result, ' ');
        return array(substr($result, 0, $pos) => substr($result, $pos + 1));
    }

    /*public function compile($content, $import_dir = null)
    {
        return asset_pipeline\Pipeline::callNodejs(
            array(__DIR__ . '/lib/compile.js', $content, $import_dir)
        );
    }*/
}
