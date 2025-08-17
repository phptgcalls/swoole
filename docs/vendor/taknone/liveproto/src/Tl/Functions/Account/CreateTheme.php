<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug string title inputdocument document Vector<InputThemeSettings> settings
 * @return Theme
 */

final class CreateTheme extends Instance {
	public function request(string $slug,string $title,? object $document = null,? array $settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x652e4400);
		$flags = 0;
		$flags |= is_null($document) ? 0 : (1 << 2);
		$flags |= is_null($settings) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($slug);
		$writer->tgwriteBytes($title);
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