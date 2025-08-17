<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id true refund_charged true require_payment inputpeer parent_peer
 * @return Bool
 */

final class ToggleNoPaidMessagesException extends Instance {
	public function request(object $user_id,? true $refund_charged = null,? true $require_payment = null,? object $parent_peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfe2eda76);
		$flags = 0;
		$flags |= is_null($refund_charged) ? 0 : (1 << 0);
		$flags |= is_null($require_payment) ? 0 : (1 << 2);
		$flags |= is_null($parent_peer) ? 0 : (1 << 1);
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