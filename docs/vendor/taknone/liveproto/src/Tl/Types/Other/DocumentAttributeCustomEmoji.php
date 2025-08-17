<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string alt inputstickerset stickerset true free true text_color
 * @return DocumentAttribute
 */

final class DocumentAttributeCustomEmoji extends Instance {
	public function request(string $alt,object $stickerset,? true $free = null,? true $text_color = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfd149899);
		$flags = 0;
		$flags |= is_null($free) ? 0 : (1 << 0);
		$flags |= is_null($text_color) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($alt);
		$writer->write($stickerset->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['free'] = true;
		else:
			$result['free'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['text_color'] = true;
		else:
			$result['text_color'] = false;
		endif;
		$result['alt'] = $reader->tgreadBytes();
		$result['stickerset'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>