<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (! function_exists('lang')) {
	/**
	 * CI3-style lang() compatibility for this app.
	 *
	 * Searches the active language folder for a matching key across all
	 * language files, then falls back to the key itself.
	 *
	 * Supports existing calls like lang('publish_product') and label-style
	 * calls like lang('field_name', 'input-id').
	 *
	 * @param array|string $argsOrFor
	 * @param array|string|null $localeOrAttributes
	 */
	function lang(string $line, $argsOrFor = [], $localeOrAttributes = null)
	{
		// Preserve CI4-style usage: lang('file.key', ['x' => 'y'], 'vi')
		if (is_array($argsOrFor) || $localeOrAttributes === null || is_string($localeOrAttributes)) {
			if (str_contains($line, '.')) {
				return service('language')->getLine(
					$line,
					is_array($argsOrFor) ? $argsOrFor : [],
					is_string($localeOrAttributes) ? $localeOrAttributes : null
				);
			}
		}

		$for        = is_string($argsOrFor) ? $argsOrFor : '';
		$attributes = is_array($localeOrAttributes) ? $localeOrAttributes : [];
		$langFolder = session()->get('lang_folder') ?? strtolower(MY_DEFAULT_LANGUAGE_NAME);
		$langPath   = APPPATH . 'Language/' . $langFolder . '/';

		if (! is_dir($langPath)) {
			$langPath = APPPATH . 'Language/' . strtolower(MY_DEFAULT_LANGUAGE_NAME) . '/';
		}

		$files = array_map(
			static fn ($file) => pathinfo($file, PATHINFO_FILENAME),
			glob($langPath . '*.php') ?: []
		);

		$translation = null;
		static $translationsCache = [];

		foreach ($files as $file) {
			$cacheKey = $langPath . $file;

			if (! array_key_exists($cacheKey, $translationsCache)) {
				$filePath = $langPath . $file . '.php';
				$translationsCache[$cacheKey] = is_file($filePath) ? include $filePath : [];
			}

			$translations = $translationsCache[$cacheKey];

			if (is_array($translations) && array_key_exists($line, $translations)) {
				$translation = $translations[$line];
				break;
			}
		}

		if ($translation === null) {
			$translation = $line;
		}

		if ($for !== '') {
			$attrString = '';
			foreach ($attributes as $key => $value) {
				$attrString .= ' ' . $key . '="' . esc((string) $value, 'attr') . '"';
			}

			$translation = '<label for="' . esc($for, 'attr') . '"' . $attrString . '>' . $translation . '</label>';
		}

		return $translation;
	}
}

