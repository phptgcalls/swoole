<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id int months textwithentities message
 * @return InputInvoice
 */

final class InputInvoicePremiumGiftStars extends Instance {
	public function request(object $user_id,int $months,? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdabab2ef);
		$flags = 0;
		$flags |= is_null($message) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($user_id->read());
		$writer->writeInt($months);
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['user_id'] = $reader->tgreadObject();
		$result['months'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		return new self($result);
	}
}

?>