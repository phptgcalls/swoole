<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Document> stickers true emojis true text_color
 * @return WebPageAttribute
 */

final class WebPageAttributeStickerSet extends Instance {
	public function request(array $stickers,? true $emojis = null,? true $text_color = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x50cc03d3);
		$flags = 0;
		$flags |= is_null($emojis) ? 0 : (1 << 0);
		$flags |= is_null($text_color) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteVector($stickers,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['emojis'] = true;
		else:
			$result['emojis'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['text_color'] = true;
		else:
			$result['text_color'] = false;
		endif;
		$result['stickers'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>