<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id string title string short_name Vector<InputStickerSetItem> stickers true masks true emojis true text_color inputdocument thumb string software
 * @return messages.StickerSet
 */

final class CreateStickerSet extends Instance {
	public function request(object $user_id,string $title,string $short_name,array $stickers,? true $masks = null,? true $emojis = null,? true $text_color = null,? object $thumb = null,? string $software = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9021ab67);
		$flags = 0;
		$flags |= is_null($masks) ? 0 : (1 << 0);
		$flags |= is_null($emojis) ? 0 : (1 << 5);
		$flags |= is_null($text_color) ? 0 : (1 << 6);
		$flags |= is_null($thumb) ? 0 : (1 << 2);
		$flags |= is_null($software) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($user_id->read());
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($short_name);
		if(is_null($thumb) === false):
			$writer->write($thumb->read());
		endif;
		$writer->tgwriteVector($stickers,'InputStickerSetItem');
		if(is_null($software) === false):
			$writer->tgwriteBytes($software);
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