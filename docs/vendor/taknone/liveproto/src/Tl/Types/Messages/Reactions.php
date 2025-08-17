<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<Reaction> reactions
 * @return messages.Reactions
 */

final class Reactions extends Instance {
	public function request(int $hash,array $reactions) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeafdf716);
		$writer->writeLong($hash);
		$writer->tgwriteVector($reactions,'Reaction');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['reactions'] = $reader->tgreadVector('Reaction');
		return new self($result);
	}
}

?>