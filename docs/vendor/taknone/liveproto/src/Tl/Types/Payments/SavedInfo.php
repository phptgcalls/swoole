<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true has_saved_credentials paymentrequestedinfo saved_info
 * @return payments.SavedInfo
 */

final class SavedInfo extends Instance {
	public function request(? true $has_saved_credentials = null,? object $saved_info = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfb8fe43c);
		$flags = 0;
		$flags |= is_null($has_saved_credentials) ? 0 : (1 << 1);
		$flags |= is_null($saved_info) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($saved_info) === false):
			$writer->write($saved_info->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['has_saved_credentials'] = true;
		else:
			$result['has_saved_credentials'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['saved_info'] = $reader->tgreadObject();
		else:
			$result['saved_info'] = null;
		endif;
		return new self($result);
	}
}

?>