<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer true premium_required
 * @return SendAsPeer
 */

final class SendAsPeer extends Instance {
	public function request(object $peer,? true $premium_required = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb81c7034);
		$flags = 0;
		$flags |= is_null($premium_required) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['premium_required'] = true;
		else:
			$result['premium_required'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>