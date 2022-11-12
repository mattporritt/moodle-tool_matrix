<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     tool_matrix
 * @category    admin
 * @copyright   2022 Matt Porritt <matt.porritt@moodle.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use tool_matrix\communication;

defined('MOODLE_INTERNAL') || die();
$communicationdisabled = !communication::is_communication_enabled();

if ($hassiteconfig) {

    // Set up the category and settings page under Admin tools.
    $ADMIN->add(
            'tools',
            new admin_category('communicationscat', get_string('communicationscat', 'tool_matrix'), $communicationdisabled)
    );

    // Matrix server settings page.
    $settingspage = new admin_settingpage('tool_matrix_settings', new lang_string('settings', 'tool_matrix'));

    // Test function page. Only here for some development testing.
    $ADMIN->add(
            'communicationscat',
            new admin_externalpage(
                    'tool_matrix_testpage',
                    get_string('testpage', 'tool_matrix'),
                    '/admin/tool/matrix/test.php', // Yes, this is not the correct way to so this.
                    'moodle/site:config'
            )
    );

    if ($ADMIN->fulltree) {
        // Add an enable subsystem setting to the "Advanced features" settings page.
        $optionalsubsystems = $ADMIN->locate('optionalsubsystems');
        $optionalsubsystems->add(new admin_setting_configcheckbox(
                'enablecommunication',
                new lang_string('enablecommunication', 'tool_matrix'),
                new lang_string('enablecommunication_desc', 'tool_matrix'),
                1,
                1,
                0
        ));

        // Matrix server settings.
        $settingspage->add(new admin_setting_configtext(
                'tool_matrix/serverurl',
                new lang_string('serverurl', 'tool_matrix'),
                new lang_string('serverurl_desc', 'tool_matrix'),
                '',
                PARAM_RAW_TRIMMED // This doesn't feel correct.
        ));

        $settingspage->add(new admin_setting_configtext(
                'tool_matrix/serveruser',
                new lang_string('serveruser', 'tool_matrix'),
                new lang_string('serveruser_desc', 'tool_matrix'),
                '',
                PARAM_RAW_TRIMMED
        ));

        $settingspage->add(new admin_setting_configpasswordunmask(
                'tool_matrix/serverpass',
                new lang_string('serverpass', 'tool_matrix'),
                new lang_string('serverpass_desc', 'tool_matrix'),
                '',
                PARAM_RAW_TRIMMED
        ));

        $settingspage->add(new admin_setting_configcheckbox(
                'tool_matrix/createusers',
                new lang_string('createusers', 'tool_matrix'),
                new lang_string('createusers_desc', 'tool_matrix'),
                0,
                1,
                0
        ));

        $settingspage->add(new admin_setting_configcheckbox(
                'tool_matrix/hassso',
                new lang_string('hassso', 'tool_matrix'),
                new lang_string('hassso_desc', 'tool_matrix'),
                0,
                1,
                0
        ));

    }

    $ADMIN->add('communicationscat', $settingspage);
}
