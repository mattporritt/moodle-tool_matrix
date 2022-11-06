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
 * This file contains hooks and callbacks needed for this plugin.
 *
 * @package     tool_matrix
 * @category    admin
 * @copyright   2022 Matt Porritt <matt.porritt@moodle.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This function extends the course navigation
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the report
 * @param context $context The context of the course
 * @throws coding_exception
 * @throws moodle_exception
 */



function tool_matrix_extend_navigation_course(\navigation_node $navigation, \stdClass $course, \context $context) {
    $url = new moodle_url('/foo');
    // Find the course settings node using the 'courseadmin' key.
    $coursesettingsnode = $navigation->parent->find('courseadmin', null);
    $node = $coursesettingsnode->create(
            get_string('pluginname', 'tool_matrix'),
            $url,
            navigation_node::TYPE_SETTING,
            null,
            null,
            new pix_icon('i/report', '')
    );
    $coursesettingsnode->add_node($node, 'questionbank');
}

