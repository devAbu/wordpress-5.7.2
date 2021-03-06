<?php

namespace uListing\Classes\Vendor;

class Html
{
	/**
	 * @var string Regular expression used for attribute name validation.
	 * @since 2.0.12
	 */
	public static $attributeRegex = '/(^|.*\])([\w\.\+]+)(\[.*|$)/u';
	/**
	 * @var array list of void elements (element name => 1)
	 * @see http://www.w3.org/TR/html-markup/syntax.html#void-element
	 */
	public static $voidElements = [
		'area' => 1,
		'base' => 1,
		'br' => 1,
		'col' => 1,
		'command' => 1,
		'embed' => 1,
		'hr' => 1,
		'img' => 1,
		'input' => 1,
		'keygen' => 1,
		'link' => 1,
		'meta' => 1,
		'param' => 1,
		'source' => 1,
		'track' => 1,
		'wbr' => 1,
	];
	/**
	 * @var array the preferred order of attributes in a tag. This mainly affects the order of the attributes
	 * that are rendered by [[renderTagAttributes()]].
	 */
	public static $attributeOrder = [
		'type',
		'id',
		'class',
		'name',
		'value',

		'href',
		'src',
		'srcset',
		'form',
		'action',
		'method',

		'selected',
		'checked',
		'readonly',
		'disabled',
		'multiple',

		'size',
		'maxlength',
		'width',
		'height',
		'rows',
		'cols',

		'alt',
		'title',
		'rel',
		'media',
	];
	/**
	 * @var array list of tag attributes that should be specially handled when their values are of array type.
	 * In particular, if the value of the `data` attribute is `['name' => 'xyz', 'age' => 13]`, two attributes
	 * will be generated instead of one: `data-name="xyz" data-age="13"`.
	 * @since 2.0.3
	 */
	public static $dataAttributes = ['data', 'data-ng', 'ng'];

	public static function encode($content, $doubleEncode = true)
	{
		return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE,  'UTF-8', $doubleEncode);
	}

	/**
	 * Decodes special HTML entities back to the corresponding characters.
	 * This is the opposite of [[encode()]].
	 * @param string $content the content to be decoded
	 * @return string the decoded content
	 * @see encode()
	 * @see http://www.php.net/manual/en/function.htmlspecialchars-decode.php
	 */
	public static function decode($content)
	{
		return htmlspecialchars_decode($content, ENT_QUOTES);
	}

	/**
	 * Generates a complete HTML tag.
	 * @param string|bool|null $name the tag name. If $name is `null` or `false`, the corresponding content will be rendered without any tag.
	 * @param string $content the content to be enclosed between the start and end tags. It will not be HTML-encoded.
	 * If this is coming from end users, you should consider [[encode()]] it to prevent XSS attacks.
	 * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
	 * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 *
	 * For example when using `['class' => 'my-class', 'target' => '_blank', 'value' => null]` it will result in the
	 * html attributes rendered like this: `class="my-class" target="_blank"`.
	 *
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * @return string the generated HTML tag
	 * @see beginTag()
	 * @see endTag()
	 */
	public static function tag($name, $content = '', $options = [])
	{
		if ($name === null || $name === false) {
			return $content;
		}
		$html = "<$name" . static::renderTagAttributes($options) . '>';
		return isset(static::$voidElements[strtolower($name)]) ? $html : "$html$content</$name>";
	}

	/**
	 * Generates a start tag.
	 * @param string|bool|null $name the tag name. If $name is `null` or `false`, the corresponding content will be rendered without any tag.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated start tag
	 * @see endTag()
	 * @see tag()
	 */
	public static function beginTag($name, $options = [])
	{
		if ($name === null || $name === false) {
			return '';
		}

		return "<$name" . static::renderTagAttributes($options) . '>';
	}

	/**
	 * Generates an end tag.
	 * @param string|bool|null $name the tag name. If $name is `null` or `false`, the corresponding content will be rendered without any tag.
	 * @return string the generated end tag
	 * @see beginTag()
	 * @see tag()
	 */
	public static function endTag($name)
	{
		if ($name === null || $name === false) {
			return '';
		}

		return "</$name>";
	}

	/**
	 * Generates a style tag.
	 * @param string $content the style content
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated style tag
	 */
	public static function style($content, $options = [])
	{
		return static::tag('style', $content, $options);
	}

	/**
	 * Generates a script tag.
	 * @param string $content the script content
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated script tag
	 */
	public static function script($content, $options = [])
	{
		return static::tag('script', $content, $options);
	}

	/**
	 * Generates a link tag that refers to an external CSS file.
	 * @param array|string $url the URL of the external CSS file. This parameter will be processed by [[Url::to()]].
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - condition: specifies the conditional comments for IE, e.g., `lt IE 9`. When this is specified,
	 *   the generated `link` tag will be enclosed within the conditional comments. This is mainly useful
	 *   for supporting old versions of IE browsers.
	 * - noscript: if set to true, `link` tag will be wrapped into `<noscript>` tags.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting link tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated link tag
	 * @see Url::to()
	 */
	public static function cssFile($url, $options = [])
	{
		if (!isset($options['rel'])) {
			$options['rel'] = 'stylesheet';
		}
		$options['href'] = $url;

		if (isset($options['condition'])) {
			$condition = $options['condition'];
			unset($options['condition']);
			return self::wrapIntoCondition(static::tag('link', '', $options), $condition);
		} elseif (isset($options['noscript']) && $options['noscript'] === true) {
			unset($options['noscript']);
			return '<noscript>' . static::tag('link', '', $options) . '</noscript>';
		}

		return static::tag('link', '', $options);
	}

	/**
	 * Generates a script tag that refers to an external JavaScript file.
	 * @param string $url the URL of the external JavaScript file. This parameter will be processed by [[Url::to()]].
	 * @param array $options the tag options in terms of name-value pairs. The following option is specially handled:
	 *
	 * - condition: specifies the conditional comments for IE, e.g., `lt IE 9`. When this is specified,
	 *   the generated `script` tag will be enclosed within the conditional comments. This is mainly useful
	 *   for supporting old versions of IE browsers.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting script tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated script tag
	 * @see Url::to()
	 */
	public static function jsFile($url, $options = [])
	{
		$options['src'] = $url;
		if (isset($options['condition'])) {
			$condition = $options['condition'];
			unset($options['condition']);
			return self::wrapIntoCondition(static::tag('script', '', $options), $condition);
		}

		return static::tag('script', '', $options);
	}

	/**
	 * Wraps given content into conditional comments for IE, e.g., `lt IE 9`.
	 * @param string $content raw HTML content.
	 * @param string $condition condition string.
	 * @return string generated HTML.
	 */
	private static function wrapIntoCondition($content, $condition)
	{
		if (strpos($condition, '!IE') !== false) {
			return "<!--[if $condition]><!-->\n" . $content . "\n<!--<![endif]-->";
		}

		return "<!--[if $condition]>\n" . $content . "\n<![endif]-->";
	}

	public static function a($text, $url = null, $options = [])
	{
		if ($url !== null) {
			$options['href'] = $url;
		}

		return static::tag('a', $text, $options);
	}

	/**
	 * Generates a mailto hyperlink.
	 * @param string $text link body. It will NOT be HTML-encoded. Therefore you can pass in HTML code
	 * such as an image tag. If this is coming from end users, you should consider [[encode()]]
	 * it to prevent XSS attacks.
	 * @param string $email email address. If this is null, the first parameter (link body) will be treated
	 * as the email address and used.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated mailto link
	 */
	public static function mailto($text, $email = null, $options = [])
	{
		$options['href'] = 'mailto:' . ($email === null ? $text : $email);
		return static::tag('a', $text, $options);
	}

	/**
	 * Generates an image tag.
	 * @param array|string $src the image URL. This parameter will be processed by [[Url::to()]].
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * Since version 2.0.12 It is possible to pass the `srcset` option as an array which keys are
	 * descriptors and values are URLs. All URLs will be processed by [[Url::to()]].
	 * @return string the generated image tag.
	 */
	public static function img($src, $options = [])
	{
		$options['src'] = $src;

		if (isset($options['srcset']) && is_array($options['srcset'])) {
			$srcset = [];
			foreach ($options['srcset'] as $descriptor => $url) {
				$srcset[] = $url . ' ' . $descriptor;
			}
			$options['srcset'] = implode(',', $srcset);
		}

		if (!isset($options['alt'])) {
			$options['alt'] = '';
		}

		return static::tag('img', '', $options);
	}

	/**
	 * Generates a label tag.
	 * @param string $content label text. It will NOT be HTML-encoded. Therefore you can pass in HTML code
	 * such as an image tag. If this is is coming from end users, you should [[encode()]]
	 * it to prevent XSS attacks.
	 * @param string $for the ID of the HTML element that this label is associated with.
	 * If this is null, the "for" attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated label tag
	 */
	public static function label($content, $for = null, $options = [])
	{
		$options['for'] = $for;
		return static::tag('label', $content, $options);
	}

	/**
	 * Generates a button tag.
	 * @param string $content the content enclosed within the button tag. It will NOT be HTML-encoded.
	 * Therefore you can pass in HTML code such as an image tag. If this is is coming from end users,
	 * you should consider [[encode()]] it to prevent XSS attacks.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated button tag
	 */
	public static function button($content = 'Button', $options = [])
	{
		if (!isset($options['type'])) {
			$options['type'] = 'button';
		}

		return static::tag('button', $content, $options);
	}

	/**
	 * Generates a submit button tag.
	 *
	 * Be careful when naming form elements such as submit buttons. According to the [jQuery documentation](https://api.jquery.com/submit/) there
	 * are some reserved names that can cause conflicts, e.g. `submit`, `length`, or `method`.
	 *
	 * @param string $content the content enclosed within the button tag. It will NOT be HTML-encoded.
	 * Therefore you can pass in HTML code such as an image tag. If this is is coming from end users,
	 * you should consider [[encode()]] it to prevent XSS attacks.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated submit button tag
	 */
	public static function submitButton($content = 'Submit', $options = [])
	{
		$options['type'] = 'submit';
		return static::button($content, $options);
	}

	/**
	 * Generates a reset button tag.
	 * @param string $content the content enclosed within the button tag. It will NOT be HTML-encoded.
	 * Therefore you can pass in HTML code such as an image tag. If this is is coming from end users,
	 * you should consider [[encode()]] it to prevent XSS attacks.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated reset button tag
	 */
	public static function resetButton($content = 'Reset', $options = [])
	{
		$options['type'] = 'reset';
		return static::button($content, $options);
	}

	/**
	 * Generates an input type of the given type.
	 * @param string $type the type attribute.
	 * @param string $name the name attribute. If it is null, the name attribute will not be generated.
	 * @param string $value the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated input tag
	 */
	public static function input($type, $name = null, $value = null, $options = [])
	{
		if (!isset($options['type'])) {
			$options['type'] = $type;
		}
		$options['name'] = $name;
		$options['value'] = $value === null ? null : (string) $value;
		return static::tag('input', '', $options);
	}

	/**
	 * Generates an input button.
	 * @param string $label the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated button tag
	 */
	public static function buttonInput($label = 'Button', $options = [])
	{
		$options['type'] = 'button';
		$options['value'] = $label;
		return static::tag('input', '', $options);
	}

	/**
	 * Generates a submit input button.
	 *
	 * Be careful when naming form elements such as submit buttons. According to the [jQuery documentation](https://api.jquery.com/submit/) there
	 * are some reserved names that can cause conflicts, e.g. `submit`, `length`, or `method`.
	 *
	 * @param string $label the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated button tag
	 */
	public static function submitInput($label = 'Submit', $options = [])
	{
		$options['type'] = 'submit';
		$options['value'] = $label;
		return static::tag('input', '', $options);
	}

	/**
	 * Generates a reset input button.
	 * @param string $label the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the attributes of the button tag. The values will be HTML-encoded using [[encode()]].
	 * Attributes whose value is null will be ignored and not put in the tag returned.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated button tag
	 */
	public static function resetInput($label = 'Reset', $options = [])
	{
		$options['type'] = 'reset';
		$options['value'] = $label;
		return static::tag('input', '', $options);
	}

	/**
	 * Generates a text input field.
	 * @param string $name the name attribute.
	 * @param string $value the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated text input tag
	 */
	public static function textInput($name, $value = null, $options = [])
	{
		return static::input('text', $name, $value, $options);
	}

	/**
	 * Generates a hidden input field.
	 * @param string $name the name attribute.
	 * @param string $value the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated hidden input tag
	 */
	public static function hiddenInput($name, $value = null, $options = [])
	{
		return static::input('hidden', $name, $value, $options);
	}

	/**
	 * Generates a password input field.
	 * @param string $name the name attribute.
	 * @param string $value the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated password input tag
	 */
	public static function passwordInput($name, $value = null, $options = [])
	{
		return static::input('password', $name, $value, $options);
	}

	/**
	 * Generates a file input field.
	 * To use a file input field, you should set the enclosing form's "enctype" attribute to
	 * be "multipart/form-data". After the form is submitted, the uploaded file information
	 * can be obtained via $_FILES[$name] (see PHP documentation).
	 * @param string $name the name attribute.
	 * @param string $value the value attribute. If it is null, the value attribute will not be generated.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * @return string the generated file input tag
	 */
	public static function fileInput($name, $value = null, $options = [])
	{
		return static::input('file', $name, $value, $options);
	}

	/**
	 * Generates a text area input.
	 * @param string $name the input name
	 * @param string $value the input value. Note that it will be encoded using [[encode()]].
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
	 * If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 * The following special options are recognized:
	 *
	 * - `doubleEncode`: whether to double encode HTML entities in `$value`. If `false`, HTML entities in `$value` will not
	 *   be further encoded. This option is available since version 2.0.11.
	 *
	 * @return string the generated text area tag
	 */
	public static function textarea($name, $value = '', $options = [])
	{
		$options['name'] = $name;
		$doubleEncode = ArrayHelper::remove($options, 'doubleEncode', true);
		return static::tag('textarea', static::encode($value, $doubleEncode), $options);
	}

	/**
	 * Generates a radio button input.
	 * @param string $name the name attribute.
	 * @param bool $checked whether the radio button should be checked.
	 * @param array $options the tag options in terms of name-value pairs.
	 * See [[booleanInput()]] for details about accepted attributes.
	 *
	 * @return string the generated radio button tag
	 */
	public static function radio($name, $checked = false, $options = [])
	{
		return static::booleanInput('radio', $name, $checked, $options);
	}

	/**
	 * Generates a checkbox input.
	 * @param string $name the name attribute.
	 * @param bool $checked whether the checkbox should be checked.
	 * @param array $options the tag options in terms of name-value pairs.
	 * See [[booleanInput()]] for details about accepted attributes.
	 *
	 * @return string the generated checkbox tag
	 */
	public static function checkbox($name, $checked = false, $options = [])
	{
		return static::booleanInput('checkbox', $name, $checked, $options);
	}

	/**
	 * Generates a boolean input.
	 * @param string $type the input type. This can be either `radio` or `checkbox`.
	 * @param string $name the name attribute.
	 * @param bool $checked whether the checkbox should be checked.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the checkbox. When this attribute
	 *   is present, a hidden input will be generated so that if the checkbox is not checked and is submitted,
	 *   the value of this attribute will still be submitted to the server via the hidden input.
	 * - label: string, a label displayed next to the checkbox.  It will NOT be HTML-encoded. Therefore you can pass
	 *   in HTML code such as an image tag. If this is is coming from end users, you should [[encode()]] it to prevent XSS attacks.
	 *   When this option is specified, the checkbox will be enclosed by a label tag.
	 * - labelOptions: array, the HTML attributes for the label tag. Do not set this option unless you set the "label" option.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting checkbox tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * @return string the generated checkbox tag
	 * @since 2.0.9
	 */
	protected static function booleanInput($type, $name, $checked = false, $options = [])
	{
		$options['checked'] = (bool) $checked;
		$value = array_key_exists('value', $options) ? $options['value'] : '1';
		if (isset($options['uncheck'])) {
			// add a hidden field so that if the checkbox is not selected, it still submits a value
			$hiddenOptions = [];
			if (isset($options['form'])) {
				$hiddenOptions['form'] = $options['form'];
			}
			$hidden = static::hiddenInput($name, $options['uncheck'], $hiddenOptions);
			unset($options['uncheck']);
		} else {
			$hidden = '';
		}
		if (isset($options['label'])) {
			$label = $options['label'];
			$labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
			unset($options['label'], $options['labelOptions']);
			$content = static::label(static::input($type, $name, $value, $options) . ' ' . $label, null, $labelOptions);
			return $hidden . $content;
		}

		return $hidden . static::input($type, $name, $value, $options);
	}

	public static function dropDownList($name, $selection = null, $items = [], $options = [])
	{
		if (!empty($options['multiple'])) {
			return static::listBox($name, $selection, $items, $options);
		}
		$options['name'] = $name;
		unset($options['unselect']);
		$selectOptions = static::renderSelectOptions($selection, $items, $options);
		return static::tag('select', "\n" . $selectOptions . "\n", $options);
	}

	public static function listBox($name, $selection = null, $items = [], $options = [])
	{
		if (!array_key_exists('size', $options)) {
			$options['size'] = 4;
		}
		if (!empty($options['multiple']) && !empty($name) && substr_compare($name, '[]', -2, 2)) {
			$name .= '[]';
		}
		$options['name'] = $name;
		if (isset($options['unselect'])) {
			// add a hidden field so that if the list box has no option being selected, it still submits a value
			if (!empty($name) && substr_compare($name, '[]', -2, 2) === 0) {
				$name = substr($name, 0, -2);
			}
			$hidden = static::hiddenInput($name, $options['unselect']);
			unset($options['unselect']);
		} else {
			$hidden = '';
		}
		$selectOptions = static::renderSelectOptions($selection, $items, $options);
		return $hidden . static::tag('select', "\n" . $selectOptions . "\n", $options);
	}

	public static function checkboxList($name, $selection = null, $items = [], $options = [])
	{
		if (substr($name, -2) !== '[]') {
			$name .= '[]';
		}
		if (ArrayHelper::isTraversable($selection)) {
			$selection = array_map('strval', (array)$selection);
		}

		$formatter = ArrayHelper::remove($options, 'item');
		$itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
		$encode = ArrayHelper::remove($options, 'encode', true);
		$separator = ArrayHelper::remove($options, 'separator', "\n");
		$tag = ArrayHelper::remove($options, 'tag', 'div');

		$lines = [];
		$index = 0;
		foreach ($items as $value => $label) {
			$checked = $selection !== null &&
			           (!ArrayHelper::isTraversable($selection) && !strcmp($value, $selection)
			            || ArrayHelper::isTraversable($selection) && ArrayHelper::isIn((string)$value, $selection));
			if ($formatter !== null) {
				$lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
			} else {
				$lines[] = static::checkbox($name, $checked, array_merge($itemOptions, [
					'value' => $value,
					'label' => $encode ? static::encode($label) : $label,
				]));
			}
			$index++;
		}

		if (isset($options['unselect'])) {
			// add a hidden field so that if the list box has no option being selected, it still submits a value
			$name2 = substr($name, -2) === '[]' ? substr($name, 0, -2) : $name;
			$hidden = static::hiddenInput($name2, $options['unselect']);
			unset($options['unselect']);
		} else {
			$hidden = '';
		}

		$visibleContent = implode($separator, $lines);

		if ($tag === false) {
			return $hidden . $visibleContent;
		}

		return $hidden . static::tag($tag, $visibleContent, $options);
	}

	public static function radioList($name, $selection = null, $items = [], $options = [])
	{
		if (ArrayHelper::isTraversable($selection)) {
			$selection = array_map('strval', (array)$selection);
		}

		$formatter = ArrayHelper::remove($options, 'item');
		$itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
		$encode = ArrayHelper::remove($options, 'encode', true);
		$separator = ArrayHelper::remove($options, 'separator', "\n");
		$tag = ArrayHelper::remove($options, 'tag', 'div');
		// add a hidden field so that if the list box has no option being selected, it still submits a value
		$hidden = isset($options['unselect']) ? static::hiddenInput($name, $options['unselect']) : '';
		unset($options['unselect']);

		$lines = [];
		$index = 0;
		foreach ($items as $value => $label) {
			$checked = $selection !== null &&
			           (!ArrayHelper::isTraversable($selection) && !strcmp($value, $selection)
			            || ArrayHelper::isTraversable($selection) && ArrayHelper::isIn((string)$value, $selection));
			if ($formatter !== null) {
				$lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
			} else {
				$lines[] = static::radio($name, $checked, array_merge($itemOptions, [
					'value' => $value,
					'label' => $encode ? static::encode($label) : $label,
				]));
			}
			$index++;
		}
		$visibleContent = implode($separator, $lines);

		if ($tag === false) {
			return $hidden . $visibleContent;
		}

		return $hidden . static::tag($tag, $visibleContent, $options);
	}

	public static function ul($items, $options = [])
	{
		$tag = ArrayHelper::remove($options, 'tag', 'ul');
		$encode = ArrayHelper::remove($options, 'encode', true);
		$formatter = ArrayHelper::remove($options, 'item');
		$separator = ArrayHelper::remove($options, 'separator', "\n");
		$itemOptions = ArrayHelper::remove($options, 'itemOptions', []);

		if (empty($items)) {
			return static::tag($tag, '', $options);
		}

		$results = [];
		foreach ($items as $index => $item) {
			if ($formatter !== null) {
				$results[] = call_user_func($formatter, $item, $index);
			} else {
				$results[] = static::tag('li', $encode ? static::encode($item) : $item, $itemOptions);
			}
		}

		return static::tag(
			$tag,
			$separator . implode($separator, $results) . $separator,
			$options
		);
	}

	public static function ol($items, $options = [])
	{
		$options['tag'] = 'ol';
		return static::ul($items, $options);
	}

	public static function renderSelectOptions($selection, $items, &$tagOptions = [])
	{
		if (ArrayHelper::isTraversable($selection)) {
			$selection = array_map('strval', (array)$selection);
		}

		$lines = [];
		$encodeSpaces = ArrayHelper::remove($tagOptions, 'encodeSpaces', false);
		$encode = ArrayHelper::remove($tagOptions, 'encode', true);
		if (isset($tagOptions['prompt'])) {
			$promptOptions = ['value' => ''];
			if (is_string($tagOptions['prompt'])) {
				$promptText = $tagOptions['prompt'];
			} else {
				$promptText = $tagOptions['prompt']['text'];
				$promptOptions = array_merge($promptOptions, $tagOptions['prompt']['options']);
			}
			$promptText = $encode ? static::encode($promptText) : $promptText;
			if ($encodeSpaces) {
				$promptText = str_replace(' ', '&nbsp;', $promptText);
			}
			$lines[] = static::tag('option', $promptText, $promptOptions);
		}

		$options = isset($tagOptions['options']) ? $tagOptions['options'] : [];
		$groups = isset($tagOptions['groups']) ? $tagOptions['groups'] : [];
		unset($tagOptions['prompt'], $tagOptions['options'], $tagOptions['groups']);
		$options['encodeSpaces'] = ArrayHelper::getValue($options, 'encodeSpaces', $encodeSpaces);
		$options['encode'] = ArrayHelper::getValue($options, 'encode', $encode);

		foreach ($items as $key => $value) {
			if (is_array($value)) {
				$groupAttrs = isset($groups[$key]) ? $groups[$key] : [];
				if (!isset($groupAttrs['label'])) {
					$groupAttrs['label'] = $key;
				}
				$attrs = ['options' => $options, 'groups' => $groups, 'encodeSpaces' => $encodeSpaces, 'encode' => $encode];
				$content = static::renderSelectOptions($selection, $value, $attrs);
				$lines[] = static::tag('optgroup', "\n" . $content . "\n", $groupAttrs);
			} else {
				$attrs = isset($options[$key]) ? $options[$key] : [];
				$attrs['value'] = (string) $key;
				if (!array_key_exists('selected', $attrs)) {
					$attrs['selected'] = $selection !== null &&
					                     (!ArrayHelper::isTraversable($selection) && !strcmp($key, $selection)
					                      || ArrayHelper::isTraversable($selection) && ArrayHelper::isIn((string)$key, $selection));
				}
				$text = $encode ? static::encode($value) : $value;
				if ($encodeSpaces) {
					$text = str_replace(' ', '&nbsp;', $text);
				}
				$lines[] = static::tag('option', $text, $attrs);
			}
		}

		return implode("\n", $lines);
	}

	public static function renderTagAttributes($attributes)
	{
		if (count($attributes) > 1) {
			$sorted = [];
			foreach (static::$attributeOrder as $name) {
				if (isset($attributes[$name])) {
					$sorted[$name] = $attributes[$name];
				}
			}
			$attributes = array_merge($sorted, $attributes);
		}

		$html = '';
		foreach ($attributes as $name => $value) {
			if (is_bool($value)) {
				if ($value) {
					$html .= " $name";
				}
			} elseif (is_array($value)) {
				if (in_array($name, static::$dataAttributes)) {
					foreach ($value as $n => $v) {
						if (is_array($v)) {
							$html .= " $name-$n='" . Json::htmlEncode($v) . "'";
						} else {
							$html .= " $name-$n=\"" . static::encode($v) . '"';
						}
					}
				} elseif ($name === 'class') {
					if (empty($value)) {
						continue;
					}
					$html .= " $name=\"" . static::encode(implode(' ', $value)) . '"';
				} elseif ($name === 'style') {
					if (empty($value)) {
						continue;
					}
					$html .= " $name=\"" . static::encode(static::cssStyleFromArray($value)) . '"';
				} else {
					$html .= " $name='" . Json::htmlEncode($value) . "'";
				}
			} elseif ($value !== null) {
				$html .= " $name=\"" . static::encode($value) . '"';
			}
		}

		return $html;
	}

	public static function addCssClass(&$options, $class)
	{
		if (isset($options['class'])) {
			if (is_array($options['class'])) {
				$options['class'] = self::mergeCssClasses($options['class'], (array) $class);
			} else {
				$classes = preg_split('/\s+/', $options['class'], -1, PREG_SPLIT_NO_EMPTY);
				$options['class'] = implode(' ', self::mergeCssClasses($classes, (array) $class));
			}
		} else {
			$options['class'] = $class;
		}
	}

	/**
	 * Merges already existing CSS classes with new one.
	 * This method provides the priority for named existing classes over additional.
	 * @param array $existingClasses already existing CSS classes.
	 * @param array $additionalClasses CSS classes to be added.
	 * @return array merge result.
	 * @see addCssClass()
	 */
	private static function mergeCssClasses(array $existingClasses, array $additionalClasses)
	{
		foreach ($additionalClasses as $key => $class) {
			if (is_int($key) && !in_array($class, $existingClasses)) {
				$existingClasses[] = $class;
			} elseif (!isset($existingClasses[$key])) {
				$existingClasses[$key] = $class;
			}
		}

		return array_unique($existingClasses);
	}

	public static function removeCssClass(&$options, $class)
	{
		if (isset($options['class'])) {
			if (is_array($options['class'])) {
				$classes = array_diff($options['class'], (array) $class);
				if (empty($classes)) {
					unset($options['class']);
				} else {
					$options['class'] = $classes;
				}
			} else {
				$classes = preg_split('/\s+/', $options['class'], -1, PREG_SPLIT_NO_EMPTY);
				$classes = array_diff($classes, (array) $class);
				if (empty($classes)) {
					unset($options['class']);
				} else {
					$options['class'] = implode(' ', $classes);
				}
			}
		}
	}

	public static function addCssStyle(&$options, $style, $overwrite = true)
	{
		if (!empty($options['style'])) {
			$oldStyle = is_array($options['style']) ? $options['style'] : static::cssStyleToArray($options['style']);
			$newStyle = is_array($style) ? $style : static::cssStyleToArray($style);
			if (!$overwrite) {
				foreach ($newStyle as $property => $value) {
					if (isset($oldStyle[$property])) {
						unset($newStyle[$property]);
					}
				}
			}
			$style = array_merge($oldStyle, $newStyle);
		}
		$options['style'] = is_array($style) ? static::cssStyleFromArray($style) : $style;
	}

	public static function removeCssStyle(&$options, $properties)
	{
		if (!empty($options['style'])) {
			$style = is_array($options['style']) ? $options['style'] : static::cssStyleToArray($options['style']);
			foreach ((array) $properties as $property) {
				unset($style[$property]);
			}
			$options['style'] = static::cssStyleFromArray($style);
		}
	}

	public static function cssStyleFromArray(array $style)
	{
		$result = '';
		foreach ($style as $name => $value) {
			$result .= "$name: $value; ";
		}
		// return null if empty to avoid rendering the "style" attribute
		return $result === '' ? null : rtrim($result);
	}

	public static function cssStyleToArray($style)
	{
		$result = [];
		foreach (explode(';', $style) as $property) {
			$property = explode(':', $property);
			if (count($property) > 1) {
				$result[trim($property[0])] = trim($property[1]);
			}
		}

		return $result;
	}

	public static function getAttributeName($attribute)
	{
		if (preg_match(static::$attributeRegex, $attribute, $matches)) {
			return $matches[2];
		}

		throw new InvalidArgumentException('Attribute name must contain word characters only.');
	}

	/**
	 * Escapes regular expression to use in JavaScript.
	 * @param string $regexp the regular expression to be escaped.
	 * @return string the escaped result.
	 * @since 2.0.6
	 */
	public static function escapeJsRegularExpression($regexp)
	{
		$pattern = preg_replace('/\\\\x\{?([0-9a-fA-F]+)\}?/', '\u$1', $regexp);
		$deliminator = substr($pattern, 0, 1);
		$pos = strrpos($pattern, $deliminator, 1);
		$flag = substr($pattern, $pos + 1);
		if ($deliminator !== '/') {
			$pattern = '/' . str_replace('/', '\\/', substr($pattern, 1, $pos - 1)) . '/';
		} else {
			$pattern = substr($pattern, 0, $pos + 1);
		}
		if (!empty($flag)) {
			$pattern .= preg_replace('/[^igm]/', '', $flag);
		}

		return $pattern;
	}
}
