<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true restore true upgrade
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentPremiumSubscription extends Instance {
	public function request(? true $restore = null,? true $upgrade = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa6751e66);
		$flags = 0;
		$flags |= is_null($restore) ? 0 : (1 << 0);
		$flags |= is_null($upgrade) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['restore'] = true;
		else:
			$result['restore'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['upgrade'] = true;
		else:
			$result['upgrade'] = false;
		endif;
		return new self($result);
	}
}

?>