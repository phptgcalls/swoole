<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title long icon_emoji_id bool closed bool hidden
 * @return MessageAction
 */

final class MessageActionTopicEdit extends Instance {
	public function request(? string $title = null,? int $icon_emoji_id = null,? bool $closed = null,? bool $hidden = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc0944820);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($icon_emoji_id) ? 0 : (1 << 1);
		$flags |= is_null($closed) ? 0 : (1 << 2);
		$flags |= is_null($hidden) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($icon_emoji_id) === false):
			$writer->writeLong($icon_emoji_id);
		endif;
		if(is_null($closed) === false):
			$writer->tgwriteBool($closed);
		endif;
		if(is_null($hidden) === false):
			$writer->tgwriteBool($hidden);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['icon_emoji_id'] = $reader->readLong();
		else:
			$result['icon_emoji_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['closed'] = $reader->tgreadBool();
		else:
			$result['closed'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['hidden'] = $reader->tgreadBool();
		else:
			$result['hidden'] = null;
		endif;
		return new self($result);
	}
}

?>