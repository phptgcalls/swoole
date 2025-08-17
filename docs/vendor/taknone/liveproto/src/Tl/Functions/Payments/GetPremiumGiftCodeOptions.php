<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer boost_peer
 * @return Vector<PremiumGiftCodeOption>
 */

final class GetPremiumGiftCodeOptions extends Instance {
	public function request(? object $boost_peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2757ba54);
		$flags = 0;
		$flags |= is_null($boost_peer) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($boost_peer) === false):
			$writer->write($boost_peer->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>