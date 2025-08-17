<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> slots
 * @return premium.MyBoosts
 */

final class ApplyBoost extends Instance {
	public function request(object $peer,? array $slots = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6b7da746);
		$flags = 0;
		$flags |= is_null($slots) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($slots) === false):
			$writer->tgwriteVector($slots,'int');
		endif;
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>