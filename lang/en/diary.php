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
 * English strings for diary plugin.
 *
 * @package    mod_diary
 * @copyright  2019 AL Rachels (drachels@drachels.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['eventdiarycreated'] = 'Diary created';
$string['eventdiaryviewed'] = 'Diary viewed';
$string['evententriesviewed'] = 'Diary entries viewed';
$string['eventdiarydeleted'] = 'Diary deleted';
$string['eventdownloadentriess'] = 'Download entries';
$string['evententryupdated'] = 'Diary entry updated';
$string['evententrycreated'] = 'Diary entry created';
$string['eventfeedbackupdated'] = 'Diary feedback updated';

$string['accessdenied'] = 'Access denied';
$string['alwaysopen'] = 'Always open';
$string['alias'] = 'Keyword';
$string['aliases'] = 'Keyword(s)';
$string['aliases_help'] = 'Each diary entry can have an associated list of keywords (or aliases).

Enter each keyword on a new line (not separated by commas).';
$string['attachment'] = 'Attachment';
$string['attachment_help'] = 'You can optionally attach one or more files to a diary entry.';
$string['blankentry'] = 'Blank entry';
$string['configdateformat'] = 'This defines how dates are shown in diary reports. The default value, "M d, Y G:i" is Month, day, year and 24 hour format time. Refer to Date in the PHP manual for more examples and predefined date constants.';
$string['created'] = 'Created {$a->one} days and {$a->two} hours ago.';
$string['csvexport'] = 'Export to .csv';
$string['currententry'] = 'Current diary entries:';
$string['daysavailable'] = 'Days available';
$string['deadline'] = 'Days Open';
$string['dateformat'] = 'Default date format';
$string['editingended'] = 'Editing period has ended';
$string['editingends'] = 'Editing period ends';
$string['entries'] = 'Entries';
$string['entry'] = 'Entry';
$string['entrybgc_title'] = 'Diary entry/feedback background color';
$string['entrybgc_descr'] = 'This sets the background color of a diary entry/feedback.';
$string['entrybgc_colour'] = '#93FC84';
$string['entrycomment'] = 'Entry comment';
$string['entrytextbgc_title'] = 'Diary text background color';
$string['entrytextbgc_descr'] = 'This sets the background color of the text in a diary entry.';
$string['entrytextbgc_colour'] = '#EEFC84';
$string['exportfilename'] = 'entries.csv';
$string['exportfilenamep1'] = 'All_Site';
$string['exportfilenamep2'] = '_Diary_Entries_Exported_On_';
$string['feedbackupdated'] = 'Feedback updated for {$a} entries';
$string['firstentry'] = 'First diary entries:';
$string['gradeingradebook'] = 'Current grade in gradebook';
$string['diary:addentries'] = 'Add diary entries';
$string['diary:addinstance'] = 'Add diary instances';
$string['diary:manageentries'] = 'Manage diary entries';
$string['diarymail'] = '{$a->teacher} has posted some feedback on your diary entry for \'{$a->diary}\'

You can see it appended to your diary entry:

    {$a->url}';
$string['diarymailhtml'] = '{$a->teacher} has posted some feedback on your
diary entry for \'<i>{$a->diary}</i>\'<br /><br />
You can see it appended to your <a href="{$a->url}">diary entry</a>.';
$string['diaryname'] = 'Diary name';
$string['diaryquestion'] = 'Diary question';
$string['format'] = 'Format';
$string['highestgradeentry'] = 'Highest grade entries:';
$string['latestmodifiedentry'] = 'Most recently modified entries:';
$string['lowestgradeentry'] = 'Lowest grade entries:';
$string['mailed'] = 'Mailed';
$string['mailsubject'] = 'Diary feedback';
$string['modulename'] = 'Diary';
$string['modulename_help'] = 'The diary activity enables teachers to obtain students feedback
 over a period of time.';
$string['modulenameplural'] = 'Diarys';
$string['needsgrading'] = ' This entry has not been given feedback or graded yet.';
$string['needsregrade'] = 'This entry has changed since feedback or a grade was given.';
$string['newdiaryentries'] = 'New diary entries';
$string['nextentry'] = 'Next entry';
$string['nodeadline'] = 'Always open';
$string['noentriesmanagers'] = 'There are no teachers';
$string['noentry'] = 'No entry';
$string['noratinggiven'] = 'No rating given';
$string['notopenuntil'] = 'This diary won\'t be open until';
$string['notstarted'] = 'You have not started this diary yet';
$string['overallrating'] = 'Overall rating';
$string['pagesize'] = 'Entries per page';
$string['pluginadministration'] = 'Diary module administration';
$string['pluginname'] = 'Diary';
$string['previousentry'] = 'Previous entry';
$string['rate'] = 'Rate';
$string['rating'] = 'Rating';
$string['reload'] = 'Reload and show from current to oldest diary entry';
$string['removeentries'] = 'Remove all entries';
$string['removemessages'] = 'Remove all Diary entries';
$string['returnto'] = 'Return to {$a}';
$string['saveallfeedback'] = 'Save all my feedback';
$string['savesettings'] = 'Save settings';
$string['showrecentactivity'] = 'Show recent activity';
$string['showoverview'] = 'Show diarys overview on my moodle';
$string['sortorder'] = '<h4>Sort order is: </h4>';
$string['sortcurrententry'] = 'From current diary entry to the first entry.';
$string['sortfirstentry'] = 'From first diary entry to the latest entry.';
$string['sortlowestentry'] = 'From lowest grade diary entry to the highest entry.';
$string['sorthighestentry'] = 'From highest grade diary entry to the lowest grade entry.';
$string['sortlastentry'] = 'From latest modified diary entry to the oldest modified entry.';
$string['startoredit'] = 'Start new or edit today\'s entry';
//$string['startoredit'] = 'Start new day or edit current day diary entry';
$string['teacher'] = 'Teacher';
$string['text'] = 'Text';
$string['timecreated'] = 'Time created';
$string['timemarked'] = 'Time marked';
$string['timemodified'] = 'Time modified';

$string['userid'] = 'User id';
$string['usertoolbar'] = 'User toolbar:';
$string['viewallentries'] = 'View {$a} diary entries';
$string['viewentries'] = 'View entries';
