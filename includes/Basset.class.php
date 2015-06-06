<?php
class Basset {

    protected static $instance = null;

    private $issues = array();
    public $errors = array();

    public static function instance() {
        null === self:: $instance AND self:: $instance = new self;
        return self:: $instance;
    }

    public function add_issue($message) {
        return $this->issues[] = $message;
    }

    public function get_issues() {
        return $this->issues;
    }
}
?>
