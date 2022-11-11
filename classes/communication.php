<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace tool_matrix;

/**
 * Class communication
 * @package tool_matrix
 * @copyright   2022 Matt Porritt <matt.porritt@moodle.com>
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class communication {
    /**
     * Return the state of the site enable condition.
     * @return bool
     */
    public static function is_communication_enabled(): bool {
        global $CFG;

        if (isset($CFG->enablecommunication)) {
            return $CFG->enablecommunication;
        }

        // Enabled by default.
        return true;
    }
}
