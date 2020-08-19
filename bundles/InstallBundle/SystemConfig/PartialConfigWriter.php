<?php


namespace Pimcore\Bundle\InstallBundle\SystemConfig;


class PartialConfigWriter
{
    /**
     * @var ConfigWriter
     */
    private $configWriter;

    /**
     * @var array
     */
    private $skip;

    /**
     * Allows configuring which of the config files should be written.
     *
     * @param ConfigWriter  $configWriter
     * @param array         $skip           array of method names in config writer to skip.
     *                                      Currently only skipping 'writeDbConfig' is implemented.
     */
    public function __construct(ConfigWriter $configWriter, array $skip = [])
    {
        $this->configWriter = $configWriter;
        $this->skip = $skip;
    }

    /**
     * Creates all system config files. If configured writing DB config is skipped.
     *
     * @param array $config
     */
    public function createConfigFiles(array $config)
    {
        if (!in_array('writeDbConfig', $this->skip, true)) {
            $this->configWriter->writeDbConfig($config);
        }

        $this->configWriter->writeSystemConfig();
        $this->configWriter->writeDebugModeConfig();
        $this->configWriter->generateParametersFile();
    }
}
