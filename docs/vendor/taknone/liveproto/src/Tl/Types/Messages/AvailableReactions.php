<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash Vector<AvailableReaction> reactions
 * @return messages.AvailableReactions
 */

final class AvailableReactions extends Instance {
	public function request(int $hash,array $reactions) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x768e3aad);
		$writer->writeInt($hash);
		$writer->tgwriteVector($reactions,'AvailableReaction');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['reactions'] = $reader->tgreadVector('AvailableReaction');
		return new self($result);
	}
}

?>