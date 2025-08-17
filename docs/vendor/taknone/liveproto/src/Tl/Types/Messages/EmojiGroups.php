<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash Vector<EmojiGroup> groups
 * @return messages.EmojiGroups
 */

final class EmojiGroups extends Instance {
	public function request(int $hash,array $groups) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x881fb94b);
		$writer->writeInt($hash);
		$writer->tgwriteVector($groups,'EmojiGroup');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['groups'] = $reader->tgreadVector('EmojiGroup');
		return new self($result);
	}
}

?>