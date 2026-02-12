![GitHub Release](https://img.shields.io/github/v/release/fish906/ubt-essaydownload)
![Build Status](https://github.com/USERNAME/REPO/workflows/Build%20and%20Release/badge.svg)
![PHP Tests](https://github.com/USERNAME/REPO/workflows/PHP%20Compatibility%20Tests/badge.svg)

ubt-essaydownload
-------------------------

This fork is adapting the moodle plugin to the needs of the UBT.
This is a quiz report plugin that allows bulk downloading of text answers and attachment files submitted in response to essay questions in a quiz.

It has been inspired by the [quiz_downloadsubmissions](https://github.com/IITBombayWeb/moodle-quiz_downloadsubmissions) plugin which offers similar functionality.


#### Installation

Install the plugin to the folder `$MOODLE_ROOT/mod/quiz/report/essaydownload`.

For more information, please see the [Moodle docs](https://docs.moodle.org/en/Installing_plugins).


#### Usage

1. Go to a quiz.
2. Click on "Results" in order to access the results tab.
3. From the dropdown menu, choose "Download essay responses".
4. Set the available options according to your needs.
5. Click "Download".

The plugin will then generate a ZIP archive containing the requested data and initiate
the download in your browser.

Note: No confirmation will be shown. Once you get your ZIP file, the work is done.


