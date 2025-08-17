<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title int icon_color long icon_emoji_id
 * @return MessageAction
 */

final class MessageActionTopicCreate extends Instance {
	public function request(string $title,int $icon_color,? int $icon_emoji_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd999256);
		$flags = 0;
		$flags |= is_null($icon_emoji_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->writeInt($icon_color);
		if(is_null($icon_emoji_id) === false):
			$writer->writeLong($icon_emoji_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		$result['icon_color'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['icon_emoji_id'] = $reader->readLong();
		else:
			$result['icon_emoji_id'] = null;
		endif;
		return new self($result);
	}
}

?>