<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer boost boost int qts
 * @return Update
 */

final class UpdateBotChatBoost extends Instance {
	public function request(object $peer,object $boost,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x904dd49c);
		$writer->write($peer->read());
		$writer->write($boost->read());
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['boost'] = $reader->tgreadObject();
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>