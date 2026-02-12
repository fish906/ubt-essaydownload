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
 * This file defines the setting form for the essay download report.
 *
 * @package   quiz_essaydownload
 * @copyright 2024 Philipp E. Imhof
 * @author    Philipp E. Imhof
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// This work-around is required until Moodle 4.2 is the lowest version we support.
if (class_exists('\mod_quiz\local\reports\attempts_report_options')) {
    class_alias('\mod_quiz\local\reports\attempts_report_options', '\quiz_essaydownload_options_parent_class_alias');
} else {
    require_once($CFG->dirroot . '/mod/quiz/report/attemptsreport_options.php');
    class_alias('\mod_quiz_attempts_report_options', '\quiz_essaydownload_options_parent_class_alias');
}

/**
 * Class to store the options for a {@see quiz_essaydownload_report}.
 *
 * @package   quiz_essaydownload
 * @copyright 2024 Philipp E. Imhof
 * @author    Philipp E. Imhof
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quiz_essaydownload_options extends quiz_essaydownload_options_parent_class_alias {
    /** @var bool whether to group all answers from an attempt into a single file */
    public $allinone = false;

    /** @var bool whether to include attachments (if there are) in the archive */
    public $attachments = true;

    /** @var string file format always PDF */
    public $fileformat = 'pdf';

    /** @var bool whether to try to work around Atto bug MDL-67360 */
    public $fixremfontsize = true;

    /** @var bool whether to use "flat" folder hierarchy in the archive */
    public $flatarchive = true;

    /** @var string base font family for PDF export */
    public $font = 'sansserif';

    /** @var int font size for PDF export */
    public $fontsize = 12;

    /** @var bool whether to force use of summary for question text, even if source is set to HTML */
    public $forceqtsummary = false;

    /** @var string how to organise the sub folders in the archive (by question or by attempt) */
    public $groupby = 'byquestion';

    /** @var bool whether a footer containing the page number should be added to PDFs */
    public $includefooter = true;

    /** @var bool whether to include a word and character count after the response */
    public $includestats = false;

    /** @var float line spacing for PDF export */
    public $linespacing = 1.5;

    /** @var bool whether to include only (at most) one finished attempt per user according to grading method */
    public $onlyone = false;

    /** @var int bottom margin for PDF export */
    public $marginbottom = 20;

    /** @var int left margin for PDF export */
    public $marginleft = 20;

    /** @var int right margin for PDF export */
    public $marginright = 50;

    /** @var int top margin for PDF export */
    public $margintop = 20;

    /** @var string whether to have the last name or the first name first */
    public $nameordering = 'lastfirst';

    /** @var string page format for PDF export */
    public $pageformat = 'a4';

    /** @var bool whether to include the question text in the archive */
    public $questiontext = true;

    /** @var bool whether to shorten file and path names to workaround a Windows issue */
    public $shortennames = false;

    /** @var string which source to use: plain-text summary or original HTML text */
    public $source = 'html';

    /** @var string text alignment for PDF export */
    public $textalign = 'left';

    /**
     * Constructor
     *
     * @param string $mode which report these options are for
     * @param object $quiz the settings for the quiz being reported on
     * @param object $cm the course module objects for the quiz being reported on
     * @param object $course the course settings for the coures this quiz is in
     */
    public function __construct($mode, $quiz, $cm, $course) {
        $this->mode   = $mode;
        $this->quiz   = $quiz;
        $this->cm     = $cm;
        $this->course = $course;
    }

    /**
     * Get the current value of the settings to pass to the settings form.
     */
    public function get_initial_form_data() {
        $toform = new stdClass();

        $toform->allinone = $this->allinone;
        $toform->attachments = $this->attachments;
        $toform->fixremfontsize = $this->fixremfontsize;
        $toform->font = $this->font;
        $toform->fontsize = $this->fontsize;
        $toform->forceqtsummary = $this->forceqtsummary;
        $toform->includestats = $this->includestats;
        $toform->linespacing = $this->linespacing;
        $toform->onlyone = $this->onlyone;
        $toform->marginbottom = $this->marginbottom;
        $toform->marginleft = $this->marginleft;
        $toform->marginright = $this->marginright;
        $toform->margintop = $this->margintop;
        $toform->nameordering = $this->nameordering;
        $toform->questiontext = $this->questiontext;
        $toform->shortennames = $this->shortennames;
        $toform->textalign = $this->textalign;

        return $toform;
    }

    /**
     * Set the fields of this object from the form data.
     *
     * @param object $fromform data from the settings form
     */
    public function setup_from_form_data($fromform): void {
        $this->allinone = $fromform->allinone;
        $this->attachments = $fromform->attachments;
        $this->fixremfontsize = $fromform->fixremfontsize;
        $this->font = $fromform->font ?? '';
        $this->fontsize = $fromform->fontsize ?? '';
        $this->forceqtsummary = $fromform->forceqtsummary;
        $this->includestats = $fromform->includestats;
        $this->linespacing = $fromform->linespacing ?? '';
        $this->onlyone = $fromform->onlyone ?? '';
        $this->marginbottom = $fromform->marginbottom ?? '';
        $this->marginleft = $fromform->marginleft ?? '';
        $this->marginright = $fromform->marginright ?? '';
        $this->margintop = $fromform->margintop ?? '';
        $this->nameordering = $fromform->nameordering;
        $this->questiontext = $fromform->questiontext;
        $this->shortennames = $fromform->shortennames;
        $this->textalign = $fromform->textalign ?? '';
    }

    /**
     * Set the fields of this object from the URL parameters.
     */
    public function setup_from_params() {
        $this->allinone = optional_param('allinone', $this->allinone, PARAM_BOOL);
        $this->attachments = optional_param('attachments', $this->attachments, PARAM_BOOL);
        $this->fixremfontsize = optional_param('fixremfontsize', $this->fixremfontsize, PARAM_BOOL);
        $this->font = optional_param('font', $this->font, PARAM_ALPHA);
        $this->fontsize = optional_param('fontsize', $this->fontsize, PARAM_INT);
        $this->forceqtsummary = optional_param('forceqtsummary', $this->forceqtsummary, PARAM_BOOL);
        $this->includestats = optional_param('includestats', $this->includestats, PARAM_BOOL);
        $this->linespacing = optional_param('linespacing', $this->linespacing, PARAM_FLOAT);
        $this->onlyone = optional_param('onlyone', $this->onlyone, PARAM_BOOL);
        $this->marginbottom = optional_param('marginbottom', $this->marginbottom, PARAM_INT);
        $this->marginleft = optional_param('marginleft', $this->marginleft, PARAM_INT);
        $this->marginright = optional_param('marginright', $this->marginright, PARAM_INT);
        $this->margintop = optional_param('margintop', $this->margintop, PARAM_INT);
        $this->nameordering = optional_param('nameordering', $this->nameordering, PARAM_ALPHA);
        $this->questiontext = optional_param('questiontext', $this->questiontext, PARAM_BOOL);
        $this->shortennames = optional_param('shortennames', $this->shortennames, PARAM_BOOL);
        $this->textalign = optional_param('textalign', $this->textalign, PARAM_ALPHA);
    }

    /**
     * Make sure all form fields are set to either the stored value from the user preferences or,
     * if no pref has been stored, to the default value.
     */
    public function setup_from_user_preferences() {
        $this->allinone = get_user_preferences('quiz_essaydownload_allinone', $this->allinone);
        $this->attachments = get_user_preferences('quiz_essaydownload_attachments', $this->attachments);
        $this->fixremfontsize = get_user_preferences('quiz_essaydownload_fixremfontsize', $this->fixremfontsize);
        $this->font = get_user_preferences('quiz_essaydownload_font', $this->font);
        $this->fontsize = get_user_preferences('quiz_essaydownload_fontsize', $this->fontsize);
        $this->includefooter = get_user_preferences('quiz_essaydownload_includefooter', $this->includefooter);
        $this->includestats = get_user_preferences('quiz_essaydownload_includestats', $this->includestats);
        $this->linespacing = get_user_preferences('quiz_essaydownload_linespacing', $this->linespacing);
        $this->onlyone = get_user_preferences('quiz_essaydownload_onlyone', $this->onlyone);
        $this->marginbottom = get_user_preferences('quiz_essaydownload_marginbottom', $this->marginbottom);
        $this->marginleft = get_user_preferences('quiz_essaydownload_marginleft', $this->marginleft);
        $this->marginright = get_user_preferences('quiz_essaydownload_marginright', $this->marginright);
        $this->margintop = get_user_preferences('quiz_essaydownload_margintop', $this->margintop);
        $this->nameordering = get_user_preferences('quiz_essaydownload_nameordering', $this->nameordering);
        $this->questiontext = get_user_preferences('quiz_essaydownload_questiontext', $this->questiontext);
        $this->shortennames = get_user_preferences('quiz_essaydownload_shortennames', $this->shortennames);
        $this->textalign = get_user_preferences('quiz_essaydownload_textalign', $this->textalign);
    }

    /**
     * Safe form fields to user preferences.
     */
    public function update_user_preferences() {
        set_user_preference('quiz_essaydownload_allinone', $this->allinone);
        set_user_preference('quiz_essaydownload_attachments', $this->attachments);
        set_user_preference('quiz_essaydownload_fixremfontsize', $this->fixremfontsize);
        set_user_preference('quiz_essaydownload_font', $this->font);
        set_user_preference('quiz_essaydownload_fontsize', $this->fontsize);
        set_user_preference('quiz_essaydownload_includefooter', $this->includefooter);
        set_user_preference('quiz_essaydownload_includestats', $this->includestats);
        set_user_preference('quiz_essaydownload_linespacing', $this->linespacing);
        set_user_preference('quiz_essaydownload_marginbottom', $this->marginbottom);
        set_user_preference('quiz_essaydownload_marginleft', $this->marginleft);
        set_user_preference('quiz_essaydownload_marginright', $this->marginright);
        set_user_preference('quiz_essaydownload_margintop', $this->margintop);
        set_user_preference('quiz_essaydownload_nameordering', $this->nameordering);
        set_user_preference('quiz_essaydownload_questiontext', $this->questiontext);
        set_user_preference('quiz_essaydownload_shortennames', $this->shortennames);
        set_user_preference('quiz_essaydownload_textalign', $this->textalign);

        // The user can only set the following option, if the quiz allows limitation to (at most) one
        // attempt. If they cannot set the option, we should not update the user prefs.
        if (quiz_report_can_filter_only_graded($this->quiz)) {
            set_user_preference('quiz_essaydownload_onlyone', $this->onlyone);
        }
    }

    /**
     * Deal with conflicting options -> no longer needed as the form now disables conflicting options, but we keep this here just in case.
     */
    public function resolve_dependencies() {
        // All dependencies are resolved by fixed values
        }
    }
}
