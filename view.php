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

/**
 * This page opens the current view instance of diary.
 *
 * @package    mod_diary
 * @copyright  2019 AL Rachels (drachels@drachels.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/

require_once("../../config.php");
require_once("lib.php");

$id = required_param('id', PARAM_INT);    // Course Module ID
$cm = get_coursemodule_from_id('diary', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$action  = optional_param('action', 'currententry', PARAM_ACTION);  // Action(default to current entry).

if (! $cm) {
    print_error("Course Module ID was incorrect");
}

if (! $course) {
    print_error("Course is misconfigured");
}

$context = context_module::instance($cm->id);

//print_object('At the start of view page.');
//print_object('At the start of view page.');
//print_object('At the start of view page.');
//print_object($id);
//print_object($cm);
//print_object($course);
//print_object($action);

// Confirm login.
require_login($course, true, $cm);

$entriesmanager = has_capability('mod/diary:manageentries', $context);
$canadd = has_capability('mod/diary:addentries', $context);

if (!$entriesmanager && !$canadd) {
    print_error('accessdenied', 'diary');
}

if (! $diary = $DB->get_record("diary", array("id" => $cm->instance))) {
    print_error("Course module is incorrect");
}

if (! $cw = $DB->get_record("course_sections", array("id" => $cm->section))) {
    print_error("Course module is incorrect");
}

$diaryname = format_string($diary->name, true, array('context' => $context));

///////////////////////////////////////////////////
// Get local renderer.
$output = $PAGE->get_renderer('mod_diary');
$output->init($cm);
////////////////////////////////////////
//print_object($USER->id);
//print_object($USER->id);
//print_object($USER->id);
//print_object($USER->id);
// Handle toolbar capabilities.
if (!empty($action)) {
    switch ($action) {
        case 'download':
            if (has_capability('mod/diary:addentries', $context)) {
                // Call download entries function in lib.php.
                download_entries($context, $course, $id, $diary);
            }
            break;
        // Show the edit button for editing the first entry in the current list of entries.
        case 'currententry':
            if (has_capability('mod/diary:addentries', $context)) {
                // Reload the current page.
                $stringlable = 'currententry';
                 $sortorderinfo = ('<h4>'.get_string('sortcurrententry', 'diary').'</h4>');

                $entrys = $DB->get_records('diary_entries', array('userid' => $USER->id, 'diary' => $diary->id), $sort = 'timecreated DESC');
                //refresh($context, $course, $id, $diary);
                //editentry($id);
            }
            break;
        // Sort the list of entries from oldest to newest based on timecreated.
        case 'firstentry':
            if (has_capability('mod/diary:addentries', $context)) {
                 $stringlable = 'firstentry';
                 $sortorderinfo = ('<h4>'.get_string('sortfirstentry', 'diary').'</h4>');
                 $entrys = $DB->get_records("diary_entries", array('userid' => $USER->id, 'diary' => $diary->id), $sort = 'timecreated ASC');
            }
            break;
        // Sort the list from lowest grade to highest grade. Show ungraded first, from oldest to newest.
        case 'lowestgradeentry':
            if (has_capability('mod/diary:addentries', $context)) {
                 $stringlable = 'lowestgradeentry';
                 $sortorderinfo = ('<h4>'.get_string('sortlowestentry', 'diary').'</h4>');

                 $entrys = $eee = $DB->get_records("diary_entries", array('userid' => $USER->id, 'diary' => $diary->id), $sort = 'rating ASC, timemodified ASC');
            }
            break;
        // Sort list from highest grade to lowest grade. If tie grade, further sort from newest to oldes.
        case 'highestgradeentry':
            if (has_capability('mod/diary:addentries', $context)) {
                 $stringlable = 'highestgradeentry';
                 $sortorderinfo = ('<h4>'.get_string('sorthighestentry', 'diary').'</h4>');

                 // Get ALL diary entries in an order that will result in showing the users highest
                 // graded entry. Duplicates high grades result in showing the most recent entry.
                 $entrys = $DB->get_records("diary_entries", array('userid' => $USER->id, 'diary' => $diary->id), $sort = 'rating DESC, timecreated DESC');
            }
            break;
        // Sort list from most recently modified to the one modified the longet time ago.
        case 'latestmodifiedentry':
            if (has_capability('mod/diary:addentries', $context)) {
                 $stringlable = 'latestmodifiedentry';
                 $sortorderinfo = ('<h4>'.get_string('sortlastentry', 'diary').'</h4>');

                 // Get ALL diary entries in an order that will result in showing the users
                 // most recently modified entry. At the moment, this is no different from current entry.
                 // May be needed for future version if editing old entries is allowed.
                 $entrys = $DB->get_records("diary_entries", array('userid' => $USER->id, 'diary' => $diary->id), $sort = 'timemodified DESC');
            }
            break;
        default:
            if (has_capability('mod/diary:addentries', $context)) {
                 $stringlable = 'currententry';
            }
    }
}

/////////////////////////////////////////////////////


// Header
$PAGE->set_url('/mod/diary/view.php', array('id'=>$cm->id));
$PAGE->navbar->add($diaryname);
$PAGE->set_title($diaryname);
$PAGE->set_heading($course->fullname);
// 20190523 Added this to force editing cog to show.
$PAGE->force_settings_menu();

echo $OUTPUT->header();
echo $OUTPUT->heading($diaryname);




/// Check to see if groups are being used here
$groupmode = groups_get_activity_groupmode($cm);
$currentgroup = groups_get_activity_group($cm, true);
groups_print_activity_menu($cm, $CFG->wwwroot . "/mod/diary/view.php?id=$cm->id");

//echo get_string('sortorder', 'diary');
//echo get_string($stringlable, 'diary');

// If viewer is a manager, create a link to diary entries made by users.
if ($entriesmanager) {
    $entrycount = diary_count_entries($diary, $currentgroup);

    echo '<div class="reportlink"><a href="report.php?id='.$cm->id.'&action=currententry">'.
          get_string('viewallentries','diary', $entrycount).'</a></div>';
////////////////////////////////////////////////////////////////////////////////////////
//    echo '<div class="xreportlink"><a href="xreport.php?id='.$cm->id.'">'.
//          get_string('viewallentries','diary', $entrycount).'...xreport</a></div>';
////////////////////////////////////////////////////////////////////////////////////////
}

//////////////////////////////////////////////////////////////
echo $output->introduction($diary, $cm);

//$diary->intro = trim($diary->intro);
//if (!empty($diary->intro)) {
//    $intro = format_module_intro('diary', $diary, $cm->id);
//    echo $OUTPUT->box($intro, 'generalbox', 'intro');
//}
//////////////////////////////////////////////////////////////
echo '<br />';

// Check to see if diary is currently available.
$timenow = time();
if ($course->format == 'weeks' and $diary->days) {
    $timestart = $course->startdate + (($cw->section - 1) * 604800);
    if ($diary->days) {
        $timefinish = $timestart + (3600 * 24 * $diary->days);
    } else {
        $timefinish = $course->enddate;
    }
} else {  
    // Have no time limits on the diarys.
    $timestart = $timenow - 1;
    $timefinish = $timenow + 1;
    $diary->days = 0;
}
if ($timenow > $timestart) {

    echo $OUTPUT->box_start();

    // Edit button.
    if ($timenow < $timefinish) {

        if ($canadd) {
            echo get_string('sortorder', 'diary');
            echo $sortorderinfo;
            echo $output->box_start();

            // Add button for editing current entry or starting a new entry.
            echo $OUTPUT->single_button('edit.php?id='.$cm->id, get_string('startoredit', 'diary'), 'get',
                array("class" => "singlebutton diarystart"));
            // Print additional toolbar icons.
            //echo ' User toolbar:';
            //echo $output->container_start("toolbar");
            //echo $output->box_start();  // Using the one above the line that does the Button.
            echo get_string('usertoolbar', 'diary');
            echo $output->toolbar(has_capability('mod/diary:addentries', $context), $course, $id, $diary);
            echo $output->box_end();
            //echo $output->container_end();
        }
    }

    // Display entry.
    //////////////////////////////////////////////////////////////////////
    // THIS LINE NEEDS TO BE CHANGED to just the variable and have the $DB
    // portion supplied/set by the toolbar.
    //if ($entrys = $DB->get_records('diary_entries', array('userid' => $USER->id, 'diary' => $diary->id), $sort = 'timecreated DESC')) {
    if ($entrys) {
        //print_object($entrys);
        foreach ($entrys as $entry) {
            if (empty($entry->text)) {
                echo '<p align="center"><b>'.get_string('blankentry','diary').'</b></p>';
            } else {
                $color3 = get_config('mod_diary', 'entrybgc');
                $color4 = get_config('mod_diary', 'entrytextbgc');

                echo '<div align="left" style="font-size:1em; padding: 5px;
                    font-weight:bold;background: '.$color3.';
                    border:2px solid black;
                    -webkit-border-radius:16px;
                    -moz-border-radius:16px;border-radius:16px;">';

                $date1 = new DateTime(date('Y-m-d G:i:s', time()));
                //print_object($date1);
                $date2 = new DateTime(date('Y-m-d G:i:s', $entry->timecreated));
                //print_object($date2);
                $diff = date_diff($date1, $date2);
                //print_object($diff);
                //print_object($diff->h);

                // Add a heading for each entry on the page.
                //echo $OUTPUT->heading(get_string('entry', 'diary').' Can add more here if needed.');
                echo $OUTPUT->heading(get_string('entry', 'diary'));

                // Both of these methods work. Second is better.
                echo '<p><b>Created '.date(get_config('mod_diary', 'dateformat'), $entry->timecreated).' Modified '.date(get_config('mod_diary', 'dateformat'), $entry->timemodified).' This entry was made '.$diff->d.' days and '.$diff->h.' hours ago.</b>';
                //echo '<p><b>'.userdate($entry->timemodified).'</b>';
                echo '<div align="left" style="font-size:1em; padding: 5px;
                    font-weight:bold;background: '.$color4.';
                    border:1px solid black;
                    -webkit-border-radius:16px;
                    -moz-border-radius:16px;border-radius:16px;">';

// Need to keep track of the details for the first entry printed so the diary_entries->id can be passed to edit.php.
                //echo diary_format_entry_text($entry->text, $entry->format, array('context' => $context)).'</div></p>';
                echo diary_format_entry_text($entry, $course, $cm).'</div></p>';

                // Info regarding last edit and word count.
                if ($timenow < $timefinish) {
                    if (!empty($entry->timemodified)) {


                        echo '<p><b>Created '.date(get_config('mod_diary', 'dateformat'), $entry->timecreated).' Modified '.date(get_config('mod_diary', 'dateformat'), $entry->timemodified).' This entry was made '.$diff->d.' days and '.$diff->h.' hours ago.</b>';
                        //echo '<p><b>'.userdate($entry->timemodified).'</b>';


                        echo '<div class="lastedit"><strong>'.get_string('lastedited').': </strong> ';
                        echo userdate($entry->timemodified);
                        echo ' ('.get_string('numwords', '', count_words($entry->text)).')';
                        echo "</div>";
                    }
                    if (!empty($entry->timecreated) AND !empty($entry->timemodified) AND empty($entry->timemarked)) {
                        echo "<div class=\"needsedit\">".get_string("needsgrading", "diary"). "</div>";
                    } else if (!empty($entry->timemodified) AND !empty($entry->timemarked) AND $entry->timemodified > $entry->timemarked) {
                        echo "<div class=\"needsedit\">".get_string("needsregrade", "diary"). "</div>";
                    }

                    if (!empty($diary->days)) {
                        echo '<div class="editend"><strong>'.get_string('editingends', 'diary').': </strong> ';
                        echo userdate($timefinish).'</div>';
                    }

                } else {
                    echo '<div class="editend"><strong>'.get_string('editingended', 'diary').': </strong> ';
                    echo userdate($timefinish).'</div>';
                }

                // Print feedback from the teacher for the current entry.
                if (!empty($entry->entrycomment) or !empty($entry->rating)) {
                    //$grades = make_grades_menu($diary->grade);
                    //$grades = make_grades_menu($entry->rating);
                    $grades = $entry->rating;

                   // Add a heading for each feedback on the page.
                    echo $OUTPUT->heading(get_string('feedback'));
                    echo $output->diary_print_feedback($course, $entry, $grades);
                }
                echo '</div></p>';
            }
        }
    } else {
        echo '<span class="warning">'.get_string('notstarted', 'diary').'</span>';
    }
    echo $OUTPUT->box_end();


} else {
    echo '<div class="warning">'.get_string('notopenuntil', 'diary').': ';
    echo userdate($timestart).'</div>';
}

// Trigger module viewed event.
$event = \mod_diary\event\course_module_viewed::create(array(
   'objectid' => $diary->id,
   'context' => $context
));
$event->add_record_snapshot('course_modules', $cm);
$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('diary', $diary);
$event->trigger();

echo $OUTPUT->footer();
