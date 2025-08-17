<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string format inputtheme theme string slug string title inputdocument document Vector<InputThemeSettings> settings
 * @return Theme
 */

final class UpdateTheme extends Instance {
	public function request(string $format,object $theme,? string $slug = null,? string $title = null,? object $document = null,? array $settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2bf40ccc);
		$flags = 0;
		$flags |= is_null($slug) ? 0 : (1 << 0);
		$flags |= is_null($title) ? 0 : (1 << 1);
		$flags |= is_null($document) ? 0 : (1 << 2);
		$flags |= is_null($settings) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($format);
		$writer->write($theme->read());
		if(is_null($slug) === false):
			$writer->tgwriteBytes($slug);
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($settings) === false):
			$writer->tgwriteVector($settings,'InputThemeSettings');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>