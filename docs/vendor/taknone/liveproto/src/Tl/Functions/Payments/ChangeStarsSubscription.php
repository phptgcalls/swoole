<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string subscription_id bool canceled
 * @return Bool
 */

final class ChangeStarsSubscription extends Instance {
	public function request(object $peer,string $subscription_id,? bool $canceled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc7770878);
		$flags = 0;
		$flags |= is_null($canceled) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($subscription_id);
		if(is_null($canceled) === false):
			$writer->tgwriteBool($canceled);
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