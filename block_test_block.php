<?php

class block_test_block extends block_base {

    /**
     * Init.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_test_block');
    }

    /**
     * Returns the contents.
     *
     * @return stdClass contents of block
     */
    public function get_content() {
        global $COURSE;
        if (isset($this->content)) {
            return $this->content;
        }
        $renderer = $this->page->get_renderer('block_test_block');
        $this->content = new stdClass();
        $this->content->text = $renderer->get_content();
        $this->content->footer = '';
        return $this->content;
    }

    /**
     * Locations where block can be displayed.
     *
     * @return array
     */
    public function applicable_formats() {
        return array('course-view' => true);
    }

    /**
     * Allow the block to have a configuration page.
     *
     * @return boolean
     */
    public function has_config() {
        return true;
    }

}
