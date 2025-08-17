<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Reaction> reactions
 * @return ChatReactions
 */

final class ChatReactionsSome extends Instance {
	public function request(array $reactions) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x661d4037);
		$writer->tgwriteVector($reactions,'Reaction');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['reactions'] = $reader->tgreadVector('Reaction');
		return new self($result);
	}
}

?>