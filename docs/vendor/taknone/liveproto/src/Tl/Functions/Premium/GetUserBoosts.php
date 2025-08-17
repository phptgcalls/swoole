<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser user_id
 * @return premium.BoostsList
 */

final class GetUserBoosts extends Instance {
	public function request(object $peer,object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x39854d1f);
		$writer->write($peer->read());
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>