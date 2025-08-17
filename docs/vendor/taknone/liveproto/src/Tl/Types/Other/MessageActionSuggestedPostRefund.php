<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true payer_initiated
 * @return MessageAction
 */

final class MessageActionSuggestedPostRefund extends Instance {
	public function request(? true $payer_initiated = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x69f916f8);
		$flags = 0;
		$flags |= is_null($payer_initiated) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['payer_initiated'] = true;
		else:
			$result['payer_initiated'] = false;
		endif;
		return new self($result);
	}
}

?>