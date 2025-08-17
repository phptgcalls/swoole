<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title long icon_emoji_id
 * @return EmojiGroup
 */

final class EmojiGroupPremium extends Instance {
	public function request(string $title,int $icon_emoji_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93bcf34);
		$writer->tgwriteBytes($title);
		$writer->writeLong($icon_emoji_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['icon_emoji_id'] = $reader->readLong();
		return new self($result);
	}
}

?>