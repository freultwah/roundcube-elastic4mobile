<?php

/**
 * Elastic skin for mobile devices plugin
 *
 * Selects the elastic skin if a mobile device is detected as the client.
 *
 * @author Thomas Bruederli <thomas@roundcube.net>
 * @license GNU GPLv3+
 */
class elastic4mobile extends rcube_plugin
{
    public $noajax = true;

    public function init()
    {
        $rcmail = rcmail::get_instance();

        // Check if the Mobile_Detect class exists
        if (class_exists('Mobile_Detect')) {
            $detect = new Mobile_Detect;

            if ($detect->isMobile() || $detect->isTablet()) {
                $skin = 'elastic';
                $rcmail->default_skin = $skin;
                $rcmail->config->set('skin', $skin);
                $rcmail->output->set_skin($skin);

                // Disable skin switch as this wouldn't have any effect
                $dont_override = $rcmail->config->get('dont_override', []);
                $dont_override[] = 'skin';
                $rcmail->config->set('dont_override', $dont_override);
            }
        }
    }
}

