<?php

class MarkdownTextareaField extends TextareaField {

	private static $allowed_actions = array(
		'preview'
	);

	/**
	 * @var int Visible number of text lines.
	 * Default on TextareaField is too small
	 */
	protected $rows = 15;


	public function preview() {
		Requirements::clear();
		// Should contain text styles of the page by Silverstripe theme conventions.
		Requirements::css('themes/'. Config::inst()->get('SSViewer', 'theme') . '/css/editor.css');
		return $this->renderWith('PreviewFrame');
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
