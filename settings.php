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
    $settings = new admin_settingpage('tool_matrix_settings', new lang_string('pluginname', 'tool_matrix'));

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

        $ADMIN->add(
                'tools',
                new admin_category('matrixcat', get_string('matrixcat', manager::PLUGINNAME), $accessibilitydisabled)
        );

        $ADMIN->add(
                'brickfieldfolder',
                new admin_externalpage(
                        'tool_brickfield_activation',
                        get_string('activationform', manager::PLUGINNAME),
                        manager::registration_url(),
                        'moodle/site:config'
                )
        );
    }
}
