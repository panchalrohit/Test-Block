<?php

class block_test_block_renderer extends plugin_renderer_base {

    public function get_content() {
        global $USER, $COURSE;
        $modinfo = get_fast_modinfo($COURSE);
        $activities = $modinfo->get_array_of_activities($COURSE);
        $completioninfo = new completion_info($COURSE);
        $content = "";
        $completionok = [
            COMPLETION_COMPLETE,
            COMPLETION_COMPLETE_PASS
        ];
        $content .= html_writer::start_tag('div', array('class' => 'teachingschedule-filter mb-4'));
        foreach ($activities as $mod) {
            $text = "";
            $text .= $mod->cm . " - ";
            $text .= $mod->name . " - ";
            $text .= userdate($mod->added, get_string('strfordate', 'block_test_block'));
            $module = $modinfo->cms[$mod->cm];
            $completiondata = $completioninfo->get_data(
                    $module,
                    true, $USER->id
            );
            if (in_array(
                            $completiondata->completionstate,
                            $completionok
                    )) {
                $text .= ' - completed';
            }
            $baseurl = new moodle_url('/mod/' . $mod->mod . '/view.php', array('id' => $mod->cm));
            $content .= html_writer::link($baseurl, $text);
            $content .= "</br>";
        }
        $content .= html_writer::end_tag('div');
        return $content;
    }

}
