<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument document string emoji maskcoords mask_coords string keywords
 * @return InputStickerSetItem
 */

final class InputStickerSetItem extends Instance {
	public function request(object $document,string $emoji,? object $mask_coords = null,? string $keywords = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x32da9e9c);
		$flags = 0;
		$flags |= is_null($mask_coords) ? 0 : (1 << 0);
		$flags |= is_null($keywords) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($document->read());
		$writer->tgwriteBytes($emoji);
		if(is_null($mask_coords) === false):
			$writer->write($mask_coords->read());
		endif;
		if(is_null($keywords) === false):
			$writer->tgwriteBytes($keywords);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['document'] = $reader->tgreadObject();
		$result['emoji'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['mask_coords'] = $reader->tgreadObject();
		else:
			$result['mask_coords'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['keywords'] = $reader->tgreadBytes();
		else:
			$result['keywords'] = null;
		endif;
		return new self($result);
	}
}

?>