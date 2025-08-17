<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title long icon_emoji_id Vector<string> emoticons
 * @return EmojiGroup
 */

final class EmojiGroupGreeting extends Instance {
	public function request(string $title,int $icon_emoji_id,array $emoticons) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x80d26cc7);
		$writer->tgwriteBytes($title);
		$writer->writeLong($icon_emoji_id);
		$writer->tgwriteVector($emoticons,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['icon_emoji_id'] = $reader->readLong();
		$result['emoticons'] = $reader->tgreadVector('string');
		return new self($result);
	}
}

?>