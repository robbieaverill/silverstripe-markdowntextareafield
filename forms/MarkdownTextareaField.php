<?php

class MarkdownTextareaField extends TextareaField {

	private static $allowed_actions = array(
		'preview',
		'parse'
	);

	/**
	 * @var int Visible number of text lines.
	 * Default on TextareaField is too small
	 */
	protected $rows = 15;

	/**
	 * Toggle rendering markdown with extra syntax enabled.
	 * @link http://michelf.ca/projects/php-markdown/extra
	 * @var boolean
	 */
	protected $enable_extra = false;


	/* For some reason jquery didn't like it when requirements where in _config.php */
	public function __construct($name, $title = null, $value = null) {
	
		Requirements::css('markdowntextareafield/templates/css/styles.css');

		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR. '/jquery-entwine/dist/jquery.entwine-dist.js');
		Requirements::javascript('markdowntextareafield/thirdparty/textinputs_jquery.js');
		Requirements::javascript('markdowntextareafield/templates/javascript/script.js');

		parent::__construct($name, $title, $value);
	}

	/**
	 * Turn on extra syntax support
	 * @return MarkdownTextareaField
	 */
	public function enableExtra() {
		$this->enable_extra = true;
		return $this;
	}


	/**
	 * Body for the preview iframe with just the typography styles included
	 * @return string html
	 */
	public function preview() {
		Requirements::clear();
		// Should contain text styles of the page by Silverstripe theme conventions.
		Requirements::css('themes/'. Config::inst()->get('SSViewer', 'theme') . '/css/editor.css');
		return $this->renderWith('PreviewFrame');
	}

	/**
	 * Parse markdown into html
	 * @return string html
	 */
	public function parse() {

		$parser = new MarkdownParser($this->request['markdown']);

		return ($this->enable_extra) ? $parser->parseExtra() : $parser->parse(); 
	}

	/**
	 * Get buttons described in buttons.yml and wrap them in ViewableData
	 * @return ArrayList list of buttons and theyr configurations
	 */
	public function ToolbarButtons() {

		$buttons = new ArrayList();

		foreach($this->config()->get('buttons') as $button) {
			$buttons->push(new ArrayData($button));
		}

		return $buttons;
	}

}
