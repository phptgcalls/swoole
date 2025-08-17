<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id inputpeer parent_peer
 * @return account.PaidMessagesRevenue
 */

final class GetPaidMessagesRevenue extends Instance {
	public function request(object $user_id,? object $parent_peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x19ba4a67);
		$flags = 0;
		$flags |= is_null($parent_peer) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($parent_peer) === false):
			$writer->write($parent_peer->read());
		endif;
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