<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string link true revoked
 * @return payments.ConnectedStarRefBots
 */

final class EditConnectedStarRefBot extends Instance {
	public function request(object $peer,string $link,? true $revoked = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe4fca4a3);
		$flags = 0;
		$flags |= is_null($revoked) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($link);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>